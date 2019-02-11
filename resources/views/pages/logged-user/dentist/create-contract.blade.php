@extends("layout")
@section("content")
    <section class="padding-top-100 padding-bottom-50">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="lato-bold fs-45 text-center black-color padding-bottom-50">Create Assurance Contract</h1>
                </div>
            </div>
        </div>
        @include('partials.contract-creation-steps')
        @php($current_logged_dentist = (new \App\Http\Controllers\APIRequestsController())->getUserData(session('logged_user')['id']))
        <div class="container steps-body">
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                    <form method="POST" enctype="multipart/form-data" action="{{route('store-and-submit-temporally-contract')}}" id="dentist-create-contract" class="wrapper padding-top-40 padding-bottom-60">
                        @include('pages.logged-user.dentist.contract-creation-step-one')
                        @include('pages.logged-user.dentist.contract-creation-step-two')
                        @include('pages.logged-user.dentist.contract-creation-step-three')
                        @include('pages.logged-user.dentist.contract-creation-step-four')
                        <div class="text-center form-btn-container padding-top-40">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <a href="javascript:void(0);" data-current-step="one" class="white-blue-green-btn min-width-250 next">NEXT</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection