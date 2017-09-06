<div id="ajax-tables" >
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Jumlah</th>
                <th>Penulis</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
        

        @if($book->count()==0)
            <tr>
                <td colspan="5" class="text-center">Tidak ada data ditemukan.</td>
            </tr>
        @else
            @foreach($book as $temp)
                <tr>
                    <td>{{ $temp->id }}</td>
                    <td>{{ $temp->title }}</td>
                    <td>{{ $temp->amount }}</td>
                    <td>
                        {{ $temp->author->name }}
                    </td>
                    <td class="text-center">
                        {!! Form::open([
                            'url' => route('books.destroy',$temp->id),
                            'method' => 'delete',
                            'class' => 'form-inline js-confirm',
                            'data-confirm' => 'Yakin akan menghapus '.$temp->name

                        ]) !!}
                            <a href="{{ route('books.show',$temp->id) }}" class="btn btn-default">Detail</a>
                            <a href="{{ route('books.edit',$temp->id) }}" class="btn btn-primary">Ubah</a>
                            {!! Form::submit('Hapus', ['class'=>'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>    
    <div class="col-md-2 col-md-offset-5" id="paginate">
        {{ $book->links() }}
    </div>
</div>