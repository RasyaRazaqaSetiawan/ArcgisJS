<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
    <title>Intro to MapView - Create a 2D map | Sample | ArcGIS Maps SDK for JavaScript 4.30</title>
    <!-- Link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <style>
        body {
            background-color: #333333;
            margin: 0;
            padding: 0;
        }

        html,
        body {
            height: 100%;
            width: 100%;
        }

        .navbar {
            background-color: #343a40;
            padding-top: 20px;
            padding-bottom: 20px;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .sidebar {
            height: calc(100% - 80px);
            width: 250px;
            position: fixed;
            top: 80px;
            left: 0;
            background-color: #343a40;
            padding-top: 20px;
            color: white;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            margin-left: 250px; /* Same width as sidebar */
            margin-top: 80px; /* Height of the navbar */
            height: calc(100% - 80px); /* Full height minus navbar */
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }

        .content h1 {
            font-size: 24px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    @include('navbar')
    <!-- End Navbar -->

    <!-- Sidebar -->
    @include('sidebar')
    <!-- End Sidebar -->

    <!-- Content -->
    <div class="content">
        <h1>Belajar Arcgis Menggunakan Laravel 11</h1>
    </div>
    <!-- End Content -->

</body>

</html>
