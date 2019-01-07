@extends('layout.main')
@section('contenido')

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

        <h3>Nuevo Contacto</h3>

        @if( count($errors)>0 )
            <div class="alert alert-danger">
                <ul>
                    @foreach( $errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {!!Form::open(
            array(
                'url'=>'contacto', 
                'method'=>'POST', 
                'autocomplete'=>'off', 
                'files'=>'true'
                )
            )
        !!}
        {{Form::token()}}

            <div class="form-group">
                <label for="nombre">Estatus</label>
                <select name="stsId" id="stsId" class="form-control">
                    @foreach ($estatus as $sts)
                    <option value="{{ $sts->stsId }}">{{ $sts->stsNombre }}</option>
                    @endforeach
                    
                </select>
            </div>

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="cntNombre" value="{{old('cntNombre')}}" class="form-control">
            </div>

            <div class="form-group">
                <label for="apellidoPaterno">Apellido Paterno</label>
                <input type="text" name="cntApellidoPaterno" value="{{old('cntApellidoPaterno')}}" class="form-control">
            </div>

            <div class="form-group">
                <label for="apellidoMaterno">Apellido Materno</label>
                <input type="text" name="cntApellidoMaterno" value="{{old('cntApellidoMaterno')}}" class="form-control">
            </div>

            <div class="form-group">
                <label for="apellidoMaterno">Fotografía</label>
                <input type="file" name="cntFotografia" class="form-control">
            </div>

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-danger" type="button" onclick="javascript:history.back();return false;">Cancelar</button>
            </div>

        {!!Form::close()!!}

    </div>
</div>

@endsection