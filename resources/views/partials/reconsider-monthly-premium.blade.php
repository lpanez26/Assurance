<form method="POST" id="submit-reconsider-monthly-premium" action="{{route('submit-reconsider-monthly-premium')}}">
    <div class="text-center padding-bottom-50 padding-top-25"><i class="fa fa-envelope fs-40 blue-green-color margin-right-10" aria-hidden="true"></i> <span class="fs-40 lato-regular">Contact Your Dentist</span></div>
    <div class="border-bottom calibri-bold fs-20 padding-top-15 padding-bottom-15"><span class="fs-18 light-gray-color">Receiver:</span> Dr. {{$dentist->name}} ({{$dentist->email}})</div>
    <div class="border-bottom fs-20 padding-top-15 padding-bottom-15"><span class="fs-18 light-gray-color calibri-bold">Subject:</span> Reconsider Monthly Premium Proposal</div>
    <div class="padding-top-15 padding-bottom-50 fs-18 calibri-light max-width-450">
        I have successfully received my Assurance Contract Sample, but I’d like to suggest a monthly premium of <input step="0.01" type="number" id="new-usd-proposal-to-dentist" name="new-usd-proposal-to-dentist"/> USD in Dentacoin (DCN).
        <br><br>
        I hope you will reconsider your proposal.
        <br><br>
        Regards,<br>
        <span class="calibri-bold">{{(new \App\Http\Controllers\APIRequestsController())->getUserData(session('logged_user')['id'])->name}}</span>
    </div>
    <div class="btn-container text-center">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="dentist-name" value="{{$dentist->name}}">
        <input type="hidden" name="dentist-email" value="{{$dentist->email}}">
        <input type="hidden" name="contract" value="{{$contract->slug}}">
        <input type="submit" class="white-blue-green-btn min-width-220" value="SEND"/>
    </div>
</form>