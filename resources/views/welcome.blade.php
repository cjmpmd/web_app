<!DOCTYPE html>
<html lang="en">

<head>

    <!-- ** Basic Page Needs ** -->
    <meta charset="utf-8">
    <title>ll</title>

    <!-- ** Mobile Specific Metas ** -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">


    <!-- ** Plugins Needed for the Project ** -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Droid&#43;Serif:400%7cJosefin&#43;Sans:300,400,600,700 ">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/themefisher-font/themefisher-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/slick/slick.min.css') }}">

    <!-- Stylesheets -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">

</head>

<body id="body">

    @php
        $buttontext = 'Watch report';
    @endphp
    <!-- preloader start -->
    <div class="preloader"></div>
    <!-- preloader end -->


    <header class="navigation sticky-top bg-white">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="collapse navbar-collapse text-center" id="navigation">
                   

                </div>
            </nav>
        </div>
    </header>

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center mb-5 mb-md-0">
                    <img class="img-fluid" style="border-radius: 15px" src="{{ asset('images/VolvoPolestarTA.webp') }}"
                        alt="">
                </div>
                <div class="col-md-6 align-self-center text-center text-md-center">
                    <div class="block">
                        <h1 class="font-weight-bold mb-4 font-size-60">New Zealand's stolen vehicles report</h1>
                        <a href="{{route('ats_index')}}" class="btn btn-main">{{ $buttontext }}</a>
                        <br>
                        <br>
                        <a style="font-size: 15px" href="{{route('ats_index')}}" class="btn btn-main">Site infrastructure</a>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('plugins/jquery/jquery.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/slick/slick.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
