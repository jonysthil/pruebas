@extends('layout.main')
@section('contenido')

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Editar Contacto: {{$contacto->cntNombre}} {{$contacto->cntApellidoPaterno}}</h3></h3>

        @if( count($errors)>0 )
            <div class="alert alert-danger">
                <ul>
                    @foreach( $errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {!!Form::model(
            $contacto,
            [
                'method'=>'PATCH',
                'route'=>
                    [
                        'contacto.update',
                        $contacto->cntId
                    ],
                'files'=>'true'
            ]
            )
        !!}
        {{Form::token()}}

            <div class="form-group">
                <label for="nombre">Estatus</label>
                <select name="stsId" id="stsId" class="form-control">
                    @foreach ($estatus as $sts)
                    @if ($contacto->stsId == $sts->stsId)
                    <option value="{{$sts->stsId}}" selected>{{$sts->stsNombre}}</option>    
                    @else
                    <option value="{{ $sts->stsId }}">{{ $sts->stsNombre }}</option>    
                    @endif
                    @endforeach
                    
                </select>
            </div>

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="cntNombre" value="{{$contacto->cntNombre}}" class="form-control">
            </div>

            <div class="form-group">
                <label for="apellidoPaterno">Apellido Paterno</label>
                <input type="text" name="cntApellidoPaterno" value="{{$contacto->cntApellidoPaterno}}" class="form-control">
            </div>

            <div class="form-group">
                <label for="apellidoMaterno">Apellido Materno</label>
                <input type="text" name="cntApellidoMaterno" value="{{$contacto->cntApellidoMaterno}}" class="form-control">
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