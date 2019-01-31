@extends("layout")
@section("content")
    <section class="manage-privacy padding-top-100">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1 fs-0">
                    @include('pages.logged-user.my-profile-menu')
                    <div class="my-profile-page-content inline-block-top">
                        <div class="profile-page-title">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject" class="inline-block">
                                <img alt="Contracts list" src="/assets/uploads/contracts-list.svg"/>
                            </figure>
                            <h2 class="fs-24 lato-bold inline-block">My contracts</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection