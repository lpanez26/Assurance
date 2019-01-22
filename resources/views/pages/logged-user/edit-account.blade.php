@extends("layout")
@section("content")
    <section class="edit-account padding-top-100">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    @include('pages.logged-user.my-profile-menu')
                    <div class="my-profile-page-content inline-block-top">
                        EDIT ACCOUTN
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection