@extends('app')

@section('content')
<div class="container-fluid">
	@if (Session::has('success'))
		<div class="alert alert-success">
			{{Session::get('success')}}
		</div>
	@endif
	<p><a href="/albums/add" class="btn btn-primary" role="button">Add Album</a></p>
	@if(sizeof($albums) > 0)
	<div class="row">
		@foreach($albums as $album)
		<div class="col-sm-12 col-md-6">
			<div class="thumbnail">
				<div class="caption">
					<h3>{{$album->name}}</h3>
					<p>{{$album->description}}</p>
					<div class="btn-group" role="group" aria-label="...">
						<a href="/photos?album_id={{$album->id}}" class="btn btn-primary" role="button">Show Photos</a>
						<a href="/albums/edit/{{$album->id}}" class="btn btn-default" role="button">Edit</a>
					</div>
					<p>
						<form action="/albums/delete" method="post">
							<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
							<input type="hidden" name="id" value="{{$album->id}}"/>
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
		<p>No albums.</p>
	</div>
	@endif
</div>
@endsection
