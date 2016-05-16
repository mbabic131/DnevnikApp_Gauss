@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dobrodošli</div>

                <div class="panel-body">

                    <div class="row text-center">
                        <p>Ovo je aplikacija za unos zapisa u dnevnik. <br> 
                            Omogućena je registracija i prijava u sustav. <br>
                            Nakon prijave moguće je unjeti novi zapis u dnevnik, nakon toga moguće je uneseni zapis uređivati 
                            te ga obrisati.
                        </p>
                    </div>

                    <div class="row text-center">
                        <a href="/home" style="text-decoration: none"><h4><span class="glyphicon glyphicon-plus"></span>&nbspUnos novog zapisa</h4></a>
                        <a href="/archives" style="text-decoration: none"><h4><span class="
glyphicon glyphicon-book"></span>&nbspPregled arhive zapisa</h4></a>
                    </div>

                    <div class="row">
                        <small> &nbsp *Kako biste unijeli novi zapis morate se prijaviti ili registrirati.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
