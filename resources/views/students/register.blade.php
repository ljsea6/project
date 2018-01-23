@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Registro de estudiantes</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('students.store') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nombre</label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Apellidos</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>

                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('dni') ? ' has-error' : '' }}">
                                <label for="dni" class="col-md-4 control-label">Número de documento</label>

                                <div class="col-md-6">
                                    <input id="dni" min="1" type="number" class="form-control" name="dni" value="{{ old('dni') }}" required>

                                    @if ($errors->has('dni'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('dni') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('father_name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nombre del padre</label>

                                <div class="col-md-6">
                                    <input id="father_name" type="text" class="form-control" name="father_name" value="{{ old('father_name') }}" required>

                                    @if ($errors->has('father_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('father_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('mother_name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nombre del la madre</label>

                                <div class="col-md-6">
                                    <input id="mother_name" type="text" class="form-control" name="mother_name" value="{{ old('mother_name') }}" required>

                                    @if ($errors->has('mother_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('mother_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Registrar
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
