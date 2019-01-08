@extends('layouts.app')

@section('titulo', 'Detalle del maestro Pokemon')

@section('content')

    <div class="container">
        <div class="row text-center">
            <div class="col-md">
                <div class="card text-center" style="width: 18rem; margin-top: 50px;">
                    <img style="height: 100px; width: 100px; background-color: #efefef; margin-top:20px;" class="card-img-top rounded-circle mx-auto d-blok" src="/images/{{$trainer->avatar}}" alt="{{$trainer->nameMaster}}">
                    <div class="card-body">
                        <h5 class="card-title">{{$trainer->nameMaster}}</h5>
                        <h5 class="card-title">{{$trainer->slug}}</h5>
                        <p class="card-text">{{$trainer->descricion}}</p>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>

@endsection