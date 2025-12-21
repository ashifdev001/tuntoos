<?php

namespace App\Http\Controllers\API;

use App\Models\Service;
use App\Models\ServiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Classes\ImageuploadHelper;

class ServiceController extends BaseController
{
    /**
     * GET /api/services
     * Paginated list with optional search / category filter.
     */
    public function index(Request $request)
    {
        $query = Service::with(['category', 'items']);

        // Search by name / description
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name',        'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }
        if ($request->has('type')) {
            $query->where('type', $request->type);
        } else {
            $query->where('type', 'service');
        }
        // ?category_id=3
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $perPage  = $request->get('per_page', 10);
        $services = $query->latest()->paginate($perPage);

        return $this->sendResponse($services, 'Services retrieved successfully.');
    }

    /**
     * POST /api/services
     * Create a service (with optional items[]).
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'slug'        => 'required|string|max:255|unique:services,slug',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:6000',
            'category_id' => 'nullable|exists:service_categories,id',
            'items'              => 'nullable|array',
            'items.*.title'      => 'nullable|string|max:255',
            'items.*.description' => 'nullable|string',
            'meta_title'=>  'nullable|string',
            'meta_description'=>  'nullable|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors(), 400);
        }

        try {
            // Base data
            $data              = $validator->validated();
            $data['slug'] = $request->slug ? str_replace(' ', '-', $request->slug) : Service::generateSlug($data['name']);
            $existService = Service::where('slug',$data['slug'])->first();
            if($existService){
                return $this->sendError("Slug is already exists!", [], 400);
            }
            $data['image']     = null;
            $data['type']     = $request->get('type', 'service');
            $itemsData         = $data['items'] ?? [];
            unset($data['items']);

            // Handle upload
            if ($request->hasFile('image')) {
                $upload     = ImageuploadHelper::uploadImage($request->file('image'), 'services');
                $data['image'] = $upload['path'];
            }

            if ($request->hasFile('cover_image')) {
                $upload     = ImageuploadHelper::uploadImage($request->file('cover_image'), 'services');
                $data['cover_image'] = $upload['path'];
            }
            
             if ($request->hasFile('card_image')) {
                $upload     = ImageuploadHelper::uploadImage($request->file('card_image'), 'services');
                $data['card_image'] = $upload['path'];
            }

            $service = Service::create($data);

            // Bulk‑insert child items if provided
            if ($itemsData) {
                foreach ($itemsData as &$item) {
                    $item['service_id'] = $service->id;
                }
                ServiceItem::insert($itemsData);
            }

            return $this->sendResponse($service->load('items'), 'Service created successfully.');
        } catch (QueryException $e) {
            return $this->sendError('Database error: ' . $e->getMessage(), 500);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    /**
     * GET /api/services/{id}
     */
    public function show(Service $service)
    {
        return $this->sendResponse($service->load(['category', 'items']), 'Service retrieved successfully.');
    }

    /**
     * PUT /api/services/{id}
     * Update the service (and optionally replace its items array).
     */
    public function update(Request $request, Service $service)
    {
       $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'slug'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:6000',
            'category_id' => 'nullable|exists:service_categories,id',
            'items'              => 'nullable|array',
            'items.*.title'      => 'required_with:items|string|max:255',
            'items.*.description' => 'nullable|string',
             'meta_title'=>  'nullable|string',
            'meta_description'=>  'nullable|string',
        ]);


        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors(), 400);
        }
        try {

            $data      = $validator->validated();
            $data['slug'] =$request->slug?str_replace(' ','-',$request->slug) : Service::generateSlug($data['name']);
             $existService = Service::where('slug', $data['slug'])->where('id', '!=', $service->id)->first();

            if($existService){
                return $this->sendError("Slug is already exists!", [], 400);
            }
            $itemsData = $data['items'] ?? [];
            unset($data['items']);

        // Upload replacement
            if ($request->hasFile('image')) {
                if ($service->image) {
                    ImageuploadHelper::removeImageFromDisk($service->image);
                }
                $upload         = ImageuploadHelper::uploadImage($request->file('image'), 'services');
                $data['image']  = $upload['path'];
            }

            if ($request->hasFile('cover_image')) {
                if ($service->cover_image) {
                    ImageuploadHelper::removeImageFromDisk($service->cover_image);
                }
                $upload     = ImageuploadHelper::uploadImage($request->file('cover_image'), 'services');
                $data['cover_image'] = $upload['path'];
            }
            
            if ($request->hasFile('card_image')) {
                if ($service->card_image) {
                    ImageuploadHelper::removeImageFromDisk($service->card_image);
                }
                $upload     = ImageuploadHelper::uploadImage($request->file('card_image'), 'services');
                $data['card_image'] = $upload['path'];
            }


            $service->update($data);
    
            if ($request->has('items')) {
                $service->items()->where('service_id', $service->id)->delete(); // remove old items
                foreach ($itemsData as $item) {
                    $service->items()->create([
                        'title'       => $item['title'],
                        'description' => $item['description'] ?? null,
                    ]);
                }
            }
    
            return $this->sendResponse($service->fresh('items'), 'Service updated successfully.');
        } catch (QueryException $e) {
            return $this->sendError('Database error: ' . $e->getMessage(), 500);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    /**
     * DELETE /api/services/{id}
     */
    public function destroy(Service $service)
    {
        if ($service->image) {
            ImageuploadHelper::removeImageFromDisk($service->image);
        }
        if ($service->cover_image) {
            ImageuploadHelper::removeImageFromDisk($service->cover_image);
        }
        if ($service->card_image) {
            ImageuploadHelper::removeImageFromDisk($service->card_image);
        }
        $service->items()->delete(); // remove children first
        $service->delete();

        return $this->sendResponse([], 'Service deleted successfully.');
    }
}
