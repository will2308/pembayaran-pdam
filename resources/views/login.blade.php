<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login Page</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
        
    </head>
    <body>
        <div class="container">
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                @foreach ($errors->all() as $item)
                <strong><i class="fa-solid fa-triangle-exclamation"></i> {{ $item }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                @endforeach
            </div>      
            @endif 

            @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <strong><i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="d-flex align-items-center justify-content-center vh-100">
                <div class="container shadow p-3 mb-5 bg-body rounded">
                    <div class="text-center">
                        <img class="img-thumbnail rounded m-2 align-center" src="https://logowik.com/content/uploads/images/water-drop5285.logowik.com.webp" alt="" width="150" height="150">
                        <h2 class="">Pembayaran PDAM</h2>
                    </div>
                    <form action="{{ route('dologin') }}" method="post" class="container-fluid mt-5">
                        @csrf
                        @method('post')
                        <div class="form-group text-center p-2">
                          {{-- <label for="exampleInputEmail1">Email address</label> --}}
                          <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="email atau nomor telepon">
                        </div>
                        <div class="form-group text-center p-2">
                          {{-- <label for="exampleInputPassword1"></label> --}}
                          <input name="password" type="password" class="form-control" placeholder="password">
                        </div>
                        <div class="form-group form-check">
                          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small><br>
                          <input type="checkbox" class="form-check-input" id="exampleCheck1">
                          <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-lg btn-primary" type="submit">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>         
        </div>
        {{-- <ul>
            <li>PHP: {{ phpversion() }}</li>
            <li>Laravel: {{ app()->version() }}</li>
        </ul> --}}
        <script src="https://bootswatch.com/_vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>