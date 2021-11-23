<style>
    #map2 {
        margin: 10px;
        width: 700px;
        height: 300px; 
        padding: 10px;
    }

    #description {
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
        }

        #infowindow-content .title {
            font-weight: bold;
        }

        #infowindow-content {
            display: none;
        }

        #map #infowindow-content {
            display: inline;
        }

        .pac-card {
            margin: 10px 10px 0 0;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            background-color: #fff;
            font-family: Roboto;
        }

        #pac-container {
            padding-bottom: 12px;
            margin-right: 12px;
        }

        .pac-controls {
            display: inline-block;
            padding: 5px 11px;
        }

        .pac-controls label {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
        }

        #pac-input2 {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 400px;
            height: 40px;
        }

        .pac-container { z-index: 100000 !important; }

        #pac-input:focus {
            border-color: #4d90fe;
        }

        #title {
            color: #fff;
            background-color: #4d90fe;
            font-size: 25px;
            font-weight: 500;
            padding: 6px 12px;
        }

        #target {
            width: 345px;
        }

        #lat,
        #long,
        #getlocation {
            width: 400px;
        }
</style>
<form id="form_ubah_mesin">
<div class="modal-body">
    <div class="form-group">
        <label for="nama">Nama Unit</label>
        <input class="form-control nama" id="nama" value="<?= $d_mesin['nama_mesin'] ?>" type="text" required>
        <input type="hidden" class="form-control id_mesin" value="<?= $d_mesin['id_mesin'] ?>">
    </div>

    <div class="form-group">
        <label for="tanggal">Tanggal Jatuh Tempo</label>
        <input class="form-control tanggal" id="tanggal2" value="<?= $d_mesin['tgl_jatuh_tempo'] ?>" type="text" required>
    </div>

    <div class="form-group">
        <label for="no_telp">Nilai Kontrak</label>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Rp. </span>
                </div>
                <input type="text" class="form-control separator nilai_kontrak" id="nilai_kontrak" value="<?= $d_mesin['nilai_kontrak'] ?>" required>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="alamat">Maps</label>
        <div  align="center" class="table-responsive">
            <input type="hidden" id="getlocation2">
            <input id="pac-input2" class="controls form-control" type="text" placeholder="Search Box">
            <div id="map2"></div>
        </div>
    </div>

    <div class="form-group">
        <label for="nama">Latitude</label>
        <input class="form-control lat" id="lat2" placeholder="Masukkan Latitude" value="<?= $d_mesin['lat'] ?>" type="text" readonly>
    </div>
    <div class="form-group">
        <label for="nama">Longitude</label>
        <input class="form-control long" id="long2" placeholder="Masukkan Longitude" value="<?= $d_mesin['long'] ?>" type="text" readonly>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light btn-wth-icon btn-rounded icon-right"  data-dismiss="modal"><span class="btn-text">Tutup</span> <span class="icon-label"><span class="fa fa-close"></span> </span></button>
    <button type="submit" class="btn btn-success btn-wth-icon btn-rounded icon-right"><span class="btn-text">Ubah Data Mesin</span> <span class="icon-label"><span class="fa fa-pencil"></span> </span></button>
</div>
</form>

<script>
        // In the following example, markers appear when the user clicks on the map.
        // The markers are stored in an array.
        // The user can then click an option to hide, show or delete the markers.
        var map;
        var markers = [];


        function initMap() {
            var haightAshbury = {
                lat: <?= (!empty($d_mesin['lat'])) ? $d_mesin['lat'] : '-6.894323999999999' ?>,
                lng: <?= (!empty($d_mesin['long'])) ? $d_mesin['long'] : '107.56080120000001' ?>  
            };

            map = new google.maps.Map(document.getElementById('map2'), {

                center: haightAshbury,
                mapTypeId: 'terrain',
                zoom: 20,
                disableDoubleClickZoom: true,
            });



            // This event listener will call addMarker() when the map is clicked.
            map.addListener('dblclick', function (event) {
                $("#lat2").val(event.latLng.lat());
                $("#long2").val(event.latLng.lng());
                addMarker(event.latLng);


            });

            // Adds a marker at the center of the map.
            addMarker(haightAshbury);

            var input = document.getElementById('pac-input2');
            var searchBox = new google.maps.places.SearchBox(input);

            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            searchBox.addListener('places_changed', function () {
                var places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                // Clear out the old markers.
                markers.forEach(function (marker) {
                    marker.setMap(null);
                });


                // For each place, get the icon, name and location.
                var bounds = new google.maps.LatLngBounds();
                places.forEach(function (place) {
                    if (!place.geometry) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    var icon = {
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25)
                    };

                    // Create a marker for each place.
                    markers.push(new google.maps.Marker({
                        map: map,
                        icon: icon,
                        title: place.name,
                        animation: google.maps.Animation.BOUNCE,
                        position: place.geometry.location
                    }));

                    if (place.geometry.viewport) {
                        // alert(place.geometry.location);
                        var plc = place.geometry.location;
                        // var pcl1 = plc.replace("(", " ");
                        // var pcl2 = plc1.replace(")", " ");
                        // console.log(place.geometry.location);
                        // var pecah = plc.split(",");
                        $("#getlocation2").val(plc);
                        var location = $(("#getlocation2")).val();
                        var pcl1 = location.replace("(", " ");
                        var pcl2 = pcl1.replace(")", " ");
                        var pecah = pcl2.split(",");
                        $("#lat2").val(pecah[0]);
                        $("#long2").val(pecah[1]);
                        $("#long2").val(pecah[1]);
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });

        }



        // Adds a marker to the map and push to the array.
        function addMarker(location) {

            deleteMarkers();
            var marker = new google.maps.Marker({
                position: location,
                map: map,
                animation: google.maps.Animation.BOUNCE,
            });
            markers.push(marker);


        }

        // Sets the map on all markers in the array.
        function setMapOnAll(map) {
            // var m = markers.length + 1;
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(null);

            }
            // markers[1].setMap(null);
            // console.log(markers.length);
        }

        // Removes the markers from the map, but keeps them in the array.
        function clearMarkers() {
            setMapOnAll(null);
        }

        // Shows any markers currently in the array.
        function showMarkers() {
            setMapOnAll(map);
        }

        // Deletes all markers in the array by removing references to them.
        function deleteMarkers() {
            clearMarkers();
            markers = [];
        }
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCX0BerEOaK59srKbH-FnzzRYM1xTzeEts&libraries=places&callback=initMap"
        async defer></script>

<script>

<script>
    $('#tanggal2').dateTimePicker({

        // used to limit the date range
        limitMax: null, 
        limitMin: null, 

        // year name
        yearName: '',

        // month names
        monthName: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],

        // day names
        dayName: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],

        // "date" or "dateTime"
        mode: 'date', 

        // custom date format
        format: null 

    });

    $('.separator').divide({
        delimiter: '.',
        divideThousand: true, // 1,000..9,999
        delimiterRegExp: /[\.\,\s]/g
    });

    $('.separator').keypress(function(event) {
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    $('.lat').keypress(function (e) {
        var txt = String.fromCharCode(e.which);
        if (!txt.match(/[0-9,\-,\.]/)) {
            return false;
        }
    });

    $('.long').keypress(function (e) {
        var txt = String.fromCharCode(e.which);
        if (!txt.match(/[0-9,\-,\.]/)) {
            return false;
        }
    });

</script>