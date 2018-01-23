@extends('layouts.app')

@section('styles')
    <style>
        th {
            text-align: center;
        }
        td {
            text-align: center;
        }
    </style>
@endsection

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        ¡Notas del estudiante {{ ucwords($student->first_name) }} {{ ucwords($student->last_name) }}!
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Listado de notas</div>

                    <div class="panel-body">
                        <table id="table_id" class="display" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nota</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($notes))
                                @foreach($notes as $note)
                                    <tr>
                                        <td>{{$note->id}}</td>
                                        <td>{{number_format($note->note)}}</td>
                                        @if ($note->state == true)
                                            <td>Aprobada</td>
                                        @else
                                            <td>No aprobada</td>
                                        @endif
                                        <td>
                                            <a href="{{route('students.notes.edit', [$note->student_id, $note->id])}}">
                                                Actualizar
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <a style="text-align: right" href="{{route('home')}}" class="btn btn-primary">
                    Atrás
                </a>
            </div>
        </div>


    </div>

@endsection

@section('scripts')

    <script type="application/javascript">

        $(document).ready(function() {
            $('#table_id').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                }
            });
        });

    </script>
@stop