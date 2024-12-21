<div>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>بهاران</title>
        <link rel="stylesheet" href="{{asset('home/login/bootstrap.min.css')}}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
        <link rel="stylesheet" href="{{asset('home/login/style.css')}}">
        <link rel="stylesheet" href="{{asset('home/login/datepicker/persian-datepicker.min.css')}}"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @stack('styles-end')
        @livewireStyles
    </head>
</div>
