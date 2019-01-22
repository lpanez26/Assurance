@extends("layout")
@section("content")
    <section class="section-logged-patient-form">
        <h1 class="fs-45 lato-bold text-center padding-top-110">Let's Start with a First Contract!</h1>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-sm-offset-3 padding-top-20 padding-bottom-40">
                    <input type="text" class="green-arrow-background search-dentist-input" placeholder="Find your preferred dentist/s in a snap"/>
                </div>
                <div class="col-xs-12 col-sm-8 col-sm-offset-2 form">
                    <form class="padding-top-50 padding-bottom-50 margin-left-40 margin-right-40 white-color-background">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                                    <h2 class="fs-40 lato-bold text-center">Invite Your Dentist. Earn 20,000 DCN!</h2>
                                    <h3 class="fs-20 padding-top-20 padding-bottom-40 text-center">Help us change dentistry to the better by inviting new dentists. For each accepted invitation, you will receive a reward!</h3>
                                    <div class="padding-bottom-10">
                                        <input type="text" placeholder="Your Dentist's Name"/>
                                    </div>
                                    <div class="padding-bottom-10">
                                        <input type="text" placeholder="Your Dentist's Website"/>
                                    </div>
                                    <div class="padding-bottom-10">
                                        <input type="text" placeholder="Your Dentist's Email"/>
                                    </div>
                                    <div class="padding-bottom-30">
                                        <input type="text" placeholder="Your Dentist's Phone"/>
                                    </div>
                                    <div class="padding-bottom-10">
                                        <input type="text" placeholder="Your Wallet Address"/>
                                    </div>
                                    <div class="fs-13">*We need it in order to send your reward upon your dentist’s registration. Don’t have a wallet yet? Create one at <a href="" class="blue-green-color">here</a> or see <a href="" class="blue-green-color">instructions</a>.</div>
                                    <div class="btn-container padding-top-30 text-center">
                                        <input type="submit" value="SEND" class="white-blue-green-btn min-width-180"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="white-bottom-background"></div>
    </section>
    <section class="logged-patient-your-benefits text-center">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="lato-bold fs-50 padding-top-40 padding-bottom-30">Your Benefits</h2>
                </div>
            </div>
        </div>
        <div class="custom-grid fs-0">
            <div class="cell inline-block">
                <div class="cell-wrapper solid-gray-color-background">
                    <figure itemscope="" itemtype="http://schema.org/ImageObject">
                        <img alt="" itemprop="contentUrl" src="/assets/uploads/patient-benefit-1.svg" class="max-width-80"/>
                        <figcaption class="fs-18 line-height-20 padding-top-20">Affordable monthly payments</figcaption>
                    </figure>
                </div>
            </div>
            <div class="cell inline-block">
                <div class="cell-wrapper solid-gray-color-background">
                    <figure itemscope="" itemtype="http://schema.org/ImageObject">
                        <img alt="" itemprop="contentUrl" src="/assets/uploads/patient-benefit-2.svg" class="max-width-80"/>
                        <figcaption class="fs-18 line-height-20 padding-top-20">Prevention-focused dental care</figcaption>
                    </figure>
                </div>
            </div>
            <div class="cell inline-block">
                <div class="cell-wrapper solid-gray-color-background">
                    <figure itemscope="" itemtype="http://schema.org/ImageObject">
                        <img alt="" itemprop="contentUrl" src="/assets/uploads/patient-benefit-3.svg" class="max-width-80"/>
                        <figcaption class="fs-18 line-height-20 padding-top-20">Wide range of services covered</figcaption>
                    </figure>
                </div>
            </div>
            <div class="cell inline-block">
                <div class="cell-wrapper solid-gray-color-background">
                    <figure itemscope="" itemtype="http://schema.org/ImageObject">
                        <img alt="" itemprop="contentUrl" src="/assets/uploads/patient-benefit-4.svg" class="max-width-80"/>
                        <figcaption class="fs-18 line-height-20 padding-top-15">Personalized recommendation</figcaption>
                    </figure>
                </div>
            </div>
            <div class="cell inline-block">
                <div class="cell-wrapper solid-gray-color-background">
                    <figure itemscope="" itemtype="http://schema.org/ImageObject">
                        <img alt="" itemprop="contentUrl" src="/assets/uploads/patient-benefit-5.svg" class="max-width-80"/>
                        <figcaption class="fs-18 line-height-20 padding-top-25">Compatible with other insurances</figcaption>
                    </figure>
                </div>
            </div>
            <div class="cell inline-block">
                <div class="cell-wrapper solid-gray-color-background">
                    <figure itemscope="" itemtype="http://schema.org/ImageObject">
                        <img alt="" itemprop="contentUrl" src="/assets/uploads/patient-benefit-6.svg" class="max-width-80"/>
                        <figcaption class="fs-18 line-height-20 padding-top-20">Free and easy cancellation</figcaption>
                    </figure>
                </div>
            </div>
        </div>
    </section>
@endsection

