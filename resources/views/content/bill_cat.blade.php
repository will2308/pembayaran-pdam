@extends('main')
@section('content')

<div class="container-fluid mt-3">

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show">
        <ul>
            @foreach ($errors->all() as $item)
                <li><i class="fa-solid fa-triangle-exclamation"></i> {{ $item }}</li>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            @endforeach
        </ul>
    </div>      
    @endif

    @if (session()->has('success'))
    <div class="alert alert-primary alert-dismissible fade show">
        <strong><i class="fa-regular fa-thumbs-up"></i> {{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formkategori">tambah</button> --}}
    @if (Route::current()->uri == 'kategori' || 'kategori/keyword')   
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
            <?php $i=$data['from'] ?>
            @foreach ($data['data'] as  $kategori)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$kategori['name']}}</td>
                <td>{{$kategori['price']}}</td>
                <td>{{$kategori['desc']}}</td>
                <td>
                    {{-- <a href="{{ url('kategori/'.$kategori['id']) }}" class="btn btn-warning"> ubah </a> --}}
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#formcatedit{{$kategori['id']}}">ubah</button>
                    <div class="modal fade" id="formcatedit{{$kategori['id']}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ url('kategori/'.$kategori['id']) }}" method="put">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Tambah Kategori</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                            @csrf
                                            @method('put')
                                            <div class="mb-3">
                                                <label for="name" class="col-form-label">Nama:</label>
                                                <input type="text" class="form-control" name="name" value="{{$kategori['name']}}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="desc" class="col-form-label">Deskripsi:</label>
                                                <textarea class="form-control" name="desc">{{$kategori['desc']}}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="price" class="col-form-label">Harga:</label>
                                                <input type="text" class="form-control" name="price" value="{{$kategori['price']}}">
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">batal</button>
                                        <button type="submit" class="btn btn-primary">simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    
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
    {{print_r($data['links'])}}
    @if ($data['links'])
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            @foreach ($data['links'] as $paginate)
                <li class="page-item {{ $paginate['active']?'active':'' }}"><a class="page-link" href="{{ $paginate['url_fix'] }}">{!! $paginate['label'] !!}</a></li>                
            @endforeach
        </ul>
    </nav>
    @endif

    @endif

    <!-- Modal -->
    <div class="modal fade" id="formkategori" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('kategori') }}" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Tambah Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            @csrf
                            @method('post')
                            <div class="mb-3">
                                <label for="name" class="col-form-label">Nama:</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="desc" class="col-form-label">Deskripsi:</label>
                                <textarea class="form-control" name="desc"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="col-form-label">Harga:</label>
                                <input type="text" class="form-control" name="price">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
