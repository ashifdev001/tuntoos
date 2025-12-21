<section class="help-area">
    <div class="ribbon-row">
        <div class="container-left">
            <div class="triangle"></div>
            <div class="block-extension ">
                <div class="cnt-bx">
                    <h1>need help? we’re <br>
                        available 24/7</h1>
                    <p>
                        Lorem ipsum dolor sit amet, coLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                        nostrud exercitation
                    </p>
                </div>
                <div class="infor">
                   {{--  <div class="zip-code">
                        <input type="text" name="" placeholder="Enter your Mobile Number">
                        <button class="go-button" type="submit">go</button>
                    </div>
                    <div class="or">or</div> --}}
                    <div class="call-col">
                        <h2>Call us</h2>
                        <a href="tel:{{$helpData['site_phone']}}"><h1>{{ $helpData['site_phone'] }}</h1></a>
                    </div>
                </div>

            </div>
        </div>
        <div class="container-right">

            <div class="block-extension"></div>
            <div class="img-holder">
                <img src="{{asset('/assets/frontend')}}/img/resource/pstman.png" alt="">
            </div>
        </div>
    </div>
</section>