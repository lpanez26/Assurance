@extends("layout")
@section("content")
    <section class="invite-dentists-container padding-top-100">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1 fs-0">
                    @include('pages.logged-user.my-profile-menu')
                    <div class="my-profile-page-content inline-block-top">
                        <div class="profile-page-title padding-bottom-50">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject" class="inline-block">
                                <img alt="Add dentist" src="/assets/uploads/add-dentist.svg"/>
                            </figure>
                            <h2 class="fs-24 lato-bold inline-block">Invite Dentists</h2>
                        </div>
                        <div class="fs-18 padding-bottom-30">Help us change dentistry to the better by inviting dentists you believe could be interested. For each accepted invitation, you will receive 20,000 Dentacoin.</div>
                        <form method="POST" enctype="multipart/form-data" id="invite-dentists" action="{{route('submit-invite-dentists')}}">
                            <div class="form-row padding-bottom-15 fs-0">
                                <input class="fs-16 custom-input" maxlength="100" type="text" name="dentist-name" placeholder="Your Dentist's Name"/>
                            </div>
                            <div class="form-row padding-bottom-15 fs-0">
                                <input class="fs-16 custom-input" maxlength="250" type="url" name="website" placeholder="Your Dentist's Website"/>
                            </div>
                            <div class="form-row padding-bottom-15 fs-0">
                                <input class="fs-16 custom-input" maxlength="100" type="email" name="email" placeholder="Your Dentist's Email"/>
                            </div>
                            <div class="form-row padding-bottom-15 fs-0">
                                <input class="fs-16 custom-input" maxlength="100" type="number" name="phone" placeholder="Your Dentist's Phone"/>
                            </div>
                            @php($dcn_address = (new \App\Http\Controllers\APIRequestsController())->getUserData(session('logged_user')['id'])->dcn_address)
                            @if(empty($dcn_address))
                                <div class="form-row padding-top-15 padding-bottom-15 fs-0">
                                    <input class="fs-16 custom-input" maxlength="42" type="number" name="dcn_address" placeholder="Your Wallet Address"/>
                                    <div class="fs-13 padding-top-5">*We need it in order to send you your reward when your dentist registers.</div>
                                    <div class="fs-13">Don’t have a wallet yet? Create one at <a href="https://wallet.dentacoin.com/" class="lato-semibold blue-green-color" target="_blank">www.wallet.dentacoin.com</a>.</div>
                                </div>
                            @endif
                            <div class="btn-container padding-top-40">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="submit" value="SEND" class="white-blue-green-btn"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection