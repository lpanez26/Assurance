@extends("layout")
@section("content")
    <section class="my-profile padding-top-100">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1 fs-0">
                    @include('pages.logged-user.my-profile-menu')
                    <div class="my-profile-page-content padding-bottom-50 inline-block-top">
                        <div class="profile-page-title">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject" class="inline-block">
                                <img alt="Wallet icon" src="/assets/uploads/wallet-icon.svg"/>
                            </figure>
                            <h2 class="fs-24 lato-bold inline-block">My Wallet</h2>
                        </div>
                        <h3 class="line-crossed margin-bottom-50">Dentacoin balance</h3>

                        <h3 class="line-crossed margin-bottom-20 margin-top-50">Withdraw Dentacoin</h3>
                        <div class="fs-16">In order to withdraw your DCN you need to verify your account. We use Civic - a Blockchain-based identity platform that guarantees us that a person can have only one account on our platform. Please start by downloading the Civic app on your smartphone using the links below and add an email address or phone number to your Civic account. Then click the "Login with Civic" button below and use the app to scan the QR code.</div>
                        <div class="fs-16 padding-top-10 padding-bottom-10">1. Download and install Civic</div>
                        <div class="">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject" class="inline-block max-width-160 padding-right-15 padding-bottom-15">
                                <img alt="Google play button" src="/assets/uploads/google-play.png"/>
                            </figure>
                            <figure itemscope="" itemtype="http://schema.org/ImageObject" class="inline-block max-width-160 padding-bottom-15">
                                <img alt="App store button" src="/assets/uploads/app-store.png"/>
                            </figure>
                        </div>
                        <div class="padding-bottom-10 fs-16">2. Click the button below and scan the QR code. Please be patient, the validation procedure may take up to 3 minutes.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection