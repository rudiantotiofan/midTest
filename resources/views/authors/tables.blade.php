<div id="ajax-tables" >
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>

        @if($author->count()==0)
            <tr>
                <td colspan="3" class="text-center">Tidak ada data ditemukan.</td>
            </tr>
        @else
            @foreach($author as $temp)
                <tr>
                    <td>{{ $temp->id }}</td>
                    <td>{{ $temp->name }}</td>
                    <td class="text-center">
                        {!! Form::open([
                            'url' => route('authors.destroy',$temp->id),
                            'method' => 'delete',
                            'class' => 'form-inline js-confirm',
                            'data-confirm' => 'Yakin akan menghapus '.$temp->name

                        ]) !!}
                            <a href="{{ route('authors.show',$temp->id) }}" class="btn btn-default">Detail</a>
                            <a href="{{ route('authors.edit',$temp->id) }}" class="btn btn-primary">Ubah</a>
                            {!! Form::submit('Hapus', ['class'=>'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>    
    <div class="col-md-2 col-md-offset-5" id="paginate">
        {{ $author->links() }}
    </div>
</div>