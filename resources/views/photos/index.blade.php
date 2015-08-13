@extends('app')

@section('content')
<div class="container-fluid">
	@if (Session::has('success'))
		<div class="alert alert-success">
			{{Session::get('success')}}
		</div>
	@endif
	<p><a href="/photos/add/{{$album_id}}" class="btn btn-primary" role="button">Add Photo</a></p>
	@if(sizeof($photos) > 0)
	<div class="row">
		@foreach($photos as $photo)
		<div class="col-sm-12 col-md-6">
			<div class="thumbnail">
				<img src="{{$photo->url}}" />
				<div class="caption">
					<h3>{{$photo->name}}</h3>
					<p>{{$photo->description}}</p>
					<p><a href="/photos/edit/{{$photo->id}}" class="btn btn-default" role="button">Edit Photo</a></p>
					<p>
						<form action="/photos/delete" method="post">
							<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
							<input type="hidden" name="id" value="{{$photo->id}}"/>
							<input class="btn btn-danger" role="button" type="submit" value="Delete"/>
						</form>
					</p>
				</div>
			</div>
		</div>
		@endforeach
	</div>
	@else
	<div class="alert alert-danger">
		<p>This album no have photos.</p>
	</div>
	@endif
</div>
@endsection
