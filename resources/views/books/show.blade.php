@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">Detail Buku</h2>
                    </div>

                    <div class="panel-body">
                        <div class="form-group {{ $errors->has('title') ? 'has-error':'' }}">
                            {!! Form::label('title', 'Title', ['class'=>'col-md-2 control-label']) !!}
                            <div class="col-md-4">
                                {!! Form::text('title', $book->title, ['class'=>'form-control']) !!}
                                {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                       <div class="form-group {{ $errors->has('title') ? 'has-error':'' }}">
                            {!! Form::label('penulis', 'Penulis', ['class'=>'col-md-2 control-label']) !!}
                            <div class="col-md-4">
                                {!! Form::text('penulis', ""    , ['class'=>'form-control']) !!}
                                {!! $errors->first('penulis', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('title') ? 'has-error':'' }}">
                            {!! Form::label('amount', 'Jumlah', ['class'=>'col-md-2 control-label']) !!}
                            <div class="col-md-4">
                                {!! Form::number('amount', $book->amount, ['class'=>'form-control']) !!}
                                {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('title') ? 'has-error':'' }}">
                            {!! Form::label('cover', 'Cover', ['class'=>'col-md-2 control-label']) !!}
                            <div class="col-md-4">
                                {!! Form::file('cover') !!}<br/>
                                @if(isset($book) && $book->cover)
                                <p>{!! Html::image(asset('images/upload/'.$book->cover),null,['class'=>'img-rounded img-responsive']) !!}</p>
                                @endif
                                {!! $errors->first('cover', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection