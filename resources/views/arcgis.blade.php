<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
    <title>Map with Click Event - ArcGIS Maps SDK</title>
    <!-- Link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <style>
        body {
            background-color: black;
        }

        html,
        body {
            padding: 0;
            margin: 0;
            height: 100%;
            width: 100%;
        }

        .navbar {
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .sidebar {
            height: calc(100% - 80px); /* Adjust for navbar height */
            width: 250px;
            position: fixed;
            top: 80px; /* Adjusted for navbar height */
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
            margin-top: 0px; /* Height of the navbar */
            padding: 1rem; /* Add some padding for better appearance */
            height: calc(100% - 80px); /* Full height minus navbar */
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }

        .card {
            height: 100%;
            width: 100%;
            border: none;
        }

        #viewDiv {
            border: 3px solid rgb(0, 0, 0);
            height: 100%;
            width: 100%;
        }

        .teleport-button {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 999;
        }

        .popup {
            position: absolute;
            background: white;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            z-index: 1000;
            display: none;
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
        document.body.appendChild(teleportButton);

        // Create a popup element
        const popup = document.createElement("div");
        popup.className = "popup";
        document.body.appendChild(popup);

        // Handle map click event
        view.on("click", function(event) {
            const lat = event.mapPoint.latitude.toFixed(6);
            const lon = event.mapPoint.longitude.toFixed(6);

            // Use Nominatim API for reverse geocoding
            const url =
                `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lon}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const address = data.address;
                    const country = address.country || "Not Available";
                    const city = address.city || address.town || address.village || "Not Available";
                    const road = address.road || "Not Available";
                    popup.style.left = `${event.x}px`;
                    popup.style.top = `${event.y}px`;
                    popup.style.display = "block";
                    popup.innerHTML = `
                        <b>Locations</b><br>
                        Coordinates: <br>
                        Latitude: ${lat} <br>
                        Longitude: ${lon} <br><br>
                        Country: ${country} <br>
                        City: ${city} <br>
                        Road: ${road}
                    `;
                })
                .catch(error => {
                    console.error("Error fetching location:", error);
                    popup.style.left = `${event.x}px`;
                    popup.style.top = `${event.y}px`;
                    popup.style.display = "block";
                    popup.innerHTML =
                        `Coordinates: <br> Latitude: ${lat} <br> Longitude: ${lon} <br> Location information not available`;
                });
        });

        // Hide popup when clicking outside of it
        view.on("pointer-move", function() {
            popup.style.display = "none";
        });

    });
</script>

<body>

    <!-- Navbar -->
    @include('navbar')
    <!-- End Navbar -->

    <!-- Sidebar -->
    @include('sidebar')
    <!-- End Sidebar -->

    <!-- Container for the map -->
    <div class="content">
        <div class="card">
            <div class="card-body">
                <div id="viewDiv"></div>
            </div>
        </div>
    </div>
</body>

</html>
