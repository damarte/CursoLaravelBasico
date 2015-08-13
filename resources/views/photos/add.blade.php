@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Add Photo</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/photos/add') }}?album_id={{$album_id}}" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}"/>

						<div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Description</label>
							<div class="col-md-6">
								<textarea class="form-control" name="description" rows="3" required>{{ old('description') }}</textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Image (Max: 20MB)</label>
							<div class="col-md-6">
								<input type="file" class="form-control" name="image" required>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Submit
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
