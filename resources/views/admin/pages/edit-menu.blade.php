@extends("admin.layout")
@section("content")
    <section class="content publications-container">
        <h1>{{$menu->title}} menu elements</h1>
        @if(count($posts) > 0)
            <table class="table table-with-reorder table-bordered table-striped text-left" data-action="menus">
                <thead>
                <tr>
                    <th>Order</th>
                    <th>Name</th>
                    <th>URL</th>
                    <th>New window</th>
                    <th>Desktop visible</th>
                    <th>Mobile visible</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr data-id="{{ $post->id }}">
                        <td>{{$post->order_id}}</td>
                        <td>{{$post->name}}</td>
                        <td>{{$post->url}}</td>
                        <td>@if(filter_var($post->new_window, FILTER_VALIDATE_BOOLEAN))
                                <i class="fa fa-check text-success" aria-hidden="true"></i>
                            @else
                                <i class="fa fa-times text-danger" aria-hidden="true"></i>
                            @endif</td>
                        <td>@if(filter_var($post->desktop_visible, FILTER_VALIDATE_BOOLEAN))
                                <i class="fa fa-check text-success" aria-hidden="true"></i>
                            @else
                                <i class="fa fa-times text-danger" aria-hidden="true"></i>
                            @endif</td>
                        <td>@if(filter_var($post->mobile_visible, FILTER_VALIDATE_BOOLEAN))
                                <i class="fa fa-check text-success" aria-hidden="true"></i>
                            @else
                                <i class="fa fa-times text-danger" aria-hidden="true"></i>
                            @endif</td>
                        <td class="actions">
                            <a href="{{route('edit-menu-element', ['id' => $post->id])}}" class="btn">Edit</a>
                            <a href="{{route('delete-menu-element', ['id' => $post->id])}}" onclick="return confirm('Are you sure you want to delete this resource?')" class="btn">Delete</a>
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
