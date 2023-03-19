@extends('dasboard.dasboard')
@section('content')
    <p class="card-title">halaman</p> 
    <div class="pb-3"><a href="{{ route('halaman.create') }}" class="btn btn-primary">Tambah Product</a></div>
                  <div class="table-responsive">
                   <table class="table table-stripped">
                    <thead>
                        <tr>
                            <th class="col-1">No</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th >Product</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->deskripsi }}</td>
                            <td>{{ $item->gambar }}</td>
                            <td>
                                <a href='{{ route('halaman.edit',$item->id) }}'class="btn btn-sm btn-warning">Edit</a>
                                <form onsubmit="return confirm('yakin mau hapus data ini?')" action="{{ route('halaman.destroy', $item->id) }}"class="d-inline" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit"
                                    name='submit'>Del</button>
                                </form>
                           </td>
                        </tr>
                        <?php $i++; ?>
                        @endforeach
                    </tbody>
                   </table>
                  </div>
@endsection
