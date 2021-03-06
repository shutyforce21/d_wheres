<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>マーカーでカスタムアイコンを追加</title>
        <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
        <link href="https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css" rel="stylesheet">
        <script src="https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js"></script>
        <style>
        body { margin: 0; padding: 0; }
        #map { position: absolute; top: 0; bottom: 0; width: 80%; height: 80%}
        </style>
    </head>
    <body>
        <style>
            .marker {
                display: block;
                border: none;
                border-radius: 50%;
                cursor: pointer;
                padding: 0;
            }
        </style>
        <div>
        </div>
        <div id="map"></div>
        <article id='asdf'>

        </article>
        <script>
            mapboxgl.accessToken = 'pk.eyJ1Ijoic2h1dHlmb3JjZSIsImEiOiJja3c3dG1ja3YxdHN6MnZtbjlobHdpYmU0In0.CUgXUng_QUDPiDEGKnRQQw';
            const geojson = {
                'type': 'FeatureCollection',
                'features': [
                    {
                        'type': 'Feature',
                        'properties': {
                        'message': 'Foo',
                        'iconSize': [35, 35]
                    },
                        'geometry': {
                            'type': 'Point',
                            'coordinates': [-66.324462, -16.024695]
                        }
                    },{
                        'type': 'Feature',
                        'properties': {
                        'message': 'Bar',
                        'iconSize': [35, 35]
                    },
                        'geometry': {
                            'type': 'Point',
                            'coordinates': [-61.21582, -15.971891]
                        }
                    },
                    {
                        'type': 'Feature',
                        'properties': {
                            'message': 'Baz',
                            'iconSize': [35, 35]
                        },
                        'geometry': {
                            'type': 'Point',
                            'coordinates': [-63.292236, -18.281518]
                            }
                    }
                ]
            };
            
            const map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v11',
                center: [-65.017, -16.457],
                zoom: 5
            });
            
            // Add markers to the map.
            for (const marker of geojson.features) {
                // Create a DOM element for each marker.
                const el = document.createElement('img');
                const width = marker.properties.iconSize[0];
                const height = marker.properties.iconSize[1];
                el.className = 'marker';
                // el.style.backgroundImage = `url(https://placekitten.com/g/${width}/${height}/)`;
                el.src = `{{ asset('/image/home/icon/marker.png')}}`;
                el.style.width = `${width}px`;
                el.style.height = `${height}px`;
                el.style.backgroundColor = 'red';
                // el.style.backgroundSize = '100%';
                el.addEventListener('click', () => {
                    window.alert(marker.properties.message);
                });
                // Add markers to the map.
                new mapboxgl.Marker(el)
                .setLngLat(marker.geometry.coordinates)
                .addTo(map);
                // var asdf = document.getElementById('asdf');
                // asdf.appendChild(el);
            }
        </script>
    </body>
</html>