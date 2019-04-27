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

<form method="post" action="{{ route('user.update', $data->id) }}" enctype="multipart/form-data">

    @csrf
    @method('PATCH')
    <div class="form-group">
        <label class="col-md-4 text-right">First Name</label>
        <div class="col-md-8">
            <input type="text" name="first_name" class="form-control input-lg" value="{{ $data->first_name }}"  placeholder="Enter first name"/>
        </div>
    </div><br /><br /><br /><br />
    <div class="form-group">
        <label class="col-md-4 text-right">Last Name</label>
        <div class="col-md-8">
            <input type="text" name="last_name" class="form-control input-lg" value="{{ $data->last_name }}"  placeholder="Enter last name"/>
        </div>
    </div>
    <br /><br /><br />
    <div class="form-group">
        <label class="col-md-4 text-right">Email</label>
        <div class="col-md-8">
            <input type="text" name="email" class="form-control input-lg"  value="{{ $data->email }}"  placeholder="Enter email"/>
        </div>
    </div>
    <br /><br /><br />
    <div class="form-group">
        <label class="col-md-4 text-right">Select Gender</label>
        <div class="col-md-8">            
            <div class="radio">
                <label><input type="radio" name="gender" <?php echo $data->gender == 'male' ? 'checked' : ''; ?> value="male">Male</label>
            </div>
            <div class="radio">
                <label><input type="radio" name="gender" <?php echo $data->gender == 'female' ? 'checked' : ''; ?> value="female">Female</label>
            </div>
        </div>
    </div>
    <br /><br /><br />
    <div class="form-group">
        <label class="col-md-4 text-right">Select Education</label>
        <div class="col-md-8">
            <?php $educ = explode(',', $data->education);?>
            <label class="checkbox-inline"><input type="checkbox" name="education[]" <?php echo in_array('it', $educ) ? 'checked' : ''; ?> value="it">IT</label>
            <label class="checkbox-inline"><input type="checkbox" name="education[]" <?php echo in_array('ce', $educ) ? 'checked' : ''; ?> value="ce">Computer Engineer</label>
            <label class="checkbox-inline"><input type="checkbox" name="education[]" <?php echo in_array('me', $educ) ? 'checked' : ''; ?> value="me">Mechanical Engineer</label>
        </div>
    </div>
    <br /><br /><br />
    <div class="form-group">
        <label class="col-md-4 text-right">Select Profile Image</label>
        <div class="col-md-8">
            <input type="file" name="avatar" />
            <img src="{{ URL::to('/') }}/images/{{ $data->avatar }}" class="img-thumbnail" width="100" />
                        <input type="hidden" name="old_avatar" value="{{ $data->avatar }}" />
        </div>
    </div>
    <br /><br /><br />
    <div class="form-group text-center">
        <input type="submit" name="submit" class="btn btn-primary input-lg" value="Save" />
    </div>

</form>

@endsection