@extends("layout")
@section("content")
    <section class="manage-privacy padding-top-100">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 fs-0">
                    @include('pages.logged-user.my-profile-menu')
                    <div class="my-profile-page-content inline-block-top">
                        <div class="profile-page-title">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject" class="inline-block">
                                <img alt="Privacy icon" src="/assets/uploads/privacy-icon.svg"/>
                            </figure>
                            <h2 class="fs-26 lato-semibold inline-block">Manage privacy</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection