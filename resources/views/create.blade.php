@extends('layout.default')

@section('main')
@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div align="right">
    <a href="{{ route('user.index') }}" class="btn btn-default">Back</a>
</div>

<form method="post" action="{{ route('user.store') }}" enctype="multipart/form-data">

    @csrf
    <div class="form-group">
        <label class="col-md-4 text-right">First Name</label>
        <div class="col-md-8">
            <input type="text" name="first_name" class="form-control input-lg" placeholder="Enter first name"/>
        </div>
    </div><br /><br /><br /><br />
    <div class="form-group">
        <label class="col-md-4 text-right">Last Name</label>
        <div class="col-md-8">
            <input type="text" name="last_name" class="form-control input-lg" placeholder="Enter last name"/>
        </div>
    </div>
    <br /><br /><br />
    <div class="form-group">
        <label class="col-md-4 text-right">Email</label>
        <div class="col-md-8">
            <input type="text" name="email" class="form-control input-lg" placeholder="Enter email"/>
        </div>
    </div>
    <br /><br /><br />
    <div class="form-group">
        <label class="col-md-4 text-right">Password</label>
        <div class="col-md-8">
            <input type="password" name="password" class="form-control input-lg" placeholder="Enter password"/>
        </div>
    </div>
    <br /><br /><br />
    <div class="form-group">
        <label class="col-md-4 text-right">Confirm Password</label>
        <div class="col-md-8">
            <input type="password" name="password_confirmation" class="form-control input-lg" placeholder="Enter confirm password"/>
        </div>
    </div>
    <br /><br /><br />
    <div class="form-group">
        <label class="col-md-4 text-right">Select Gender</label>
        <div class="col-md-8">
            <div class="radio">
                <label><input type="radio" name="gender" checked value="male">Male</label>
            </div>
            <div class="radio">
                <label><input type="radio" name="gender" value="female">Female</label>
            </div>
        </div>
    </div>
    <br /><br /><br />
    <div class="form-group">
        <label class="col-md-4 text-right">Select Education</label>
        <div class="col-md-8">
            <label class="checkbox-inline"><input type="checkbox" name="education[]" value="it">IT</label>
            <label class="checkbox-inline"><input type="checkbox" name="education[]" value="ce">Computer Engineer</label>
            <label class="checkbox-inline"><input type="checkbox" name="education[]" value="me">Mechanical Engineer</label>
        </div>
    </div>
    <br /><br /><br />
    <div class="form-group">
        <label class="col-md-4 text-right">Select Profile Image</label>
        <div class="col-md-8">
            <input type="file" name="avatar" />
        </div>
    </div>
    <br /><br /><br />
    <div class="form-group text-center">
        <input type="submit" name="submit" class="btn btn-primary input-lg" value="Save" />
    </div>

</form>

@endsection