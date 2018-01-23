@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Registro de nota para el estudiante {{ucwords($student->first_name)}} {{ucwords($student->last_name)}} </div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('students.notes.store', $student->id) }}">

                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nombre</label>

                                <div class="col-md-6">
                                    <input id="note" min="1" max="5" type="number" class="form-control" name="note" value="{{ old('note') }}" required autofocus>

                                    @if ($errors->has('note'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Agregar
                                    </button>
                                    <a style="text-align: right" href="{{route('home')}}" class="btn btn-primary">
                                        Atrás
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
