@extends("layout")
@section("content")
    <section class="my-profile padding-top-100">
        <div class="container">
            <div class="row">
                @include('pages.logged-user.my-profile-menu')
                <div class="col-xs-12 col-sm-9">
                    My Wallet Data
                </div>
            </div>
        </div>
    </section>
@endsection