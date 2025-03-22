<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="{{ asset('/assets') }}/css/backend-plugin.mine209.css?v=1.0.0">
        <link rel="stylesheet" href="{{ asset('/assets') }}/css/backende209.css?v=1.0.0">
        <link rel="stylesheet" href="{{ asset('/assets') }}/vendor/remixicon/fonts/remixicon.css">
        <link rel="stylesheet" href="{{ asset('/assets') }}/vendor/icon/dripicons/dripicons.css">
        <!-- Line Awesome CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css">


        @vite(['resources/js/app.js'])
    </head>

    <body>
        <div id="app"></div>
        <script src="{{ asset('/assets') }}/js/backend-bundle.min.js"></script>

        <!-- Flextree Javascript-->
        <script src="{{ asset('/assets') }}/js/flex-tree.min.js"></script>
        <script src="{{ asset('/assets') }}/js/tree.js"></script>

        <!-- Table Treeview JavaScript -->
        <script src="{{ asset('/assets') }}/js/table-treeview.js"></script>

        <!-- SweetAlert JavaScript -->
        <script src="{{ asset('/assets') }}/js/sweetalert.js"></script>

        <!-- Chart Custom JavaScript -->
        <script src="{{ asset('/assets') }}/js/chart-custom.js"></script>

        <!-- slider JavaScript -->
        <script src="{{ asset('/assets') }}/js/slider.js"></script>

        <!-- app JavaScript -->
        <script src="{{ asset('/assets') }}/js/app.js"></script>
    </body>
</html>
