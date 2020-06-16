@extends('layouts.app')

@section('content')
    {{-- Styke --}}
    <link href='{{ asset('calendar/core/main.css') }}' rel='stylesheet' />
    <link href='{{ asset('calendar/daygrid/main.css') }}' rel='stylesheet' />
    <link href='{{ asset('clockpicker/dist/bootstrap-clockpicker.css') }}' rel='stylesheet' />
    {{-- Plugin --}}
    <link href='{{ asset('calendar/list/main.css') }}' rel='stylesheet' />
    <link href='{{ asset('calendar/timegrid/main.css') }}' rel='stylesheet' />

    {{-- JavaScript --}}
    <script src='{{ asset('calendar/core/main.js') }}'></script>
    <script src='{{ asset('calendar/daygrid/main.js') }}'></script>
    <script src='{{ asset('clockpicker/dist/bootstrap-clockpicker.js') }}'></script>
    {{-- Plugin --}}
    <script src='{{ asset('calendar/list/main.js') }}'></script>
    <script src='{{ asset('calendar/timegrid/main.js') }}'></script>
    <script src='{{ asset('calendar/interaction/main.js') }}'></script>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-11">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
  
    <!-- Modal -->
    <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="modalCreateLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateLabel">Agendar Cita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="card">            
                            <div class="card-body">
                                <form method="POST" action="{{ route('calendario.store') }}">
                                    @csrf
            
                                    <div class="form-group row">
                                        <label for="start" class="col-md-4 col-form-label text-md-right">{{ __('Fecha') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="start" type="text" class="form-control @error('start') is-invalid @enderror" name="start" value="{{ old('start') }}" required autocomplete="start" autofocus>
            
                                            @error('start')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Asunto') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
            
                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="input-group clockpicker" data-autoclose="true">
                                            <label for="hour" class="col-md-4 col-form-label text-md-right">{{ __('Hora') }}</label>
    
                                            <div class="col-md-6">
                                                <input id="hour" type="text" class="form-control" class="form-control @error('hour') is-invalid @enderror" name="hour" value="{{ old('hour') }}" required autofocus>

                                                @error('hour')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Descripcion ') }}</label>
            
                                        <div class="col-md-6">
                                            <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus style="height: 120px; resize: none;"></textarea>
            
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="color" class="col-md-4 col-form-label text-md-right">{{ __('Prioridad') }}</label>
            
                                        <div class="col-md-3">
                                            <input id="color" type="color" class="form-control @error('color') is-invalid @enderror" name="color" required autocomplete="color" autofocus>
            
                                            @error('color')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Registrar') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalShow" tabindex="-1" role="dialog" aria-labelledby="modalShowLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalShowLabel">Cita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="card">            
                            <div class="card-body">
                                <input id="getId" type="hidden" class="getId" name="getId">
                                
                                <div class="form-group row">
                                    <label for="getStart" class="col-md-4 col-form-label text-md-right">{{ __('Fecha') }}</label>
        
                                    <div class="col-md-8">
                                        <input id="getStart" type="text" class="form-control" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="getHour" class="col-md-4 col-form-label text-md-right">{{ __('Hora') }}</label>
        
                                    <div class="col-md-8">
                                        <input id="getHour" type="text" class="form-control" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="getTitle" class="col-md-4 col-form-label text-md-right">{{ __('Asunto') }}</label>
        
                                    <div class="col-md-8">
                                        <input id="getTitle" type="text" class="form-control" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="getDescription" class="col-md-4 col-form-label text-md-right">{{ __('Descripcion ') }}</label>
        
                                    <div class="col-md-8">
                                        <textarea id="getDescription" type="text" class="form-control" style="height: 120px; resize: none;" disabled></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row float-right">
                                    <button id="eliminar" class="btn waves-effect red" data-toggle="modal" style="color:red" data-target="#eliminar">Eliminar</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                height: 520,
                plugins: [ 'dayGrid', 'interaction', 'timeGrid', 'list' ],
                header: {
                    left:'prev, next today',
                    center:'title',
                    right:'dayGridMonth, timeGridWeek, timeGridDay'
                },
                dateClick: function(info) {
                    $('#start').val(info.dateStr);
                    $('#modalCreate').modal();
                },
                eventClick: function(info) {
                    // Formato de los valores Recuperados
                    year = (info.event.start.getFullYear());
                    
                    month = (info.event.start.getMonth() + 1);
                    month = (month<10)? "0" + month:month;
                    
                    date = (info.event.start.getDate());
                    date = (date<10)? "0" + date:date;
                    
                    hour = (info.event.start.getHours());
                    hour = (hour<10)? "0" + hour:hour;

                    minutes = (info.event.start.getMinutes());
                    minutes = (minutes<10)? "0" + minutes:minutes;

                    $('#modalShow').modal();
                    $('#getId').val(info.event.id);
                    $('#getStart').val(year + "-" + month + "-" + date);
                    $('#getHour').val(hour + ":" + minutes);
                    $('#getTitle').val(info.event.title);
                    $('#getDescription').val(info.event.extendedProps.description);
                },
                events: "{{url('/calendario/create')}}"
            });
            calendar.setOption('locale', 'Es');
            calendar.render();

            // $('#eliminar').click(function(){
            //     objEvent = getData("DELETE");
            //     sendData('/' + $('#getId').val, objEvent);
            // }); 

            // function getData(method) {
            //     newEvent = {	
            //         title: $('#getTitle').val(),
            //         description: $('#getDescription').val(),
            //         start: $('#getStart').val(),
            //         '_token':$("meta[name='csrf-token']").attr("content"),
            //         '_method':method
            //     }
            // }
            // function sendData(accion, objEvent) {
            //     $.ajax({
            //         type:"POST",
            //         url:"{{ url('/calendario') }}" + accion
            //         data: objEvent,
            //         success:function(msg){
            //             console.log(msg);
            //         },
            //         error:function(){
            //             alert("Hay un error");
            //         }
            //     });
            // }
        });
        $('.clockpicker').clockpicker();
    </script>
@endsection