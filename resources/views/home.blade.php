@extends('layouts.app')

@section('content')

    <h3>Unos novog zapisa u dnevnik:</h3>
    <form class="form-horizontal" role="form" method="post" action="{{ URL('store') }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
           
            <div class="form-group">
                <label class="control-label col-sm-2" for="title">Naslov:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="title" value="{{ old('title') }}">
            </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="picture">Fotografija:</label>
            <div class="col-sm-6">
                <input type="file" class="form-control" name="picture">
            </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="date">Datum:</label>
            <div class="col-sm-4">
                <input type="date" class="form-control" name="date" value="{{ old('date') }}">
            </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="text">Tekst:</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="7" name="text">{{ old('text') }}</textarea>
            </div>
            </div>
            
            <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Spremi</button>  
            </div>
            </div>    
    </form>

    @if (count($errors))
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li><b>{{ $error }}</b></li>
                @endforeach
            </ul>
        </div>
    @endif

@endsection
