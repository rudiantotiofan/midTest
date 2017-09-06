@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">Tambah Buku</h2>
                    </div>

                    <div class="panel-body">
                        {!! Form::open([
                            'url' => route('books.store'),
                            'method' => 'post',
                            'files' => 'true',
                            'class' => 'form-horizontal'
                        ]) !!}
                        @include('books.form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection