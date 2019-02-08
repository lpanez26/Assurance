<div class="one step">
    <h2 class="text-center calibri-bold fs-30 padding-bottom-25">{{$current_logged_dentist->name}}</h2>
    <div class="avatar">
        @if(!$current_logged_dentist->hasimage)
            <div class="avatar module text-center upload-file">
                <input type="file" class="visualise-image inputfile" id="custom-upload-avatar" name="image" accept=".jpg,.png,.jpeg,.svg,.bmp"/>
                <button type="button"></button>
            </div>
        @else
            <figure itemscope="" itemtype="http://schema.org/ImageObject" class="text-center">
                <img alt="Dentist avatar" itemprop="contentUrl" src="{{$current_logged_dentist->avatar_url}}"/>
            </figure>
        @endif
    </div>
    <div class="step-fields module padding-top-35">
        <div class="single-row flex-row fs-0">
            <label class="calibri-light light-gray-color fs-16 padding-right-15 margin-bottom-0">Professional/Company Registration Number:</label>
            <input type="text" maxlength="50" name="professional-company-number" class="right-field calibri-regular fs-18 dark-color inline-block pencil-background"/>
        </div>
        <div class="single-row flex-row fs-0">
            <label class="calibri-light light-gray-color fs-16 padding-right-15 margin-bottom-0">Postal Address:</label>
            <div class="right-field calibri-regular fs-18 dark-color" name="postal-address">{{$current_logged_dentist->address}}</div>
        </div>
        <div class="single-row flex-row fs-0">
            <label class="calibri-light light-gray-color fs-16 padding-right-15 margin-bottom-0">Country:</label>
            <div class="right-field calibri-regular fs-18 dark-color" name="country">{{$countries[$current_logged_dentist->country_id - 1]->name}}</div>
        </div>
        <div class="single-row flex-row fs-0">
            <label class="calibri-light light-gray-color fs-16 padding-right-15 margin-bottom-0">Phone:</label>
            @if(!empty($current_logged_dentist->phone))
                <div class="right-field calibri-regular fs-18 dark-color" name="phone">{{$current_logged_dentist->phone}}</div>
            @else
                <input type="number" data-type="phone" name="phone" maxlength="50" class="right-field calibri-regular fs-18 dark-color inline-block pencil-background"/>
            @endif
        </div>
        <div class="single-row flex-row fs-0">
            <label class="calibri-light light-gray-color fs-16 padding-right-15 margin-bottom-0">Website:</label>
            @if(!empty($current_logged_dentist->website))
                <div class="right-field calibri-regular fs-18 dark-color" name="website"><a href="{{$current_logged_dentist->website}}" target="_blank">{{$current_logged_dentist->website}}</a></div>
            @else
                <input type="text" data-type="website" name="website" maxlength="250" class="right-field calibri-regular fs-18 dark-color inline-block pencil-background"/>
            @endif
        </div>
        <div class="single-row flex-row fs-0">
            <label class="calibri-light light-gray-color fs-16 padding-right-15 margin-bottom-0">Wallet Address:</label>
            @if(!empty($current_logged_dentist->dcn_address))
                <div class="right-field calibri-regular fs-18 dark-color" name="address">
                    <a href="//etherscan.io/address/{{$current_logged_dentist->dcn_address}}" target="_blank">{{$current_logged_dentist->dcn_address}}</a>
                </div>
            @else
                <input type="text" data-type="address" name="address" maxlength="42" class="right-field calibri-regular fs-18 dark-color inline-block pencil-background"/>
            @endif
        </div>
        <div class="fs-14 calibri-light light-gray-color padding-top-10">This is the wallet where you will receive your monthly premiums. Please double-check if everything is correct.</div>
        <div class="fs-14 calibri-light light-gray-color">You don’t have a wallet? <a href="//wallet.dentacoin.com" target="_blank">Create one here.</a></div>
    </div>
</div>