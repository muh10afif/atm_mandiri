<style>
    #tabel_mesin_atm thead tr th {
        text-align: center;
    }

    #map {
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

        #pac-input {
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
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item">Master Data</li>
        <li class="breadcrumb-item active" aria-current="page">Mesin ATM</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<!-- Container -->
<div class="container">

    <!-- lat
    <input type="text" id="lat">
    long
    <input type="text" id="long">
    <input type="hidden" id="getlocation">
    <input id="pac-input" class="controls" type="text" placeholder="Search Box">
    <div id="map"></div> -->

    <!-- Title -->
    <div class="row mb-30">
        <div class="col-md-10">
            <div class="hk-pg-header">
                <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="hard-drive"></i></span></span>Master Data Mesin ATM</h4>
            </div>
        </div>
        <div class="col-md-2" align="left">
            <button class="btn btn-info btn-wth-icon btn-rounded icon-right" data-toggle="modal" data-target="#tambah_mesin"><span class="btn-text">Tambah Data</span> <span class="icon-label"><span class="feather-icon"><i data-feather="plus-circle"></i></span> </span></button>
        </div>
    </div>
    <!-- /Title -->

    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper  table-responsive">

            <table id="tabel_mesin_atm" class="table table-bordered table-hover w-100 display pb-30">
                <thead class="thead-info">
                    <tr>
                        <th>No</th>
                        <th>Nama Unit</th>
                        <th>Alamat</th>
                        <th width=25%;>Tanggal Jatuh Tempo</th>
                        <th width=28%;>Nilai Kontrak</th>
                        <th width=25%;>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>

            </section>
        </div>
    </div>
    <!-- /Row -->
</div>
<!-- /Container -->

<!-- Modal Tambah Mesin -->
<div id="tambah_mesin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambah_mesin_title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-info ">
                <h5 class="modal-title text-white" id="my-modal-title"><i class="fa fa-plus-circle"></i><?= nbs(2) ?>Tambah Mesin</h5>
                <button class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="form_tambah_mesin">
                <div class="form-group">
                    <label for="nama">Nama Unit</label>
                    <input class="form-control" id="nama" placeholder="Masukkan Nama Unit" type="text" required>
                </div>

                <div class="form-group">
                    <label for="tanggal">Tanggal Jatuh Tempo</label>
                    <input class="form-control" id="tanggal" placeholder="Masukkan Tanggal Jatuh Tempo" type="text" required>
                </div>

                <div class="form-group">
                    <label for="no_telp">Nilai Kontrak</label>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Rp. </span>
                            </div>
                            <input type="text" class="form-control separator" id="nilai_kontrak" placeholder="Masukkan Nilai Kontrak" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="alamat">Maps</label>
                    <div  align="center" class="table-responsive">
                    <input type="hidden" id="getlocation">
                    <input id="pac-input" class="controls form-control" type="text" placeholder="Search Box">
                        <div id="map"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama">Latitude</label>
                    <input class="form-control" id="lat" placeholder="Masukkan Latitude" type="text" readonly>
                </div>
                <div class="form-group">
                    <label for="nama">Longitude</label>
                    <input class="form-control" id="long" placeholder="Masukkan Longitude" type="text" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-wth-icon btn-rounded icon-right"  data-dismiss="modal"><span class="btn-text">Tutup</span> <span class="icon-label"><span class="fa fa-close"></span> </span></button>
                <button type="submit" class="btn btn-success btn-wth-icon btn-rounded icon-right"><span class="btn-text">Tambah Data Mesin</span> <span class="icon-label"><span class="fa fa-check"></span> </span></button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Akhir Modal Tambah Mesin -->

<!-- Modal Edit Mesin -->
<div id="edit_mesin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="edit_mesin_title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-info ">
                <h5 class="modal-title text-white" id="my-modal-title"><i class="fa fa-edit"></i><?= nbs(2) ?>Ubah Mesin</h5>
                <button class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="form_data_mesin">
            
            </div>
        </div>
    </div>
</div>
<!-- Akhir Modal Edit Mesin -->

<!-- date picker -->
<link rel="stylesheet" href="<?= base_url() ?>assets/datepicker/datepicker.min.css">
<!-- jQuery -->
<script src="<?= base_url() ?>assets/vendors/jquery/dist/jquery.min.js"></script>
<!-- date picker -->
<script src="<?= base_url() ?>assets/datepicker/datepicker.min.js"></script>

<!-- <script>
    var map;
    function initMap() {
    var opts = { 'center': new google.maps.LatLng(-6.952928, 107.638431), 'zoom': 12, 'mapTypeId': google.maps.MapTypeId.ROADMAP }
    map = new google.maps.Map(document.getElementById('map'), opts);

    google.maps.event.addListener(map,'click',function(event) {
    document.getElementById('lat').value = event.latLng.lat();
    document.getElementById('long').value = event.latLng.lng();
    });
    } 
    google.maps.event.addDomListener(window, 'load', init_map);
 </script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCX0BerEOaK59srKbH-FnzzRYM1xTzeEts&callback=initMap"></script> -->


 <script>
        // In the following example, markers appear when the user clicks on the map.
        // The markers are stored in an array.
        // The user can then click an option to hide, show or delete the markers.
        var map;
        var markers = [];


        function initMap() {
            var haightAshbury = {
                lat: -6.894323999999999,
                lng: 107.56080120000001  
            };

            map = new google.maps.Map(document.getElementById('map'), {

                center: haightAshbury,
                mapTypeId: 'terrain',
                zoom: 20,
                disableDoubleClickZoom: true,
            });



            // This event listener will call addMarker() when the map is clicked.
            map.addListener('dblclick', function (event) {
                $("#lat").val(event.latLng.lat());
                $("#long").val(event.latLng.lng());
                addMarker(event.latLng);


            });

            // Adds a marker at the center of the map.
            addMarker(haightAshbury);

            var input = document.getElementById('pac-input');
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
                        $("#getlocation").val(plc);
                        var location = $(("#getlocation")).val();
                        var pcl1 = location.replace("(", " ");
                        var pcl2 = pcl1.replace(")", " ");
                        var pecah = pcl2.split(",");
                        $("#lat").val(pecah[0]);
                        $("#long").val(pecah[1]);
                        $("#long").val(pecah[1]);
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

    $(document).ready(function () {

        $('#lat').keypress(function (e) {
            var txt = String.fromCharCode(e.which);
            if (!txt.match(/[0-9,\-,\.]/)) {
                return false;
            }
        });

        $('#long').keypress(function (e) {
            var txt = String.fromCharCode(e.which);
            if (!txt.match(/[0-9,\-,\.]/)) {
                return false;
            }
        });
        
        $('#pesan').hide();
        $('#pesan_hapus').hide();

        // menampilkan list data mesin
        var data_mesin  = $('#tabel_mesin_atm').DataTable({
            "processing"    : true,
            "ajax"          : "<?= base_url('Master/tampil_mesin_atm') ?>",
            stateSave       : true,
            "order"         : []
        })

        // proses tambah mesin
        $('#form_tambah_mesin').on('submit', function () {
            var nama            = $('#nama').val();
            var tanggal         = $('#tanggal').val();
            var nilai_kontrak   = $('#nilai_kontrak').val();
            var alamat          = $('#alamat').val();
            var lat             = $('#lat').val();
            var long            = $('#long').val();

            $.ajax({
                type    : "post",
                url     : "<?= base_url('Master/tambah_mesin') ?>",
                beforeSend  : function () {
                    swal({
                        title   : 'Menunggu',
                        html    : 'Memproses Data',
                        onOpen  : () => {
                            swal.showLoading()
                        }
                    })
                },
                data        : {nama:nama, tanggal:tanggal, n_kontrak:nilai_kontrak, alamat:alamat, lat:lat, long:long},
                dataType    : "JSON",
                success     : function (data) {
                    data_mesin.ajax.reload(null, false);
                    swal({
                        type    : 'success',
                        title   : 'Tambah Mesin',
                        text    : 'Anda berhasil menambah mesin'
                    })

                    $.toast().reset('all');
		            $("body").removeAttr('class');
                    $.toast({
                        text: '<i class="jq-toast-icon zmdi zmdi-notifications-active"></i><p class="mt-5">Data Berhasil Disimpan.</p>',
                        position: 'top-left',
                        loaderBg:'#7a5449',
                        class: 'jq-has-icon jq-toast-success',
                        hideAfter: 5000, 
                        stack: 6,
                        showHideTransition: 'fade'
                    });

                    $('#tambah_mesin').modal('hide');
                    $('#pesan').show().fadeOut(7000);

                    $('#nama').val('');
                    $('#tanggal').val('');
                    $('#nilai_kontrak').val('');
                    $('#alamat').val('');
                    $('#lat').val('');
                    $('#long').val('');
                }

            });

            return false;
        })

        // proses ubah data mesin
        $('#tabel_mesin_atm').on('click', '.ubah-mesin', function () {
            var id_mesin = $(this).data('id');

            $.ajax({
                type    : "post",
                url     : "<?= base_url('Master/form_edit_mesin') ?>",
                beforeSend  : function () {
                    swal({
                        title   : 'Menunggu',
                        html    : 'Memproses data',
                        onOpen  : () => {
                            swal.showLoading()
                        }
                    })
                },
                data    : {id:id_mesin},
                success : function (data) {
                    swal.close();
                    $('#edit_mesin').modal('show');
                    $('#form_data_mesin').html(data);

                    // proses mengubah data
                    $('#form_ubah_mesin').on('submit', function () {
                        var nama        = $('.nama').val();
                        var tanggal     = $('.tanggal').val();
                        var nilai_k     = $('.nilai_kontrak').val();
                        var alamat      = $('.alamat').val();
                        var id_mesin    = $('.id_mesin').val();
                        var lat         = $('.lat').val();
                        var long        = $('.long').val();
                        
                        $.ajax({
                            type    : "post",
                            url     : "<?= base_url('Master/ubah_mesin') ?>",
                            beforeSend  : function () {
                                swal({
                                    title   : 'Menunggu',
                                    html    : 'Memproses data',
                                    onOpen  : () => {
                                        swal.showLoading()
                                    }
                                })
                            },
                            data    : {nama:nama, tanggal:tanggal, nilai_k:nilai_k, alamat:alamat, id_mesin:id_mesin, lat:lat, long:long},
                            success : function (data) {
                                data_mesin.ajax.reload(null, false);
                                swal({
                                    type    : 'success',
                                    title   : 'Ubah Mesin',
                                    text    : 'Anda berhasil ubah data mesin'
                                })

                                $.toast().reset('all');
		                        $("body").removeAttr('class');
                                
                                $.toast({
                                    text: '<i class="jq-toast-icon zmdi zmdi-notifications-active"></i><p class="mt-5">Data Berhasil Diubah.</p>',
                                    position: 'top-right',
                                    loaderBg:'#7a5449',
                                    class: 'jq-has-icon jq-toast-info',
                                    hideAfter: 5000, 
                                    stack: 6,
                                    showHideTransition: 'fade'
                                })

                                $('#edit_mesin').modal('hide');

                            }
                        })

                        return false;
                    })
                }
            })
        })

        // proses hapus data
        $('#tabel_mesin_atm').on('click','.hapus-mesin', function () {
            var id_mesin = $(this).data('id');

            swal({
                title               : 'Konfirmasi',
                text                : "Anda ingin menghapus",
                type                : 'warning',
                showCancelButton    : true,
                confirmButtonText   : 'Hapus',
                confirmButtonColor  : '#d33',
                cancelButtonText    : 'Tidak',
                cancelButtonColor   : '#3085d6',
                reverseButtons      : true
            }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type        : "post",
                            url         : "<?= base_url('Master/hapus_mesin') ?>",
                            beforeSend  : function () {
                                swal({
                                    title   : 'Menunggu',
                                    html    : 'Memproses data',
                                    onOpen  : () => {
                                        swal.showLoading()
                                    }
                                })
                            },
                            data        : {id:id_mesin},
                            success     : function (data) {
                                swal(
                                    'Hapus',
                                    'Berhasil Terhapus',
                                    'success'
                                )
                                data_mesin.ajax.reload(null, false);

                                $.toast().reset('all');
		                        $("body").removeAttr('class');

                                $.toast({
                                    text        : '<i class="jq-toast-icon zmdi zmdi-notifications-active"></i><p class="mt-5">Data Berhasil Dihapus.</p>',
                                    position    : 'bottom-right',
                                    loaderBg    : '#7a5449',
                                    class       : 'jq-has-icon jq-toast-danger',
                                    hideAfter   : 5000, 
                                    stack       : 6,
                                    showHideTransition  : 'fade'
                                })
                            }
                        })
                    } else if (result.dismiss === swal.DismissReason.cancel) {
                        swal(
                            'Batal',
                            'Anda Membatalkan Penghapusan',
                            'error'
                        )
                    }
                })
        })


    });

    

</script>

