<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/dash-style.css') }}" />
    <link rel="stylesheet" href="{{URL::asset('css/css_jquery.dataTables.min.css')}}">
    {{-- <link rel="stylesheet" href="{{URL::asset('css/jquery.dataTables.min.css')}}"> --}}
    <link rel="stylesheet" href="{{ URL::asset('css/dataTable.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/toastify.min.css') }}">
    <!----===== Boxicons CSS ===== -->
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet" />
    <link href="{{ URL::asset('css/toastr.min.css') }}" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">

    <title>Dashboard</title>
    <style>
        .wrapper {
            position: fixed;
            top: 0;
            left: 250px;
            /* right: 0  ;  */
            width: 100vw;
            height: 100vh;
            overflow-x: scroll;
        }

        .wrapper::-webkit-scrollbar:horizontal {
            height: 15px;
            position: sticky;
            bottom: 0;
            z-index: 1;
        }

        .wrapper::-webkit-scrollbar {
            width: 10px;
        }

        .data-table {}

        .btn {
            padding: 4px;
            margin: 2px;
            text-transform: capitalize;
        }

        input[type="search"] {
            width: 400px;
        }
    </style>
</head>
