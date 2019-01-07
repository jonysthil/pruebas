@extends('layouts.app')

@section('titulo', 'Maestros')

@section('content')

    <div class="container">
        <div class="row">
        @foreach($trainer as $trainer)
            <div class="col-md">
                <div class="card" style="width: 18rem;">
                    <!--<img class="card-img-top" src=".../100px180/" alt="Card image cap">-->
                    <div class="card-body">
                        <h5 class="card-title">{{$trainer->nameMaster}}</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Detalle</a>
                    </div>
                </div>
                <br>
            </div>
            
        @endforeach
    </div>

    </div>

@endsection