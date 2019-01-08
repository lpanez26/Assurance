@extends("admin.layout")
@section("content")
    <section class="content publications-container">
        <h1>All pages</h1>
        @if(count($posts) > 0)
            <table class="table table-bordered table-striped text-left">
                <thead>
                <tr>
                    <th>Slug</th>
                    <th>Meta title</th>
                    <th>Meta description</th>
                    <th>Meta keywords</th>
                    <th>Social title</th>
                    <th>Social description</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr data-id="{{ $post->id }}">
                        <td>{{$post->slug}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{ mb_substr($post->description, 0, 50) }}...</td>
                        <td>{{$post->keywords}}</td>
                        <td>{{$post->social_title}}</td>
                        <td>{{ mb_substr($post->social_description, 0, 50) }}...</td>
                        <td class="actions">
                            <a href="{{route('edit-page', ['id' => $post->id])}}" class="btn">Edit</a>
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
