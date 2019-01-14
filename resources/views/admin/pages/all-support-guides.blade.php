@extends("admin.layout")
@section("content")
    <section class="content publications-container">
        <h1>All Support Guide</h1>
        @if(count($posts) > 0)
            <table class="table table-with-reorder table-bordered table-striped text-left" data-action="support-guide">
                <thead>
                <tr>
                    <th>Order</th>
                    <th>Image</th>
                    <th>Text</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr data-id="{{ $post->id }}">
                        <td>{{ $post->order_id }}</td>
                        <td>@if(!empty($post->media))
                                <img src="{{URL::asset('assets/uploads/' . $post->media->name) }}" class="small-image"/>
                            @else
                                No image selected
                            @endif</td>
                        <td>{{ mb_substr($post->text, 0, 100) }}...</td>
                        <td class="actions">
                            <a href="{{route('edit-support-guide', ['id' => $post->id])}}" class="btn">Edit</a>
                            <a href="{{route('delete-support-guide', ['id' => $post->id])}}" onclick="return confirm('Are you sure you want to delete this resource?')" class="btn">Delete</a>
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
