@extends("layout")
@section("content")
    <section class="invite-dentists-container padding-top-100">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1 fs-0">
                    @include('partials.my-profile-menu')
                    <div class="my-profile-page-content inline-block-top">
                        <div class="profile-page-title padding-bottom-50">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject" class="inline-block">
                                <img alt="Add dentist" src="/assets/uploads/add-dentist.svg"/>
                            </figure>
                            <h2 class="fs-24 lato-bold inline-block">Invite Dentists</h2>
                        </div>
                        <div class="fs-18 padding-bottom-30">Help us change dentistry to the better by inviting dentists you believe could be interested. For each accepted invitation, you will receive 20,000 Dentacoin.</div>
                        @include('partials.invite-dentists-form')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection