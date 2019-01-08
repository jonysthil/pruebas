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
                'autocomplete'=>'off',
                'files'=>'true'
                )
            )
        !!}
        {{Form::token()}}
            <div class="form-group">
                <input type="text" class="form-control" name="nameMaster" id="nameMaster" aria-describedby="nameMaster" placeholder="Nombre del maestro pokemon">
            </div>
            
            <div class="form-group">
                <textarea class="form-control" name="descricion" id="descricion" rows="3" placeholder="Descripción del entrenador"></textarea>
            </div>

            <div class="form-group">
                <input type="file" name="avatar" id="avatar">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        {!!Form::close()!!}
    </div>

@endsection