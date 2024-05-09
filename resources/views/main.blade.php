<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pembayaran PDAM</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
        <link href="{{ url('assets/css/styles.css') }}" rel="stylesheet">
        
        
    </head>
    <body>
        <div class="d-flex" id="wrapper">

            @include('layout.sidebar')

            <div id="page-content-wrapper">
                <!-- Top navigation-->
                @include('layout.header')
                <!-- Page content-->
                <div class="container-fluid">
           
                 @yield('content')
                    
                </div>
            </div>


        </div>

        <script src="{{ url('assets/js/scripts.js') }}"></script>
        <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
        <script src="https://bootswatch.com/_vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>