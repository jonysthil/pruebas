@extends('layouts.app')

@section('titulo', 'Nuevo maestro Pokemon')

@section('content')

    <div class="container">
        <h2 class="text-center">
            Formulario para crear un nuevo maestro pokemon
        </h2>

        {!!Form::open(
            array(
                'url'=>'trainer', 
                'method'=>'POST', 
                'autocomplete'=>'off'
                )
            )
        !!}
        {{Form::token()}}
            <div class="form-group">
                <input type="text" class="form-control" name="nameMaster" id="nameMaster" aria-describedby="nameMaster" placeholder="Nombre del maestro pokemon">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        {!!Form::close()!!}
    </div>

@endsection