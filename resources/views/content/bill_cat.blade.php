@extends('main')
@section('content')

<div class="container-fluid mt-3">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
    </div>      
    @endif

    @if (session()->has('success'))
    <div class="alert alert-primary">
        {{ session('success')}}
    </div>
    @endif

    <!-- START FORM -->
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <form action='' method='post'>
            @csrf
            @if (Route::current()->uri == 'kategori/{id}')
                @method('put')
            @endif
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Nama Kaetegori</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='name' id="name" value="{{ isset($data['name'])?$data['name']:old('name') }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="desc" class="col-sm-2 col-form-label">Deskripsi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='desc' id="desc" value="{{ isset($data['desc'])?$data['desc']:old('desc') }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="price" class="col-sm-2 col-form-label">price</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='price' id="price" value="{{ isset($data['price'])?$data['price']:old('price') }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
                </div>
            </div>
        </form>
    </div>
    <!-- AKHIR FORM -->

    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formcat">tambah</button> --}}
    @if (Route::current()->uri == 'kategori')        
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">nama</th>
                <th scope="col">harga</th>
                <th scope="col">deskripsi</th>
                <th scope="col">aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $kategori)
            <tr>
                <td>{{$index +1}}</td>
                <td>{{$kategori['name']}}</td>
                <td>{{$kategori['price']}}</td>
                <td>{{$kategori['desc']}}</td>
                <td>
                    <a href="{{ url('kategori/'.$kategori['id']) }}" class="btn btn-warning"> ubah </a>
                    <form action="{{ url('kategori/'.$kategori['id']) }}" method="post" onsubmit="return confirm('data {{$kategori['name']}} akan dihapus!')" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">hapus</button>
                    </form>
                </td>
            </tr> 
            
            @endforeach
        </tbody>
    </table>
    @endif

    {{-- <!-- Modal -->
    <div class="modal fade" id="formcat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('svbillcat') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Nama:</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="col-form-label">Deskripso:</label>
                            <textarea class="form-control" name="desc"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="col-form-label">Harga:</label>
                            <input type="text" class="form-control" name="price">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </div>
        </div>
    </div> --}}
</div>


@endsection
