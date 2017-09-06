@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">Ubah Penulis</h2>
                    </div>

                    <div class="panel-body">
                        <div class="form-group {{ $errors->has('name') ? 'has-error':'' }}">
                            {!! Form::label('name', 'Nama', ['class'=>'col-md-2 control-label']) !!}
                            <div class="col-md-4">
                                {!! Form::text('name', $author->name, ['class'=>'form-control','readonly'=>'readonly']) !!}
                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection