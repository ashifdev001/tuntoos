<div class="section-full content-inner-2 appointment-1 overlay-gradient-dark"
    style="background-image:url({{asset('/assets/frontend')}}/images/background/bg3.jpg);">
    <div class="container">
        <div class="section-head text-center text-white">
            <h2>Make An Appointment</h2>
            <div class="separator bg-yellow-l"></div>
            <p>Don’t hesitate to ask us, just leave an email here. We’re always glad to hear from you.</p>
        </div>
        <div class="section-content contact-form-bx">
            <div class="bg-white clearfix mack-an-appointment">
                <div class="dezPlaceAni">
                    <div class="dzFormMsg"></div>
                    <form method="post" id="appointmentForm" action="">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label>Your Name</label>
                                        <input name="name" id="name" type="text" required="" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label>Phone</label>
                                        <input name="phone" id="phone" type="text" required="" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <select class="bs-select-hidden" name="type" id="type">
                                            <option value="" disabled selected>BHK TYPE</option>
                                            <option value="1BHK">1 BHK</option>
                                            <option value="2BHK">2 BHK</option>
                                            <option value="3BHK">3 BHK</option>
                                            <option value="4BHK">4 BHK</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <select class="bs-select-hidden" name="service_category_id"
                                            id="service_category_id">
                                            @forelse ($service_categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label>Your Message...</label>
                                        <textarea name="message" rows="4" class="form-control" required=""
                                            placeholder=""></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                <button name="submit" type="submit" value="Submit" class="site-button button-md">Submit
                                    Now</button>
                                <button name="submit" type="reset" value="Submit"
                                    class="site-button-secondry button-md">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>