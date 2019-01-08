@extends("admin.layout")
@section("content")
    <section class="content publications-container">
        <h1>All menus</h1>
        @if(count($posts) > 0)
            <table class="table table-bordered table-striped text-left">
                <thead>
                <tr>
                    <th style="width: 40%">Name</th>
                    <th style="width: 40%">Slug</th>
                    <th style="width: 20%">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr data-id="{{ $post->id }}">
                        <td>{{$post->title}}</td>
                        <td>{{$post->slug}}</td>
                        <td class="actions">
                            <a href="{{route('edit-menu', ['id' => $post->id])}}" class="btn">Edit</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="no-results">No resources found.</div>
        @endif
    </section>
@endsection
