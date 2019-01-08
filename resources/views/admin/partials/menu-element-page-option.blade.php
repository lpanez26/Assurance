<label>URL:<span class="required-mark">*</span></label>
<input type="text" name="url" @if(!empty($post)) value="{{$post->url}}" @endif/>