@extends("layout")
@section("content")
    @php($dentist = (new \App\Http\Controllers\APIRequestsController())->getUserData($contract->dentist_id))
    @php($patient = (new \App\Http\Controllers\APIRequestsController())->getUserData(session('logged_user')['id']))
    @php($general_dentistry = unserialize($contract->general_dentistry))
    <section class="padding-top-100 padding-bottom-50 contract-proposal module">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="lato-bold fs-45 text-center padding-bottom-50">Review Assurance Contract</h1>
                </div>
            </div>
        </div>
        <div class="container padding-top-40">
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                    <div class="wrapper padding-top-50 padding-bottom-60">
                        <div class="top-right-page-alike"></div>
                        <h2 class="text-center blue-green-color fs-30 lato-bold padding-bottom-60">ASSURANCE CONTRACT SAMPLE</h2>
                        <div class="step-fields module padding-top-20">
                            <form method="POST" enctype="multipart/form-data" action="{{route('update-and-sign-contract')}}" id="dentist-update-and-sign-contract">
                                <h3 class="calibri-bold fs-30 dark-color">DENTIST DETAILS</h3>
                                <div class="single-row fs-0">
                                    <label class="calibri-light inline-block light-gray-color fs-16 padding-right-15 margin-bottom-0">Name:</label>
                                    <div class="right-extra-field calibri-bold fs-25 dark-color inline-block">{{$dentist->name}}</div>
                                </div>
                                <div class="single-row fs-0">
                                    <label class="calibri-light inline-block light-gray-color fs-16 padding-right-15 margin-bottom-0">Professional / Company Registration Number:</label>
                                    <div class="right-extra-field calibri-regular fs-18 dark-color inline-block">{{$contract->professional_company_number}}</div>
                                </div>
                                <div class="single-row fs-0">
                                    <label class="calibri-light inline-block light-gray-color fs-16 padding-right-15 margin-bottom-0">Postal Address:</label>
                                    <div class="right-extra-field calibri-regular fs-18 dark-color inline-block">{{$dentist->address}}</div>
                                </div>
                                <div class="single-row fs-0">
                                    <label class="calibri-light inline-block light-gray-color fs-16 padding-right-15 margin-bottom-0">Country:</label>
                                    <div class="right-extra-field calibri-regular fs-18 dark-color inline-block">{{$countries[$dentist->country_id - 1]->name}}</div>
                                </div>
                                <div class="single-row fs-0">
                                    <label class="calibri-light inline-block light-gray-color fs-16 padding-right-15 margin-bottom-0">Phone:</label>
                                    <div class="right-extra-field calibri-regular fs-18 dark-color inline-block">{{$dentist->phone}}</div>
                                </div>
                                <div class="single-row fs-0">
                                    <label class="calibri-light inline-block light-gray-color fs-16 padding-right-15 margin-bottom-0">Website:</label>
                                    <div class="right-extra-field calibri-regular fs-18 dark-color inline-block">
                                        <a href="{{$dentist->website}}" target="_blank">{{$dentist->website}}</a>
                                    </div>
                                </div>
                                <div class="single-row fs-0">
                                    <label class="calibri-light inline-block light-gray-color fs-16 padding-right-15 margin-bottom-0">Wallet Address:</label>
                                    <div class="right-extra-field calibri-regular fs-18 dark-color inline-block">
                                        <a href="//etherscan.io/address/{{$dentist->dcn_address}}" target="_blank">{{$dentist->dcn_address}}</a>
                                    </div>
                                </div>
                                <div class="fs-14 calibri-light light-gray-color padding-top-5">This is the wallet where you will automatically transfer your monthly premiums to.</div>
                                <h3 class="calibri-bold fs-30 dark-color padding-top-70">PATIENT DETAILS</h3>
                                <div class="single-row fs-0">
                                    <label class="calibri-light inline-block light-gray-color fs-16 padding-right-15 margin-bottom-0">First Name:</label>
                                    <div class="right-extra-field calibri-bold fs-25 dark-color inline-block">{{$contract->patient_fname}}</div>
                                </div>
                                <div class="single-row fs-0">
                                    <label class="calibri-light inline-block light-gray-color fs-16 padding-right-15 margin-bottom-0">Last Name:</label>
                                    <div class="right-extra-field calibri-bold fs-25 dark-color inline-block">{{$contract->patient_lname}}</div>
                                </div>
                                <div class="single-row fs-0">
                                    <label class="calibri-light inline-block light-gray-color fs-16 padding-right-15 margin-bottom-0">Email Address:</label>
                                    <div class="right-extra-field calibri-regular fs-18 dark-color inline-block">{{$contract->patient_email}}</div>
                                </div>
                                <div class="single-row fs-0">
                                    <label class="calibri-light inline-block light-gray-color fs-16 padding-right-15 margin-bottom-0 padding-top-0 padding-bottom-0">ID Number:</label>
                                    <input type="text" maxlength="20" name="patient-id-number" class="right-field required-field calibri-regular fs-18 dark-color inline-block pencil-background"/>
                                </div>
                                <div class="single-row fs-0">
                                    <label class="calibri-light inline-block light-gray-color fs-16 padding-right-15 margin-bottom-0 padding-top-0 padding-bottom-0">Postal Address:</label>
                                    <input type="text" maxlength="100" name="postal-address" class="right-field required-field calibri-regular fs-18 dark-color inline-block pencil-background"/>
                                </div>
                                <div class="single-row fs-0">
                                    <label class="calibri-light inline-block light-gray-color fs-16 padding-right-15 margin-bottom-0 @if(empty($patient->country_id)) padding-top-0 padding-bottom-0 @endif">Country:</label>
                                    @if(!empty($patient->country_id))
                                        <div class="right-extra-field calibri-regular fs-18 dark-color inline-block">{{$countries[$patient->country_id - 1]->name}}</div>
                                    @else
                                        <select class="inline-block fs-18 right-field required-field" id="country" name="country">
                                            <option disabled selected>Select country</option>
                                            @foreach($countries as $country)
                                                <option value="{{$country->code}}" data-code="{{$country->phone_code}}">{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                                <div class="single-row fs-0">
                                    <label class="calibri-light inline-block light-gray-color fs-16 padding-right-15 margin-bottom-0 @if(empty($patient->dcn_address)) padding-top-0 padding-bottom-0 @endif">Wallet Address:</label>
                                    @if(empty($patient->dcn_address))
                                        <input type="text" maxlength="42" name="dcn_address" class="right-field required-field calibri-regular fs-18 dark-color inline-block pencil-background"/>
                                    @else
                                        <div class="right-extra-field calibri-regular fs-18 dark-color inline-block">
                                            <a href="//etherscan.io/address/{{$patient->dcn_address}}" target="_blank">{{$patient->dcn_address}}</a>
                                        </div>
                                    @endif
                                </div>
                                <div class="light-gray-color fs-14 padding-top-5">This is the wallet where you will send your monthly premiums from and collect your rewards from all Dentacoin tools. Please double-check if everything is correct. You don’t have a wallet? <a href="//wallet.dentacoin.com" class="blue-green-color calibri-bold" target="_blank">Create one here.</a></div>
                                <h3 class="calibri-bold fs-30 dark-color padding-top-70">CONTRACT CONDITIONS</h3>
                                <div class="single-row fs-0 padding-top-10">
                                    <label class="calibri-light light-gray-color fs-16 padding-right-15 padding-top-0 margin-bottom-0 inline-block">Services Covered:</label>
                                    <div class="right-extra-field checkboxes-right-container calibri-regular fs-18 dark-color inline-block">
                                        <div class="pretty margin-bottom-5 p-svg p-curve on-white-background">
                                            <input type="checkbox" disabled @if(in_array('param_gd', $general_dentistry)) checked @endif/>
                                            <div class="state p-success">
                                                <!-- svg path -->
                                                <svg class="svg svg-icon" viewBox="0 0 20 20">
                                                    <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
                                                </svg>
                                                <label class="fs-18 calibri-light">General Dentistry</label>
                                            </div>
                                        </div>
                                        <div class="pretty margin-bottom-5 p-svg p-curve on-white-background">
                                            <input type="checkbox" disabled @if(in_array('param_cd', $general_dentistry)) checked @endif/>
                                            <div class="state p-success">
                                                <!-- svg path -->
                                                <svg class="svg svg-icon" viewBox="0 0 20 20">
                                                    <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
                                                </svg>
                                                <label class="fs-18 calibri-light">Cosmetic Dentistry</label>
                                            </div>
                                        </div>
                                        <div class="pretty margin-bottom-5 p-svg p-curve on-white-background">
                                            <input type="checkbox" disabled @if(in_array('param_id', $general_dentistry)) checked @endif/>
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
                                    <div class="right-extra-field calibri-bold fs-25 dark-color inline-block">{{$contract->monthly_premium}} USD</div>
                                </div>
                                <div class="single-row fs-14 light-gray-color calibri-light padding-top-10 padding-bottom-40">You are not satisfied with the rate offered? <a href="" class="calibri-bold blue-green-color">Contact your dentist.</a> </div>
                                <div class="single-row flex-row fs-0">
                                    <label class="calibri-light light-gray-color fs-16 padding-right-15 margin-bottom-0">Required Check-ups per Year:</label>
                                    <div class="right-extra-field calibri-regular fs-18 dark-color inline-block">{{$contract->check_ups_per_year}}</div>
                                </div>
                                <div class="single-row flex-row fs-0">
                                    <label class="calibri-light light-gray-color fs-16 padding-right-15 margin-bottom-0">Required Teeth Cleaning per Year:</label>
                                    <div class="right-extra-field calibri-regular fs-18 dark-color inline-block">{{$contract->teeth_cleaning_per_year}}</div>
                                </div>
                                <div class="single-row flex-row fs-0">
                                    <label class="calibri-light light-gray-color fs-16 padding-right-15 margin-bottom-0">Required Successful Dentacare Journeys:</label>
                                    <div class="right-extra-field calibri-regular fs-18 dark-color inline-block">1 (90 days)</div>
                                </div>
                                <h3 class="calibri-bold fs-30 dark-color padding-top-70">TERMS AND CONDITIONS</h3>
                                <div style="height: 350px;" class="terms-and-conditions-long-list margin-top-30 margin-bottom-60">
                                    @include('partials.contract-terms-and-conditions')
                                </div>
                                <div class="singatures-row fs-0">
                                    <div class="dentist-sign inline-block">
                                        <figure itemscope="" itemtype="http://schema.org/ImageObject">
                                            <img src="/assets/contracts/{{$contract->slug}}/dentist-signature.png" alt="Dentist signature"/>
                                            <figcaption class="fs-16 calibri-light">/Dr. {{$dentist->name}}/</figcaption>
                                        </figure>
                                    </div>
                                    <div class="signature-wrapper inline-block module">
                                        <div class="calibri-bold fs-26 text-center">Sign below</div>
                                        <div class="calibri-light fs-16 text-center light-gray-color padding-bottom-15">Use your mouse or touch screen to sign.</div>
                                        <canvas id="signature-pad" class="signature-pad"></canvas>
                                        <a href="javascript:void(0)" class="blue-green-color calibri-bold fs-18 clear-signature">Clear</a>
                                    </div>
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
                                <div class="text-center padding-top-50">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="patient_signature"/>
                                    <input type="hidden" name="contract" value="{{$contract->slug}}"/>
                                    <input type="submit" value="SIGN CONTRACT" class="white-blue-green-btn min-width-250"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
