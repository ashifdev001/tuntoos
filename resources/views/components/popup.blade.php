<form class="fixed-form" id="popupForm">
    <h3>Request Free Demo</h3>
    <div class="dzFormMsg"></div>
    <input type="text" placeholder="Name" name="name" id="name" required>
    <input type="text" placeholder="Mobile Number" name="phone" id="phone" required>
    <input type="email" placeholder="Email" required>
    <select name="type" id="type" required>
        <option value="" disabled selected>BHK TYPE</option>
        <option value="1BHK">1 BHK</option>
        <option value="2BHK">2 BHK</option>
        <option value="3BHK">3 BHK</option>
        <option value="4BHK">4 BHK</option>
    </select>
    <select id="service_category_id" name="service_category_id" required>
        <option value="" disabled selected>Service TYPE</option>
        @forelse ($service_categories as $category)
            <option value="{{ $category->id }}">{{ $category->title }}</option>
        @empty
        @endforelse
    </select>
    <!-- <textarea placeholder="Describe your requirement" required></textarea> -->
    <button type="button" class="close" aria-label="Close"
        onclick="this.closest('form').reset(); this.closest('form').style.display='none';">
        <span aria-hidden="true">&times;</span>
    </button>
    <button type="submit">Book Free Demo</button>
</form>