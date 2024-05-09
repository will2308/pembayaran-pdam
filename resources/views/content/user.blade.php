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

    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formuser">tambah</button> --}}
    @if (Route::current()->uri == 'user')        
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">nama</th>
                <th scope="col">email</th>
                <th scope="col">role</th>
                <th scope="col">kategori</th>
                <th scope="col">telp</th>
                <th scope="col">status</th>
                <th scope="col">alamat</th>
                <th scope="col">aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=$data['from'] ?>
            @foreach ($data['data'] as  $user)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$user['name']}}</td>
                <td>{{$user['email']}}</td>
                <td>{{$user['role']}}</td>
                <td>{{$user['bill_cat']}}</td>
                <td>{{$user['telp']}}</td>
                <td>{{$user['status']}}</td>
                <td>{{$user['address']}}</td>
                <td>
                    {{-- <a href="{{ url('kategori/'.$kategori['id']) }}" class="btn btn-warning"> ubah </a> --}}
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#formuseredit{{$user['id']}}">ubah</button>
                    <div class="modal fade" id="formuseredit{{$user['id']}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <form action="{{ url('user/'.$user['id']) }}" method="post" enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Tambah Kategori</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body row">
                                            @csrf
                                            @method('put')
                                            <div class="mb-3 col-6">
                                                <label for="name" class="col-form-label">Nama</label>
                                                <input type="text" class="form-control" name="name" value="{{$user['name']}}">
                                            </div>
                                            <div class="mb-3 col-6">
                                                <label for="name" class="col-form-label">Email</label>
                                                <input type="email" class="form-control" name="email" value="{{$user['email']}}">
                                            </div>
                                            <div class="mb-3 col-6">
                                                <label for="name" class="col-form-label">Password</label>
                                                <input type="password" class="form-control" name="password">
                                            </div>
                                            <div class="mb-3 col-6">
                                                <label for="name" class="col-form-label">Role</label>
                                                <select class="form-control" name="role">
                                                    @if ($user['role'] == 'admin')
                                                        <option value="admin" selected> Admin </option>
                                                        <option value="customer"> Customer </option>
                                                    @else
                                                        <option value="customer" selected> Customer </option>
                                                        <option value="admin"> Admin </option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="mb-3 col-6">
                                                <label for="name" class="col-form-label">Kategori</label>
                                                <select class="form-control" name="bill_cat">
                                                    <option value="{{$user['bill_cat']}}" selected required>{{ $category[array_search($user['bill_cat'], array_column($category, 'id'))]['name'] }}</option>
                                                    @foreach ($category as $cat)
                                                        <option value="{{$cat['id']}}">{{$cat['name']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3 col-6">
                                                <label for="name" class="col-form-label">No Telpon</label>
                                                <input type="text" class="form-control" name="telp" value="{{$user['telp']}}">
                                            </div>
                                            <div class="mb-3 col-6">
                                                <label for="name" class="col-form-label">Status</label>
                                                <select class="form-control" name="status">
                                                    @if ($user['status'] == 'y')
                                                        <option value="y" selected> sudah </option>
                                                        <option value="n" > belum </option>
                                                    @else
                                                        <option value="n" selected> belum </option>
                                                        <option value="y" > sudah </option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="mb-3 col-6">
                                                <label for="name" class="col-form-label">Gambar</label>
                                                <input id="uploadFileEdt" type="file" class="form-control" name="pic" value="" accept=".jpg,.jpeg,.png" data-id_user="{{$user['id']}}">
                                                <div class="m-2 img-thumbnail imagePreviewEdt" id="imagePreviewEdt_{{$user['id']}}" style="background-image: url(http://localhost:8000/assets/profil_img/{{$user['pic']}})"></div>
                                            </div>
                                            <div class="mb-3 col-6">
                                                <label for="desc" class="col-form-label">Alamat</label>
                                                <textarea class="form-control" name="address">{{ $user['address'] }}</textarea>
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

                    
                    <form action="{{ url('user/'.$user['id']) }}" method="post" onsubmit="return confirm('data {{$user['name']}} akan dihapus!')" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">hapus</button>
                    </form>
                </td>
            </tr> 
            
            @endforeach
        </tbody>
    </table>

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
    <div class="modal fade" id="formuser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form action="{{ url('user') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Tambah Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body row">
                            @csrf
                            @method('post')
                            <div class="mb-3 col-6">
                                <label for="name" class="col-form-label">Nama</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="mb-3 col-6">
                                <label for="name" class="col-form-label">Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="mb-3 col-6">
                                <label for="name" class="col-form-label">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="mb-3 col-6">
                                <label for="name" class="col-form-label">Role</label>
                                <select class="form-control" name="role">
                                    <option selected required>-- pilih role --</option>
                                    <option value="admin"> Admin </option>
                                    <option value="customer"> Customer </option>
                                </select>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="name" class="col-form-label">Kategori</label>
                                <select class="form-control" name="bill_cat">
                                    <option selected required>-- pilih kategori --</option>
                                    @foreach ($category as $cat)
                                        <option value="{{$cat['id']}}">{{$cat['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="name" class="col-form-label">No Telpon</label>
                                <input type="text" class="form-control" name="telp">
                            </div>
                            {{-- <div class="mb-3 col-6">
                                <label for="name" class="col-form-label">Status</label>
                                <select class="form-control" name="status">
                                    <option selected required>-- pilih role --</option>
                                    <option value="y"> sudah </option>
                                    <option value="n"> belum </option>
                                </select>
                            </div> --}}
                            <div class="mb-3 col-6">
                                <label for="name" class="col-form-label">Gambar</label>
                                <input id="uploadFileAdd" type="file" class="form-control" name="pic" accept=".jpg,.jpeg,.png">
                                <div class="m-2 img-thumbnail" id="imagePreviewAdd"></div>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="desc" class="col-form-label">Alamat</label>
                                <textarea class="form-control" name="address"></textarea>
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

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script> 
    $(document).ready(function() {
        $("#uploadFileAdd").on("change", function()
        {
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
    
            if (/^image/.test( files[0].type)){ // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file
    
                reader.onloadend = function(){ // set image data as background of div
                    $("#imagePreviewAdd").css("background-image", "url("+this.result+")");
                }
            }
        });
    });

    $(document).ready(function() {
        $(document).on('change', '#uploadFileEdt', function()
        {
            var id = $(this).data('id_user');
            // console.log(id);
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
    
            if (/^image/.test( files[0].type)){ // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file
    
                reader.onloadend = function(){ // set image data as background of div
                    $("#imagePreviewEdt_"+id).css("background-image", "url("+this.result+")");
                }
            }
        });
    });
</script>

@endsection
