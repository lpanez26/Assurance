@extends("admin.layout")
@section("content")
    <section class="content add-edit-menu-element">
        <h1>@if(!empty($post)) Edit @else Add @endif menu element</h1>
        <form method="post" enctype="multipart/form-data" class="text-center" action="@if(!empty($post)) {{route('edit-menu-element', ['id' => $post->id])}} @else {{route('add-menu-element')}} @endif">
            <div class="form-row">
                <label>Title:<span class="required-mark">*</span></label>
                <input type="text" name="title" @if(!empty($post)) value="{{$post->name}}" @endif/>
            </div>
            <div class="form-row">
                <label>Type:<span class="required-mark">*</span></label>
                <select name="type">
                    <option @if(!empty($post) && $post->type == 'page') selected @endif value="page">Page</option>
                    <option @if(!empty($post) && $post->type == 'file') selected @endif value="file">File</option>
                </select>
            </div>
            <div class="form-row type-result">
                @if(!empty($post))
                    @if($post->type == 'page')
                        @include('admin.partials.menu-element-page-option')
                    @elseif($post->type == 'file')
                        @include('admin.partials.menu-element-file-option')
                    @endif
                @else
                    @include('admin.partials.menu-element-page-option')
                @endif
            </div>
            @if(!empty($posts))
                <div class="form-row">
                    <label class="inline-block" for="new-window">Menu:</label>
                    <select name="menu_id">
                        @foreach($posts as $menu)
                            <option value="{{$menu->id}}" @if(!empty($post) && $menu->id == $post->menu->id) selected @endif >{{$menu->title}}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            <div class="form-row">
                <label>Id attribute:</label>
                <input type="text" name="id-attribute" @if(!empty($post)) value="{{$post->id_attribute}}" @endif/>
            </div>
            <div class="form-row">
                <label>Class attribute:</label>
                <input type="text" name="class-attribute" @if(!empty($post)) value="{{$post->class_attribute}}" @endif/>
            </div>
            <div class="form-row">
                <label class="inline-block" for="new-window">Open in new window:</label>
                <input type="checkbox" id="new-window" name="new-window" value="true" @if(!empty($post) && $post->new_window) checked @endif/>
            </div>
            <div class="form-row">
                <label class="inline-block" for="desktop-visible">Desktop visible:</label>
                <input type="checkbox" id="desktop-visible" name="desktop-visible" value="true" @if(!empty($post)) @if($post->desktop_visible) checked @endif @else checked @endif/>
            </div>
            <div class="form-row">
                <label class="inline-block" for="mobile-visible">Mobile visible:</label>
                <input type="checkbox" id="mobile-visible" name="mobile-visible" value="true" @if(!empty($post)) @if($post->mobile_visible) checked @endif @else checked @endif/>
            </div>
            <div class="btn-container">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button class="btn">Save</button>
            </div>
        </form>
    </section>
@endsection