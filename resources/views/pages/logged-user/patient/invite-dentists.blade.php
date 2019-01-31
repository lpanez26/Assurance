@extends("layout")
@section("content")
    <section class="invite-dentists padding-top-100">
        <div class="container">
            <div class="row">
                {{var_dump((new \App\Http\Controllers\APIRequestsController())->getUserData(session('logged_user')['id']))}}
                <div class="col-xs-12 col-sm-10 col-sm-offset-1 fs-0">
                    @include('pages.logged-user.my-profile-menu')
                    <div class="my-profile-page-content inline-block-top">
                        <div class="profile-page-title">
                            <figure itemscope="" itemtype="http://schema.org/ImageObject" class="inline-block">
                                <img alt="Add dentist" src="/assets/uploads/add-dentist.svg"/>
                            </figure>
                            <h2 class="fs-24 lato-bold inline-block">Invite Dentists</h2>
                        </div>
                        <div class="fs-18 padding-top-40 padding-bottom-20">Help us change dentistry to the better by inviting dentists you believe could be interested. For each accepted invitation, you will receive 20,000 Dentacoin.</div>
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
                            <div class="btn-container text-center">
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