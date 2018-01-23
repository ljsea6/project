@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Actualización de nota para el estudiante {{ucwords($student->first_name)}} {{ucwords($student->last_name)}} </div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('students.notes.update', [$student->id, $note->id]) }}">
                            <input type="hidden" name="_method" value="PUT">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nota</label>

                                <div class="col-md-6">
                                    <input id="note" min="1" max="5" type="number" class="form-control" name="note" value="{{ $note->note }}" required autofocus>

                                    @if ($errors->has('note'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                                <label for="state" class="col-md-4 control-label">Estado</label>

                                <div class="col-md-6">
                                    <select id="state"  class="form-control" name="state" required autofocus>
                                        @if($note->state == false)
                                            <option value="1">Aprobar</option>
                                            <option value="0" selected>Sin aprobar</option>
                                        @else
                                            <option value="1" selected>Aprobar</option>
                                            <option value="0">Sin aprobar</option>
                                        @endif
                                    </select>

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
                                        Actualizar
                                    </button>
                                    <a style="text-align: right" href="{{route('students.notes.index', $student->id)}}" class="btn btn-primary">
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
