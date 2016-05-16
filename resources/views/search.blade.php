@extends('layouts.app')

@section('content')

<div class="row text-center">
<h2>Pretraga dnevnika<h2>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12">
            <div class="input-group" id="adv-search">
                <div class="input-group-btn">
                    <div class="btn-group" role="group">
                        <form class="form-horizontal" role="form" method="post">
                        	{!! csrf_field() !!}
                          <div class="form-group">
                          	<input type="text" class="form-control" name="find" placeholder="Pretraga" />
                            <label for="serchType" class="form-control">Pretraga prema:</label>
                            <select class="form-control" name="searchType">
                                <option value="0" selected>Naslovu zapisa</option>
                                <option value="1">Ključnoj riječi u zapisu</option>
                            </select>
                          </div>
                          <div class="form-group">
                          <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                        </form>
                    </div>
                </div>
            </div>
          </div>
        </div>
	</div>
</div>
<hr>

@if ($_POST)
<h3>Rezultati pretrage:</h3>
@foreach ($results as $result)
    <div class="col-md-2 col-sm-4 hero-feature">
      <div class="thumbnail">
       <a href="details/{{ $result->id }}" style="text-decoration:none">
        <img src="images/{{ $result->picture }}" alt="" width="150" height="150">
            <div class="caption">
                <h3>{{ $result->title }}</h3>
                <p>{{ $result->date }}</p>
            </div>
       </a>
          <a href="edit/{{ $result->id }}" style="text-decoration:none"><button type="button" class="btn btn-primary">Uredi</button></a>
          <a rel='{{ $result->id }}' href='javascript:void(0)' class='delete_link'><button class="btn btn-danger">Obriši</button></a></td>
      </div>
    </div>
@endforeach

@if(count($results) == 0)
	<h5>Nema rezultata!</h5>
@endif

@endif

@endsection