@extends('dashboard.layout')

@section('content')
    <div class="row">
        
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        let viewStatistics = {
            'user': $('#tUser'),
            'koridor': $('#tKoridor'),
            'shelter': $('#tShelter'),
            'bus': $('#tBus'),
            'tiket_hari_ini': $('#vTiketToday'),
            'transaksi_hari_ini': $('#vTransaksiToday'),
            'transaksi_bulan_ini': $('#vTransaksiBulan'),
        };
        let statistic = document.getElementById("7dayTransaction").getContext('2d');
        let Area = "Jawa Tengah";
        let myLocation = { lat: -6.966667, lng: 110.416664 };
        let map,directionsService,directionsRenderer,geocoder;
        let mapMarker = null;
        let koridorRoutes;
        console.log(koridorRoutes);

        function reloadStatistics(info,chart) {
            let day = [
                moment().subtract(6,'days').format('DD-MM-YYYY'),
                moment().subtract(5,'days').format('DD-MM-YYYY'),
                moment().subtract(4,'days').format('DD-MM-YYYY'),
                moment().subtract(3,'days').format('DD-MM-YYYY'),
                moment().subtract(2,'days').format('DD-MM-YYYY'),
                moment().subtract(1,'days').format('DD-MM-YYYY'),
                moment().format('DD-MM-YYYY'),
            ];
            $.ajax({
                url: '{{ url('dashboard/statistics') }}',
                method: 'post',
                data: {
                    day: day
                },
                success: function (response) {
                    // console.log(response);
                    // info.user.html(response.user_aplikasi+' Users');
                    // info.koridor.html(response.koridor+' Koridor');
                    // info.shelter.html(response.problem+' Masalah');
                    // info.bus.html(response.bus+' Bus'+'<br>'+response.shelter+' Shelter');
                    info.tiket_hari_ini.html(response.tiket_hari_ini);
                    info.transaksi_hari_ini.html('Rp '+numeral(response.transaksi_hari_ini).format('0,0'));
                    info.transaksi_bulan_ini.html('Rp '+numeral(response.transaksi_bulan_ini).format('0,0'));

                    chart.data.labels = day;
                    chart.data.datasets[0].data = response.statistics_chart;
                    chart.update();
                },
                error: function (response) {
                    console.log(response);
                }
            })
        }

        function getKoridor() {
            $.ajax({
                url: '{{ url('dashboard/koridor-location') }}',
                method: 'post',
                success: function (response) {
                    // console.log(response);
                    koridorRoutes = response;
                    for (let i = 0; i < koridorRoutes.length; i++) {
                        let startPoint = new google.maps.LatLng(koridorRoutes[i]['lat_a'], koridorRoutes[i]['lng_a']);
                        let endPoint = new google.maps.LatLng(koridorRoutes[i]['lat_b'], koridorRoutes[i]['lng_b']);
                        let waypoints = [];
                        let directionsDisplay = new google.maps.DirectionsRenderer({
                            map: map,
                            preserveViewport: true,
                            suppressMarkers: false
                        });
                        let bounds = new google.maps.LatLngBounds();
                        koridorRoutes[i].shelter.forEach(function (v,i) {
                            let waypoint = new google.maps.LatLng(v.lat, v.lng);
                            waypoints.push(
                                {
                                    location: waypoint,
                                    stopover: true
                                }
                            )
                        });
                        // console.log(waypoints);
                        calcRoute(directionsService, directionsDisplay, startPoint, endPoint, waypoints, bounds);
                    }
                },
                error: function (response) {
                    console.log(response);
                }
            })
        }

        function initMap() {
            directionsService = new google.maps.DirectionsService();
            directionsRenderer = new google.maps.DirectionsRenderer();
            geocoder = new google.maps.Geocoder();
            map = new google.maps.Map(document.getElementById('mapContainer'), {
                // center: myLocation,
                // center: {lat:0,lng:0},
                zoom: 8
            });

            geocoder.geocode( {'address' : Area}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    map.setCenter(results[0].geometry.location);
                }
            });

            map.addListener('click', function(e) {
                placeMarkerAndPanTo(e.latLng, map);
            });
        }

        function placeMarkerAndPanTo(latLng, map) {
            if (mapMarker !== null) {
                mapMarker.setMap(null);
            }
            mapMarker = new google.maps.Marker({
                position: latLng,
                map: map
            });
            map.panTo(latLng);
        }

        function calcRoute(directionsService, directionsDisplay, startPoint, endPoint, waypoints, bounds) {
            // const start = document.getElementById('start').value;
            // const end = document.getElementById('end').value;
            const request = {
                origin: startPoint,
                destination: endPoint,
                waypoints: waypoints,
                travelMode: 'DRIVING'
            };
            directionsService.route(request, function(response, status) {
                if (status == 'OK') {
                    directionsDisplay.setDirections(response);
                    // bounds.union(response.routes[0].bounds);
                    // map.fitBounds(bounds);
                }
            });
        }

        $(document).ready(function () {
            getKoridor();

            // for (let i = 0; i < koridorRoutes.length; i++) {
            //     let startPoint = new google.maps.LatLng(koridorRoutes[i]['lat_a'], koridorRoutes[i]['lng_a']);
            //     let endPoint = new google.maps.LatLng(koridorRoutes[i]['lat_b'], koridorRoutes[i]['lng_b']);
            //     let directionsDisplay = new google.maps.DirectionsRenderer({
            //         map: map,
            //         preserveViewport: true,
            //         suppressMarkers: false
            //     });
            //     let bounds = new google.maps.LatLngBounds();
            //     calcRoute(directionsService, directionsDisplay, startPoint, endPoint, bounds);
            // }

            let statisticChart = new Chart(statistic, {
                type: 'line',
                data: {
                    labels: ['','','','','','',''],
                    datasets: [{
                        label: 'Tiket',
                        data: [0,0,0,0,0,0,0],
                        borderWidth: 5,
                        borderColor: '#ff0004',
                        backgroundColor: 'transparent',
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#9b000a',
                        pointRadius: 4
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    tooltips: {
                        mode: 'label',
                        label: 'mylabel',
                        callbacks: {
                            label: function(tooltipItem, data) {
                                return 'Rp '+numeral(tooltipItem.yLabel.toString()).format('0,0');
                            },
                        },
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: false,
                                drawBorder: false,
                            },
                            ticks: {
                                stepSize: 150,
                                callback: function(value, index, values) {
                                    return numeral(value).format('0,0');
                                }
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                color: '#fbfbfb',
                                lineWidth: 2
                            }
                        }]
                    },
                }
            });
            reloadStatistics(viewStatistics,statisticChart);
            setInterval(function () {
                reloadStatistics(viewStatistics,statisticChart);
            },5000);
        });
    </script>
    @include('dashboard._partials.google-maps')
@endsection
