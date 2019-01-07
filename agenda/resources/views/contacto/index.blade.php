@extends('layout.main')
@section('contenido')

<div class="row">
    <div class="col-lg-8 col-md-8 col-sm8 col-xs-12">
        <h1>Contactos <a href="/contacto/create"><button class="btn btn-primary">Nuevo</button></a></h1>

        @include('contacto.search')

    </div>
</div>

<div class="row">
    <div>
        <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
        <th>&nbsp;Id</th>
        <th>Estatus</th>
        <th> Nombre</th>
        <th> Apellido Paterno</th>
        <th> Apellido Materno</th>
        <th> Fotografía</th>
        <th class="text-center"></th>
        </thead>

        {{ $cont=1 }}
        @foreach($contacto as $cnt)
            <tr>
            <td>{{ $cont }}</td>
            <td>{{ $cnt->stsNombre }}</td>
            <td>{{ $cnt->cntNombre }}</td>
            <td>{{ $cnt->cntApellidoPaterno }}</td>
            <td>{{ $cnt->cntApellidoMaterno }}</td>
            <td class="text-center">
            @if($cnt->cntFotografia != "")
                <img src="{{asset('/upload/contacto/'.$cnt->cntFotografia)}}" height="75">
            @endif
            </td>
            <td class="text-center">
                <a href="{{URL::action('ContactoController@edit', $cnt->cntId)}}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                <a href="" data-target="#modal-delete-{{$cnt->cntId}}" data-toggle="modal" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
            </td>
            </tr>

            <!-- -->
            <div class="modal fade modal-slide-in-right" arial-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$cnt->cntId}}">
                {{Form::open(array('action'=>array('ContactoController@destroy',$cnt->cntId),'method'=>'delete'))}}
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" arial-label="Close">
                                    <span arial-hidden="true">x</span>
                                </button>
                                <h4 class="modal-title">Eliminar Contacto {{$cnt->cntNombre}}</h4>
                            </div>
                            <div class="modal-body">
                                <p>Confirme si desea eliminar el contacto</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Confirm</button>
                            </div>
                        </div>
                    </div>
                {{Form::close()}}
            </div>
            <!-- -->
            {{ $cont=$cont+1 }}
        @endforeach

        </table>

        &nbsp;&nbsp;&nbsp;&nbsp;{{$contacto->render()}}

    </div>
</div>

@endsection