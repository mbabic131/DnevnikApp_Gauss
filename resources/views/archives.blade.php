@extends('layouts.app')

@section('content')

<div class="row text-center">
<h2>Svi zapisi u dnevniku:</h2>

 @foreach ($allLogs as $log)
    <div class="col-md-4 col-sm-6 hero-feature">
      <div class="thumbnail">
       <a href="details/{{ $log->id }}" style="text-decoration:none">
        <img src="images/{{ $log->picture }}" alt="" width="150">
            <div class="caption">
                <h3>{{ $log->title }}</h3>
                <p>{{ $log->date }}</p>
            </div>
       </a>
          <a href="edit/{{ $log->id }}" style="text-decoration:none"><button type="button" class="btn btn-primary">Uredi</button></a>
          <a href="delete/{{ $log->id }}" style="text-decoration:none"><button type="button" class="btn btn-danger">Obriši</button></a>
      </div>
    </div>
 @endforeach
 
</dib>

@endsection