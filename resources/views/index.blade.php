@extends('layout.default')
@section('main')

<div align="right">
    <a href="{{ route('user.create') }}" class="btn btn-default">Add</a>
</div>
<br/><br/>
<table class="table table-bordered table-striped">
    <tr>
        <th width="10%">Avatar</th>
        <th width="35%">First Name</th>
        <th width="35%">Last Name</th>
        <th width="35%">Email</th>
        <th width="35%">Gender</th>
        <th width="35%">Education</th>
        <th width="30%">Action</th>
    </tr>
    @foreach($data as $row)
    <tr>
        <td><img src="{{ URL::to('/') }}/images/{{ $row->avatar }}" class="img-thumbnail" width="75" /></td>
        <td>{{ $row->first_name }}</td>
        <td>{{ $row->last_name }}</td>
        <td>{{ $row->email }}</td>
        <td>{{ $row->gender }}</td>
        <td>{{ $row->education }}</td>
        <td>
            <a href="{{ route('user.edit', ['id' => $row->id]) }}" class="btn btn-primary">Edit</a> <br/>
            <form action="{{ route('user.destroy', ['id' => $row->id]) }}" method="post">
                <input class="btn btn-danger" type="submit" value="Delete" />
                <input type="hidden" name="_method" value="delete" />
                {!! csrf_field() !!}
            </form>
        </td>
    </tr>
    @endforeach
</table>
{!! $data->links() !!}

@endsection