@extends('layouts.app')

@section('content')
    <div class="container">
        <section>
            <div class="col-md-12">
                <button class="btn btn-sm btn-dark">
                    <a href="{{ redirect()->getUrlGenerator()->previous()}}" style="text-decoration:none" class="text-white">Regresar</a>
                </button>
            </div>
        </section>
        <hr>
        <section id="Obtener Usuarios">
        <h3>{{$contact->name}}</h3>
            <table class="table table">
                <thead>
                  <tr>
                      <th>Nombre(s)</th>
                      <th>Apellido(s)</th>
                      <th>Email</th>
                      <th>Telefono</th>
                      <th>Direccion</th>
                      <th>Notas</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$contact->name}}</td>
                        <td>{{$contact->lastName}}</td>
                        <td>{{$contact->email}}</td>
                        <td>{{$contact->phone}}</td>
                        <td>{{$contact->address}}</td>
                        <td>{{$contact->note}}</td>
                    </tr>
                </tbody>
            </table>    
        </section>
    </div>
@endsection