@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-10 col-md-offset-1">
	<div class="panel panel-info">
		<div class="panel-heading"><h3><u>{{ $findRow->title }}</u></h3>
			<hr>
			<a href="../edit/{{ $findRow->id }}"><button class="btn btn-primary">Uredi</button></a>
			<a href="../delete/{{ $findRow->id }}"><button class="btn btn-danger">Obriši</button></a>
		</div>

            <div class="panel-body">
            	<img src="../images/{{ $findRow->picture }}" alt="foto">
            	<p>_______</p>
                <p style="color:darkblue">{{ $findRow->text }}</p>
            </div>
        <div class="panel-footer"><p style="color:red">Datum: {{ $findRow->date }}</p></div>
    </div>
	</div>
</div>

@endsection