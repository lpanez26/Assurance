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
    </section>
@endsection