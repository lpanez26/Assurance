<div class="four step">
    <div class="top-right-page-alike"></div>
    <h2 class="text-center lato-bold fs-30 padding-bottom-45 blue-green-color">ASSURANCE CONTRACT SAMPLE</h2>
    <h3 class="calibri-bold fs-30 dark-color">YOUR DETAILS</h3>
    <div class="step-fields module padding-top-20">
        <div class="single-row fs-0">
            <label class="calibri-light inline-block light-gray-color fs-16 padding-right-15 margin-bottom-0">Name:</label>
            <div class="right-extra-field calibri-bold fs-25 dark-color inline-block">{{(new \App\Http\Controllers\APIRequestsController())->getUserData(session('logged_user')['id'])->name}}</div>
        </div>
        <div class="single-row fs-0">
            <label class="calibri-light inline-block light-gray-color fs-16 padding-right-15 margin-bottom-0">Professional/Company Registration Number:</label>
            <div class="right-extra-field calibri-regular fs-18 dark-color inline-block" id="professional-company-number"></div>
        </div>
        <div class="single-row fs-0">
            <label class="calibri-light inline-block light-gray-color fs-16 padding-right-15 margin-bottom-0">Postal Address:</label>
            <div class="right-extra-field calibri-regular fs-18 dark-color inline-block" id="postal-address"></div>
        </div>
        <div class="single-row fs-0">
            <label class="calibri-light inline-block light-gray-color fs-16 padding-right-15 margin-bottom-0">Country:</label>
            <div class="right-extra-field calibri-regular fs-18 dark-color inline-block" id="country"></div>
        </div>
        <div class="single-row fs-0">
            <label class="calibri-light inline-block light-gray-color fs-16 padding-right-15 margin-bottom-0">Phone:</label>
            <div class="right-extra-field calibri-regular fs-18 dark-color inline-block" id="phone"></div>
        </div>
        <div class="single-row fs-0">
            <label class="calibri-light inline-block light-gray-color fs-16 padding-right-15 margin-bottom-0">Website:</label>
            <div class="right-extra-field calibri-regular fs-18 dark-color inline-block" id="website"></div>
        </div>
        <div class="single-row fs-0">
            <label class="calibri-light inline-block light-gray-color fs-16 padding-right-15 margin-bottom-0">Wallet Address:</label>
            <div class="right-extra-field calibri-regular fs-18 dark-color inline-block" id="address"></div>
        </div>
        <div class="fs-14 calibri-light light-gray-color padding-top-10">This is the wallet where you will receive your monthly premiums. Please double-check if everything is correct.</div>
        <div class="fs-14 calibri-light light-gray-color">You don’t have a wallet? <a href="//wallet.dentacoin.com" target="_blank">Create one here.</a></div>
        <h3 class="calibri-bold fs-30 dark-color padding-top-50">PATIENT DETAILS</h3>
        <div class="single-row fs-0">
            <label class="calibri-light inline-block light-gray-color fs-16 padding-right-15 margin-bottom-0">First Name:</label>
            <div class="right-extra-field calibri-bold fs-25 dark-color inline-block" id="fname"></div>
        </div>
        <div class="single-row fs-0">
            <label class="calibri-light inline-block light-gray-color fs-16 padding-right-15 margin-bottom-0">Last Name:</label>
            <div class="right-extra-field calibri-bold fs-25 dark-color inline-block" id="lname"></div>
        </div>
        <div class="single-row fs-0">
            <label class="calibri-light inline-block light-gray-color fs-16 padding-right-15 margin-bottom-0">Email Address:</label>
            <div class="right-extra-field calibri-regular fs-18 dark-color inline-block" id="email"></div>
        </div>
        <h3 class="calibri-bold fs-30 dark-color padding-top-50">CONTRACT CONDITIONS</h3>
        <div class="single-row fs-0">
            <label class="calibri-light light-gray-color fs-16 padding-right-15 padding-top-0 margin-bottom-0 inline-block">Services Covered:</label>
            <div class="right-extra-field checkboxes-right-container calibri-regular fs-18 dark-color inline-block">
                <div class="pretty margin-bottom-5 p-svg p-curve on-white-background">
                    <input type="checkbox" id="param_gd" checked disabled/>
                    <div class="state p-success">
                        <!-- svg path -->
                        <svg class="svg svg-icon" viewBox="0 0 20 20">
                            <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
                        </svg>
                        <label class="fs-18 calibri-light">General Dentistry</label>
                    </div>
                </div>
                <div class="pretty margin-bottom-5 p-svg p-curve on-white-background">
                    <input type="checkbox" id="param_cd" checked disabled/>
                    <div class="state p-success">
                        <!-- svg path -->
                        <svg class="svg svg-icon" viewBox="0 0 20 20">
                            <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
                        </svg>
                        <label class="fs-18 calibri-light">Cosmetic Dentistry</label>
                    </div>
                </div>
                <div class="pretty margin-bottom-5 p-svg p-curve on-white-background">
                    <input type="checkbox" id="param_id" checked disabled/>
                    <div class="state p-success">
                        <!-- svg path -->
                        <svg class="svg svg-icon" viewBox="0 0 20 20">
                            <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
                        </svg>
                        <label class="fs-18 calibri-light">Implant Dentistry</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="single-row fs-0">
            <label class="calibri-light inline-block light-gray-color fs-16 padding-right-15 margin-bottom-0">Monthly Premium:</label>
            <div class="right-extra-field calibri-bold fs-25 dark-color inline-block"><span id="monthly-premium"></span> USD</div>
        </div>
        <div class="single-row fs-0">
            <div class="fs-14 calibri-light light-gray-color padding-top-5">Based on the services covered, the average monthly rate in your country is <span class="calibri-bold blue-green-color">50 USD</span> in Dentacoin (DCN).</div>
            <div class="fs-14 calibri-light light-gray-color padding-bottom-25">You are free to propose a different rate to your patient.</div>
        </div>
        <div class="single-row fs-0">
            <label class="calibri-light inline-block light-gray-color fs-16 padding-right-15 margin-bottom-0">Required Check-ups per Year:</label>
            <<div class="right-extra-field calibri-regular fs-18 dark-color inline-block" id="check-ups-per-year"></div>
        </div>
        <div class="single-row fs-0">
            <label class="calibri-light inline-block light-gray-color fs-16 padding-right-15 margin-bottom-0">Required Teeth Cleaning per Year:</label>
            <div class="right-extra-field calibri-regular fs-18 dark-color inline-block" id="teeth-cleaning-per-year"></div>
        </div>
        <div class="single-row fs-0">
            <label class="calibri-light inline-block light-gray-color fs-16 padding-right-15 margin-bottom-0">Required Successful Dentacare Journeys:</label>
            <div class="right-extra-field calibri-regular fs-18 dark-color inline-block">1 (90 days)</div>
        </div>
        <h3 class="calibri-bold fs-30 dark-color padding-top-50">TERMS AND CONDITIONS</h3>
        <div style="height: 350px;" class="terms-and-conditions-long-list margin-top-30 margin-bottom-60">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passam Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            <br><br>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more reunknown printer took a printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop psetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            <br><br>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            <br><br>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            <br><br>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
        </div>
        <div class="checkbox-container">
            <div class="pretty p-svg p-curve on-white-background inline-block-important">
                <input type="checkbox" id="terms"/>
                <div class="state p-success">
                    <svg class="svg svg-icon" viewBox="0 0 20 20">
                        <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
                    </svg>
                    <label class="fs-16 calibri-bold">I have read and accept the Terms and Conditions</label>
                </div>
            </div>
        </div>
        <div class="checkbox-container">
            <div class="pretty p-svg p-curve on-white-background inline-block-important">
                <input type="checkbox" id="privacy-policy"/>
                <div class="state p-success">
                    <svg class="svg svg-icon" viewBox="0 0 20 20">
                        <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
                    </svg>
                    <label class="fs-16 calibri-bold">I have read and accept the <a href="//dentacoin.com/privacy-policy" target="_blank" class="blue-green-color">Privacy Policy</a></label>
                </div>
            </div>
        </div>
    </div>
</div>