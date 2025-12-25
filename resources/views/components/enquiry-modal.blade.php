<div id="enquiryModal" class="modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <h5 class="modal-title">Enquiry Form For Franchise</h5>
        <form class="modal-form" id="modal-form">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Name" name="name" required>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Email" name="email" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Phone" name="phone" required>
            </div>
            <div class="form-group">
                <select class="modal-content form-control state-dropdown" name="enq_for">
                    <option value="">Select occupation</option>
                    @forelse ($dropdownItems as $item)
                        <option value="{{ $item->title }}">{{ $item->title }}</option>
                    @empty
                        <option value="">No options available</option>
                    @endforelse
                </select>
            </div>
            <div class="form-group">
                <select class="modal-content form-control" name="state">
                    <option value="">Select State</option>
                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                    <option value="Assam">Assam</option>
                    <option value="Bihar">Bihar</option>
                    <option value="Chhattisgarh">Chhattisgarh</option>
                    <option value="Goa">Goa</option>
                    <option value="Gujarat">Gujarat</option>
                    <option value="Haryana">Haryana</option>
                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                    <option value="Jharkhand">Jharkhand</option>
                    <option value="Karnataka">Karnataka</option>
                    <option value="Kerala">Kerala</option>
                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                    <option value="Maharashtra">Maharashtra</option>
                    <option value="Manipur">Manipur</option>
                    <option value="Meghalaya">Meghalaya</option>
                    <option value="Mizoram">Mizoram</option>
                    <option value="Nagaland">Nagaland</option>
                    <option value="Odisha">Odisha</option>
                    <option value="Punjab">Punjab</option>
                    <option value="Rajasthan">Rajasthan</option>
                    <option value="Sikkim">Sikkim</option>
                    <option value="Tamil Nadu">Tamil Nadu</option>
                    <option value="Telangana">Telangana</option>
                    <option value="Tripura">Tripura</option>
                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                    <option value="Uttarakhand">Uttarakhand</option>
                    <option value="West Bengal">West Bengal</option>
                    <option value="Andaman & Nicobar Islands">Andaman & Nicobar Islands
                    </option>
                    <option value="Chandigarh">Chandigarh</option>
                    <option value="Dadra & Nagar Haveli">Dadra & Nagar Haveli</option>
                    <option value="Daman & Diu">Daman & Diu</option>
                    <option value="Delhi">Delhi</option>
                    <option value="Jammu & Kashmir">Jammu & Kashmir</option>
                    <option value="Ladakh">Ladakh</option>
                    <option value="Lakshadweep">Lakshadweep</option>
                    <option value="Puducherry">Puducherry</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="City" name="city" />
            </div>
            <div class="form-group">
                <textarea class="form-control" placeholder="Message" rows="3" name="message"></textarea>
            </div>
            <button type="submit" class="modal-submit-btn">Submit</button>
        </form>
    </div>
</div>