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
                        {!! Form::model($author, [
                            'url' => route('authors.update', $author->id),
                            'method' => 'put',
                            'class' => 'form-horizontal'
                        ]) !!}
                        @include('authors.form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection