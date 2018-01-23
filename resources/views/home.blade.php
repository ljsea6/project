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
                    ¡Bienvenido(a) {{ ucwords(Auth()->user()->name) }}!
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Listado de estudiantes</div>

                <div class="panel-body">
                    <table id="table_id" class="display" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Documento</th>
                            <th>Madre</th>
                            <th>Padre</th>
                            <th>Notas</th>
                            <th>Asignar Notas</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($students))
                            @foreach($students as $student)
                                <tr>
                                    <td>{{$student->id}}</td>
                                    <td>{{ucwords($student->first_name)}}</td>
                                    <td>{{ucwords($student->last_name)}}</td>
                                    <td>{{number_format($student->dni)}}</td>
                                    <td>{{ucwords($student->father_name)}}</td>
                                    <td>{{ucwords($student->mother_name)}}</td>
                                    <td>
                                        <a href="{{route('students.notes.index', $student->id)}}">
                                            Ver
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{route('students.notes.create', $student->id)}}">
                                            Agregar
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