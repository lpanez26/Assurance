@extends("layout")
@section("content")
    <section class="padding-top-200 padding-bottom-60 contracts-list-section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                    <h1 class="lato-bold fs-45 padding-bottom-70 text-center">Thank You for Helping Us Change Dentistry to the Better!</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="contracts-list slider">
                        @foreach($contracts as $contract)
                            <div class="module contract-tile pending padding-bottom-10">
                                @php($dentist = (new \App\Http\Controllers\APIRequestsController())->getUserData($contract->dentist_id))
                                <div class="tile-wrapper  fs-0">
                                    <figure itemscope="" itemtype="http://schema.org/ImageObject" class="inline-block-top">
                                        <img alt="Dentist avatar" src="{{$dentist->avatar_url}}"/>
                                        <figcaption class="fs-14 blue-green-color calibri-light text-center padding-left-5 padding-right-5">Pending</figcaption>
                                    </figure>
                                    <div class="contract-info inline-block-top">
                                        <div class="calibri-bold fs-18">Dr. {{$dentist->name}}</div>
                                        <time class="display-block fs-14 calibri-light">Sent on: {{$contract->created_at->format('d.m.Y')}}</time>
                                        <div class="lato-semibold fs-24 padding-top-5 padding-bottom-5">{{$contract->monthly_premium}}$</div>
                                        <div class="btn-container">
                                            <a href="javascript:void(0)" class="white-blue-green-btn">Details and Sign</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="open-new-assurance-contact-section padding-top-50 padding-bottom-50">
        <div class="container">
            <div class="row">
                <h2 class="lato-bold fs-45 text-center">OPEN A NEW ASSURANCE CONTRACT</h2>
                <div class="text-center fs-35 lato-regular padding-bottom-50">Find Your Dentist or Invite Them to Enroll!</div>
            </div>
            <div class="row">
                @if(!empty($clinics))
                    <div class="col-xs-12 col-sm-6 col-sm-offset-3 padding-bottom-40">
                        <select class="combobox custom-input green-arrow-background">
                            <option></option>
                            @foreach($clinics as $clinic)
                                <option value="{{$clinic->id}}">{{$clinic->name}}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <section class="invite-dentists-section padding-top-50 padding-bottom-50">
        <figure itemscope="" itemtype="http://schema.org/ImageObject" class="absolute-right-side">
            <img src="/assets/uploads/dentist.png" alt="Dentist"/>
        </figure>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-sm-offset-4">
                    <div class="form-container">
                        <h3 class="lato-bold fs-40">CAN’T FIND YOUR DENTIST? Invite Them and Earn 20K Dentacoin!</h3>
                        <div class="fs-20 padding-top-15 padding-bottom-40 subtitle">Help us change dentistry to the better by inviting dentists you believe could be interested. For each accepted invitation, you will receive 20,000 Dentacoin.</div>
                        @include('partials.invite-dentists-form', ['redirect' => 'patient-access'])
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

