@extends("layout")
@section("content")
    <section class="my-profile">
        @include('pages.logged-user.my-profile-menu')
        <div class="col-xs-12 col-sm-9">
            My Wallet Data
        </div>
    </section>
@endsection