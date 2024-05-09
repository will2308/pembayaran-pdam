<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container-fluid">
        <button class="btn btn-outline-light" id="sidebarToggle"><i class="fa-solid fa-bars text-success"></i></button>
        {{-- @if (substr(URL::current(), strrpos(URL::current(), '/') + 1) == "trbuy") --}}
            {{-- <h3 class="text-success">Pembelian</h3> --}}
        {{-- @elseif (substr(URL::current(), strrpos(URL::current(), '/') + 1) == "trproduction" )
            <h3 class="text-success">Produksi</h3>
        @elseif (substr(URL::current(), strrpos(URL::current(), '/') + 1) == "admin" )
            <h3 class="text-success">Dashboard</h3>
        @elseif (substr(URL::current(), strrpos(URL::current(), '/') + 1) == "material" )
            <h3 class="text-success">Bahan</h3>
        @else --}}
            <h3 class="text-success text-capitalize">{{ substr(URL::current(), strrpos(URL::current(), '/') + 1) }}</h3>
        {{-- @endif --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                {{-- @if (substr(URL::current(), strrpos(URL::current(), '/') + 1) != "admin" )                     --}}
                 {{-- <li class="nav-item">
                    <button class="btn btn-outline-success"><i class="fa fa-search"></i><input class="m-1" type="text" name="" id=""></button>
                </li> --}}
                {{-- @endif                --}}
                <li class="nav-item m-1">
                    <button class="btn btn-sm btn-success rounded"  data-bs-toggle="modal" data-bs-target="#form{{ substr(URL::current(), strrpos(URL::current(), '/') + 1) }}">tambah</i></button>
                </li>
                <li class="nav-item m-1">
                    <form class="d-flex m-0" method="post" action="{{ url('kategori/keyword') }}">
                        @csrf
                        @method('post')
                        <input class="form-control form-control-sm" type="search" placeholder="Search" aria-label="Search" name='keyword'>
                        <button class="btn btn-sm btn-outline-success" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </li>
                <li class="nav-item m-1">
                    <button class="btn btn-sm btn-success rounded" data-bs-toggle="collapse" data-bs-target="#filter">filter <i class="fa fa-sort fa-solid"></i></button>
                    
                </li>
                <li class="nav-item dropdown m-1">
                    <button class="btn btn-sm btn-outline-success dropdown-toggle text-capitalize" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ session()->get('login_data')['name'] }} <i class="fa fa-user"></i></button  >
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#profil">Profil</button>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div id="filter" class="collapse">
    <div class="accordion-body">
        <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
</div>

<div class="modal fade" id="profil" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Profil</h5>
        </div>
          <div class="modal-body">
            <div class="form-group">
                <label for="exampleInputEmail1">nama</label>
                <input class="form-control" value="{{ session()->get('login_data')['name'] }}" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input class="form-control" value="{{ session()->get('login_data')['email'] }}" readonly>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Jabatan</label>
              <input class="form-control" value="{{ session()->get('login_data')['role'] }}" readonly>
          </div>
            {{-- <div class="col-12 form-group">
                <label for="exampleInputEmail1">Foto</label>
                <input name="pic" type="file" class="form-control" placeholder="masukan foto">
            </div> --}}
            <div class="form-group">
                <label for="exampleInputEmail1">Alamat</label>
                <textarea class="form-control" readonly>{{ session()->get('login_data')['address'] }}</textarea>
            </div>
            <div class="d-grid gap-2 m-2">
                <button class="btn btn-lg btn-secondary" data-bs-dismiss="modal">tutup</button>
            </div>
          </div>
        </div>
    </div>
  </div>
 