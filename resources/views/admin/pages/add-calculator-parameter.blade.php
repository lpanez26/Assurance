@extends("admin.layout")
@section("content")
    <section class="content add-edit-menu-element">
        <h1>Add calculator parameter</h1>
        <ul style="padding-left: 15px;font-weight: bold;padding-bottom: 15px;">
            <li>GD - General Dentistry</li>
            <li>CD - Cosmetic Dentistry</li>
            <li>ID - Implant Dentistry</li>
        </ul>
        <form method="post" enctype="multipart/form-data" class="text-center" action="{{route('add-calculator-parameter')}}">
            <div class="form-row">
                <label>Country:<span class="required-mark">*</span></label>
                <input type="text" name="country"/>
            </div>
            <div class="form-row">
                <label>GD CD ID:<span class="required-mark">*</span></label>
                <input type="number" name="param_gd_cd_id"/>
            </div>
            <div class="form-row">
                <label>GD CD:<span class="required-mark">*</span></label>
                <input type="number" name="param_gd_cd"/>
            </div>
            <div class="form-row">
                <label>GD ID:<span class="required-mark">*</span></label>
                <input type="number" name="param_gd_id"/>
            </div>
            <div class="form-row">
                <label>CD ID:<span class="required-mark">*</span></label>
                <input type="number" name="param_cd_id"/>
            </div>
            <div class="form-row">
                <label>GD:<span class="required-mark">*</span></label>
                <input type="number" name="param_gd"/>
            </div>
            <div class="form-row">
                <label>CD:<span class="required-mark">*</span></label>
                <input type="number" name="param_cd"/>
            </div>
            <div class="form-row">
                <label>ID:<span class="required-mark">*</span></label>
                <input type="number" name="param_id"/>
            </div>
            <div class="btn-container">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button class="btn">Save</button>
            </div>
        </form>
    </section>
@endsection