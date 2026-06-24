document.addEventListener('DOMContentLoaded', async () => {
    const mapElement = document.getElementById('map');

    // membaca lokasi asal dan lokasi tujuan dari HTML data attributes
    const origin = mapElement.getAttribute('data-origin');
    const destination = mapElement.getAttribute('data-destination');

    // Inisialisasi map
    const map = L.map('map').setView([-6.175110, 106.865036], 11);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // OpenRouteService API
    const openRouteServiceApiKey = "5b3ce3597851110001cf62484513a8aa39534c9cb41a0662515a790a";

    // Fungsi untuk meng-decode polyline dari OpenRouteService
    function decodePolyline(encoded) {
        let points = [];
        let index = 0, len = encoded.length;
        let lat = 0, lng = 0;

        while (index < len) {
            let b, shift = 0, result = 0;
            do {
                b = encoded.charCodeAt(index++) - 63;
                result |= (b & 0x1f) << shift;
                shift += 5;
            } while (b >= 0x20);
            let dlat = (result & 1) ? ~(result >> 1) : (result >> 1);
            lat += dlat;

            shift = 0;
            result = 0;
            do {
                b = encoded.charCodeAt(index++) - 63;
                result |= (b & 0x1f) << shift;
                shift += 5;
            } while (b >= 0x20);
            let dlng = (result & 1) ? ~(result >> 1) : (result >> 1);
            lng += dlng;

            points.push([lat / 1e5, lng / 1e5]);
        }
        return points;
    }

    // Function to fetch route from OpenRouteService
    async function fetchRoute(coordinates) {
        try {
            const response = await fetch("https://api.openrouteservice.org/v2/directions/driving-car", {
                method: 'POST',
                headers: {
                    'Authorization': openRouteServiceApiKey,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ coordinates: coordinates })
            });

            const result = await response.json();
            if (!response.ok || !result.routes) {
                throw new Error(`API Error: ${response.status} - ${result.message || "Unknown Error"}`);
            }
            return result;
        } catch (error) {
            console.error("Failed to fetch route:", error);
            return null;
        }
    }

    // Function to fetch coordinates from location name
    async function fetchCoordinates(location) {
        try {
            const response = await fetch(`https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(location)}&format=json`);
            const data = await response.json();
            return data.length > 0 ? [parseFloat(data[0].lon), parseFloat(data[0].lat)] : null;
        } catch (error) {
            console.error("Error fetching coordinates:", error);
            return null;
        }
    }

    // Main function to plot the route
    async function plotRouteAndMarkers() {
        // Get coordinates for origin and destination
        const originCoords = await fetchCoordinates(origin);
        const destinationCoords = await fetchCoordinates(destination);

        if (originCoords || destinationCoords) {
            // Add markers
            L.marker([originCoords[1], originCoords[0]]).addTo(map)
                .bindPopup("Origin: " + origin).openPopup();
            L.marker([destinationCoords[1], destinationCoords[0]]).addTo(map)
                .bindPopup("Destination: " + destination);

            // Fetch and display route
            const routeData = await fetchRoute([originCoords, destinationCoords]);

            if (routeData || routeData.routes) {
                const encodedGeometry = routeData.routes[0].geometry;
                const routeCoordinates = decodePolyline(encodedGeometry);

                // Draw route
                const polyline = L.polyline(routeCoordinates, {
                    color: 'black',
                    weight: 5,
                    opacity: 0.7
                }).addTo(map);

                // Fit map to show the entire route
                map.fitBounds(polyline.getBounds());
            }
        }
    }

    // Execute the plotting
    plotRouteAndMarkers();
});
