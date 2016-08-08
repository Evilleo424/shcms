@extends('layout')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">列表</div>
				<div class="panel-body">
                    <ul>
                    @foreach ($models as $model)
                        <li><a href="{{ $model->showUrl() }}">{{ $model->title }}</a></li>
                    @endforeach
                    </ul>
				</div>
                {!! $models -> render() !!}
			</div>
		</div>
	</div>
</div>
@endsection
