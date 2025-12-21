<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Service;

class Services extends Component
{
    public LengthAwarePaginator $serviceslist;

    public function __construct($perPage, $catId)
    {
        $this->serviceslist = Service::with(['items', 'category'])->where('type', 'service')
            ->where('category_id', $catId)
            ->latest()
            ->paginate($perPage);


        // Transform the items inside the paginator
        $this->serviceslist->setCollection(
            $this->serviceslist->getCollection()->transform(function ($service) {
                return [
                    'id' => $service->id,
                    'name' => $service->name,
                    'description' => $service->description,
                    'slug' => $service->slug,
                    'type' => $service->type,
                    'image_url' => $service->image_url,
                    'category_name' => $service->category?->name,
                    'category_slug' => $service->category?->slug,
                ];
            })
        );
        
    }

    public function render(): View|Closure|string
    {
        return view('components.services');
    }
}
