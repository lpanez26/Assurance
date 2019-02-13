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
        </div>{{--
        <div class="container contract-creation-steps-container">
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                    <button class="inline-block active" data-step="one">1. REVIEW CONTACTS</button>
                    <span class="separator inline-block"></span>
                    <button class="inline-block not-passed not-allowed-cursor" data-step="two">2. SIGN CONTRACT</button>
                    <span class="separator inline-block"></span>
                    <button class="inline-block not-passed not-allowed-cursor" data-step="three">3. FIRST TRANSACTION</button>
                    <span class="separator inline-block"></span>
                    <button class="inline-block not-passed not-allowed-cursor" data-step="four">4. ???????</button>
                </div>
            </div>
        </div>--}}
        <div class="container padding-top-40">
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                    <div class="wrapper padding-top-50 padding-bottom-60">
                        <div class="top-right-page-alike"></div>
                        @include('pages.logged-user.patient.contract-review-step-one', ['shown' => $shown])
                        {{--@include('pages.logged-user.patient.contract-review-step-two', ['shown' => $shown])--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
