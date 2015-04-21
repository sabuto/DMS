@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <h1 class="text-center">Edit Name.</h1>
            {!! Form::open(array('url' => 'admin/'. $user->id, 'class' => 'form-horizontal')) !!}
            {!! Form::hidden('_method', 'PUT') !!}
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="email" value="{{ $user->name }}" name="name" class="form-control" id="inputEmail3" placeholder="Change Name to...?">
                </div>
            </div>
            <div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
				<div class="col-sm-10">
					<input type="email" name="email" value="{{ $user->email }}" class="form-control" id="inputEmail3" placeholder="Change Email to...?">
				</div>
		    </div>
		  <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="admin"
                    @if($user->rank == 3)
                       checked="checked"
                    @endif
                    > Admin?
                 </label>
                </div>
              </div>
            </div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" name="save" class="btn btn-default">Save Changes</button>
				</div>
			</div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
