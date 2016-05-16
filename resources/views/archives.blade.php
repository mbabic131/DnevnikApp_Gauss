@extends('layouts.app')

@section('content')

<div class="row text-center">
<h2>Svi zapisi u dnevniku:</h2>

<!-- show flash messege if user delete the log -->
@if (Session::has('flash_message'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('flash_message') }}
    </div>
@endif

<!-- if are 0 logs in the database for auth user, display this message -->
 @if (count($allLogs) == 0)
    <div class="row text-center">
      <h3>Nemate spremljenih zapisa!</h3>
    </div>
 @endif

 @foreach ($allLogs as $log)
    <div class="col-md-2 col-sm-4 hero-feature">
      <div class="thumbnail">
       <a href="details/{{ $log->id }}" style="text-decoration:none">
        <img src="images/{{ $log->picture }}" alt="" width="150" height="150">
            <div class="caption">
                <h3>{{ $log->title }}</h3>
                <p>{{ $log->date }}</p>
            </div>
       </a>
          <a href="edit/{{ $log->id }}" style="text-decoration:none"><button type="button" class="btn btn-primary">Uredi</button></a>
          <a rel='{{ $log->id }}' href='javascript:void(0)' class='delete_link'><button class="btn btn-danger">Obriši</button></a></td>
      </div>
    </div>
 @endforeach
 
</div>

<div class="row col-md-4 col-md-offset-4">
  <!-- show pagination -->
  {!! $allLogs->links() !!} 
</div>

@endsection