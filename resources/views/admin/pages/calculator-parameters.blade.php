@extends("admin.layout")
@section("content")
    <section class="content calculator-parameters-container">
        <h1>All calculator parameters</h1>
        <ul style="padding-left: 15px;font-weight: bold;padding-bottom: 15px;">
            <li>GD - General Dentistry</li>
            <li>CD - Cosmetic Dentistry</li>
            <li>ID - Implant Dentistry</li>
        </ul>
        @if(count($posts) > 0)
            <table class="table table-without-reorder table-bordered table-striped text-left">
                <thead>
                <tr>
                    <th>Country</th>
                    <th>GD CD ID</th>
                    <th>GD CD</th>
                    <th>GD ID</th>
                    <th>CD ID</th>
                    <th>GD</th>
                    <th>CD</th>
                    <th>ID</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr data-id="{{ $post->id }}">
                        <td>{{$post->country}}</td>
                        <td><input type="number" id="param_gd_cd_id" value="{{$post->param_gd_cd_id}}"/></td>
                        <td><input type="number" id="param_gd_cd" value="{{$post->param_gd_cd}}"/></td>
                        <td><input type="number" id="param_gd_id" value="{{$post->param_gd_id}}"/></td>
                        <td><input type="number" id="param_cd_id" value="{{$post->param_cd_id}}"/></td>
                        <td><input type="number" id="param_gd" value="{{$post->param_gd}}"/></td>
                        <td><input type="number" id="param_cd" value="{{$post->param_cd}}"/></td>
                        <td><input type="number" id="param_id" value="{{$post->param_id}}"/></td>
                        <td class="actions">
                            <a href="{{route('delete-calculator-parameter', ['id' => $post->id])}}" onclick="return confirm('Are you sure you want to delete this resource?')" class="btn">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="9" class="text-center">
                        <a href="javascript:void(0);" class="btn save-calculator-parameters">Save parameters</a>
                    </td>
                </tr>
                </tfoot>
            </table>
        @else
            <div class="no-results">No resources found.</div>
        @endif
    </section>
@endsection
