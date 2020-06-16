@extends('layouts.app')

@section('content')
    <div class="container">
        <section>
            <div class="col-md-12">
                <button class="btn btn-sm btn-dark">
                    <a href="{{ redirect()->getUrlGenerator()->previous()}}" style="text-decoration:none" class="text-white">Regresar</a>
                </button>
                <button class="btn btn-primary btn-sm float-right">
                    <a href="{{ route('contactos.create') }}" style="text-decoration:none" class="text-white">Nuevo Contacto</a>
                </button>
            </div>
        </section>
        <hr>
        <section>
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="float-left" style="margin-left: 20px; margin-bottom: 5px;">
                        <h3>Contactos</h3>
                    </div>
                    <form class="form-inline float-right">
                        <input class="form-control form-control-sm" type="text" placeholder="Buscar Contacto" aria-label="Search" name="search">
                        <i class="fa fa-search" style="margin: 5px" aria-hidden="true"></i>
                    </form>
                </div>
            </div>
        </section>
        <section style="margin-left: 20px">
            <div class="row justify-content-center">
                <div class="col-12">                   
                    <table id="example" class="table table-bordered table-hover table-sm text-center">
                        <thead class="thead-dark">
                        <tr>
                            <th>Nombre(s)</th>
                            <th>Apellido(s)</th>
                            <th>Detalles</th>
                            <th>Actualizar</th>
                            <th>Eliminar</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($contacts as $contact)
                                <tr>
                                    <td>{{$contact->name}}</td>
                                    <td>{{$contact->lastName}}</td>
                                    <td>
                                        <button class="btn btn-light" >
                                            <a href="{{ route('contactos.show', $contact->id) }}" role="button" style="text-decoration:none;">Ver</a>
                                        </button>
                                    </td> 
                                    <td>
                                        <button class="btn btn-light" >
                                            <a href="{{ route('contactos.edit', $contact->id) }}" role="button" style="color:green; text-decoration:none">Actualizar</a>
                                        </button>
                                    </td> 
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button class="btn btn-light" data-toggle="modal" style="color:red;" data-target="#eliminar-{{ $contact->id }}">Eliminar</button>
                                    
                                        <!-- Modal -->
                                        <div class="modal fade" id="eliminar-{{ $contact->id }}" tabindex="-1" role="dialog" aria-labelledby="eliminarTitle" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="eliminarTitle">Confirmacion de Eliminacion</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>
                                                            La siguiente accion es irreversible una vez que confirmes la accion el dato sera eliminado por completo
                                                            <br>
                                                            ¿Estas seguro?
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="POST" action="{{ route('contactos.destroy', $contact->id) }}" accept-charset="UTF-8">
                                                            @csrf
                                                            @method('delete')
                                                                <button class="btn btn-light" type="submit" style="color:red">Eliminar</button> 
                                                            </form>
                                                        <button class="btn waves-effect blue" type="button" style="text-decoration:none" data-dismiss="modal">Cancelar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="d-flex">
                        <div class="mx-auto">
                            {{$contacts->links("pagination::bootstrap-4")}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script type="text/javascript">
        setTimeout(function () {
            $(document).ready(function(){
                $('#myModal').on('shown.bs.modal', function () {
                    $('#myInput').trigger('focus')
                });
            });
        }, 0);
    </script>
@endsection