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
        }

        html,
        body,
        #viewDiv {
            padding: 0;
            margin: 0;
            height: 100%;
            width: 100%;
        }

        .navbar {
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .container {
            margin-top: 2rem;
            height: 80vh;
            width: 80%;
        }

        #viewDiv {
            border: 25px solid rgb(72, 83, 79);
            height: 100%;
            width: 100%;
        }

        .teleport-button {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 999;
        }
    </style>

    <link rel="stylesheet" href="https://js.arcgis.com/4.30/esri/themes/light/main.css" />
    <script src="https://js.arcgis.com/4.30/"></script>

</head>
<script>
    require(["esri/Map", "esri/views/SceneView", "esri/widgets/Search"], (Map, SceneView, Search) => {
        const map = new Map({
            basemap: "satellite",
            ground: "world-elevation"
        });

        const view = new SceneView({
            container: "viewDiv",
            map: map,
            center: [107.614933, -6.934863], // Initial coordinates
            zoom: 16
        });

        const searchWidget = new Search({
            view: view
        });

        view.ui.add(searchWidget, {
            position: "top-right"
        });

        // Function to teleport to a random location
        function teleportToRandomLocation() {
            const randomLongitude = Math.random() * 360 - 180; // Longitude between -180 and 180
            const randomLatitude = Math.random() * 180 - 90; // Latitude between -90 and 90
            view.goTo({
                center: [randomLongitude, randomLatitude],
                zoom: 10 // Adjust zoom level as needed
            });
        }


        // Add Teleport Button
        const teleportButton = document.createElement("button");
        teleportButton.innerText = "Go To Random Location";
        teleportButton.className = "btn btn-secondary teleport-button";
        teleportButton.onclick = teleportToRandomLocation;

        // Append buttons to the document
        document.body.appendChild(teleportButton);
    });
</script>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="/">Arcgis JS Example</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Container for the map -->
    <div class="container">
        <div id="viewDiv"></div>
    </div>
</body>

</html>
