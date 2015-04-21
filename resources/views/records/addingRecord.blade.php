@extends('app')

@section('content')
<div class="container">
	<div class="row">        
        <div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Adding a new Record
                </div>
				<div class="panel-body">
	               {!! Form::open(array('url'=>'/record/','method'=>'POST', 'files'=> true)) !!}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">File</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control" name="file">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Title</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Description</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="description" value="{{ old('description') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection