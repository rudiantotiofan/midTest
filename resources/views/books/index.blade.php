

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">Buku</h2>
                </div>
                <div class="panel-body">
                    <p> <a href="{{ route('books.create') }}" class="btn btn-success">Tambah</a></p>
                    <div class="col-sm-12" style="margin-bottom:15px;padding:0px">
                        {!! Form::label('show','Show : ',array('class'=>'col-sm-1 text-right')) !!}
                        {!! Form::select('show', array('5'=>'5','10'=>'10','20'=>'20','50'=>'50'),'5',array('class'=>'col-sm-1')) !!}
                        <div class="col-sm-8">&nbsp;</div>
                        {!! Form::text('search_key', '', array('class'=>'col-sm-2','id'=>'search_key', 'onkeyup'=>'ajaxSearch()','placeholder'=>'Search Keyword')) !!}
                    </div>
                    @include('books.tables')               
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
{{--  Section for script  --}}
@section('script')
    <script>
        function ajaxSearch(){
            var keyword = $('#search_key').val();
            $.ajax({
                type: "GET",
                url: "{{route('admin-book')}}",
                data: {keyword:keyword},
                success: function(result){
                    $('#ajax-tables').html(result);
                }
            });
        }
    </script>
@endsection