<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item">Tasklist</li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $bagian['bagian'] ?></li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<!-- Container -->
<div class="container"> 

    <!-- Title -->
    <div class="hk-pg-header mb-50">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="users"></i></span></span>Tasklist <?php echo $bagian['bagian'] ?></h4>
    </div>
    <!-- /Title -->

    <section class="hk-sec-wrapper table-responsive">
        <table id="mon" class="table table-hover">
            <tr>
                <th>Judul Tasklist</th>
                <td>:</td>
                <td><?= $data_hsl_mon['tasklist'] ?></td>
                <td><?php if($data_hsl_mon['penerima_tugas'] == $this->session->userdata('id_karyawan')){ ?> 
                <td style="text-align: right" ><img class="brand-img" src="<?= base_url() ?>assets/bg_your_task_listt.png" width="100" alt="brand"/></td><?php } ?></td>
            </tr>
            <tr>
                <th>Expire Date</th>
                <td>:</td>
                <td><?= tgl_indo($data_hsl_mon['expire_date']) ?></td>
                <td></td>
            </tr>
            <tr>
                <th>Pemberi Tugas</th>
                <td>:</td>
                <td><?= $data_hsl_mon['pemberi'] ?></td>
                <td></td>
            </tr>
            <tr>
                <th>Penerima Tugas</th>
                <td>:</td>
                <td><?= $data_hsl_mon['penerima'] ?></td>
                <td></td>
            </tr>
            <tr>
                <th>Keterangan</th>
                <td>:</td>
                <td><?= $data_hsl_mon['keterangan'] ?></td>
                <td></td>
            </tr>
        </table>
        <br/>
        <?php if($data_hsl_mon['penerima_tugas'] == $this->session->userdata('id_karyawan')){ ?><button class="btn btn-primary btn-wth-icon btn-rounded icon-right mr-10" type="button" data-toggle="modal" data-target="#input_hasil"><span class="btn-text">Input Hasil</span> <span class="icon-label"><span class="feather-icon"><i data-feather="plus"></i></span> </span></button><?php } ?>
        <br/>
        <br/>
        <table id="tabel_mon_pegawai" class="table table-bordered table-hover w-100 display pb-30">
                <thead class="thead-info">
                    <?php if($data_hsl_mon['penerima_tugas'] == $this->session->userdata('id_karyawan')){?>
                    <tr>
                        <th>No</th>
                        <th>Tugas</th>
                        <th width=20%;>Aksi</th>
                    </tr>
                    <?php } else {?>
                    <tr>
                        <th>No</th>
                        <th>Tugas</th>
                    </tr>
                    <?php } ?>
                </thead>
            <tbody>
                <?php $no = 1; foreach($data_hsl_task as $row){?>
                    <tr>
                    <?php if($data_hsl_mon['penerima_tugas'] == $this->session->userdata('id_karyawan')){?>
                        <td><?= $no; ?></td>
                        <td><?= $row['keterangan']; ?></td>
                        <td width="250">
                            <a href="<?php echo site_url('data/setujuiHasil/'.$row["id_hasil_task"]) ?>"
                                class="btn btn-info" title="SETUJUI"><i class="fa fa-check"></i></a>
                            <a onclick="<?php echo site_url('data/tolakHasil/'.$row["id_hasil_task"]) ?>"
                                href="#!" class="btn btn-danger" title="TOLAK"><i class="fa fa-close"></i></a>
                        </td>
                    <?php } else {?>
                        <td><?= $no; ?></td>
                        <td><?= $row['keterangan']; ?></td>
                    <?php } ?>
                    </tr>
                <?php $no++; } ?>
            </tbody>
        </table>
    </section>
</div>
<!-- Modal tambah data tasklist-->
<div id="input_hasil" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="input_hasil" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-info">
                <h5 class="modal-title text-white" id="my-modal-title"><i class="fa fa-plus-circle"></i><?= nbs(2) ?>Input Hasil Task</h5>
                <button class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="submit">
                <div class="form-group">
                    <label for="nama">Pemberi Tugas</label>
                    <input type="text" id="pemberi_tugas" value="<?= $data_hsl_mon['pemberi'] ?>" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="nama">Penerima Tugas</label>
                    <input type="text" value="<?= $data_hsl_mon['penerima'] ?>" class="form-control">
                </div>

                <div class="form-group">
                    <label for="alamat">Keterangan Hasil</label>
                    <textarea name="keterangan" id="keterangan" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label for="no_telp">Foto Bukti</label>
                    <input class="form-control" id="file" name="file" placeholder="Foto Bukti" type="file" required>
                </div>
                <input type="hidden" name="id_tasklist" id="id_tasklist" value="<?= $data_hsl_mon['id_tasklist']?>"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-wth-icon btn-rounded icon-right"  data-dismiss="modal"><span class="btn-text">Tutup</span> <span class="icon-label"><span class="fa fa-close"></span> </span></button>
                <button id="btn_upload" type="submit" class="btn btn-success btn-wth-icon btn-rounded icon-right"><span class="btn-text">Simpan</span> <span class="icon-label"><span class="fa fa-check"></span> </span></button>
            </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.2.1.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
<script type="text/javascript">
	$(document).ready(function(){

		$('#submit').submit(function(e){
		    e.preventDefault(); 
		         $.ajax({
		             url:'<?php echo base_url();?>index.php/data/simpan_hasil',
		             type:"post",
		             data:new FormData(this), //this is formData
		             processData:false,
		             contentType:false,
		             cache:false,
		             async:false,
		              success: function(data){
                        swal({
                            type    : 'success',
                            title   : 'Input Hasil',
                            text    : 'Anda Berhasil Menambah Hasil Tasklist'
                        });

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
                        // bersihkan form pada modal
                        $('#input_hasil').modal('hide');
                        // tutup modal
                        $('#file').val('');
                        $('#keterangan').val('');
                        window.location.reload();
		           }
		         });
		});
		

	});
	
</script>

<!-- <script type="text/javascript">
$(document).ready(function(){

    $('#submit').submit(function(e){
        e.preventDefault(); 
            $.ajax({
                url:'<?php echo base_url();?>index.php/data/simpan_hasil',
                type:"post",
                data:new FormData(this), //this is formData
                processData:false,
                contentType:false,
                cache:false,
                async:false,
                success: function(data){
                    swal({
                            type    : 'success',
                            title   : 'Input Hasil',
                            text    : 'Anda Berhasil Menambah Hasil Tasklist'
                        });

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
                    // bersihkan form pada modal
                    $('#input_hasil').modal('hide');
                    // tutup modal
                    $('#id_tasklist').val('');
                    $('#file').val('');
                    $('#keterangan').val('');
                    //window.location.reload();
            }
            });
    });


    });
</script> -->

<script type="text/javascript">
	$('.gambar').viewer();
</script>
