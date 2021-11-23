<div class="card bg-light mb-30" id="edit_kelolaan">
    <div class="card-header" style="color: black">Ubah Kelolaan</div>
    <form id="form_ubah_kelolaan">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <input type="hidden" value="<?= $d_kelolaan['id_kelola_mesin'] ?>" class="id_kelola_mesin">
                        <label class="col-sm-4 col-form-label" align="">Nama Pegawai</label>
                        <div class="col-sm-8">
                            <input type="hidden" class="id_pegawai_lama" value="<?= $d_kelolaan['id_karyawan'] ?>">
                            <select class="form-control select3 id_pegawai">
                                <option value=" ">-- Pilih Karyawan --</option>
                                <?php $a = $d_kelolaan['id_karyawan'] ?>
                                <?php foreach ($d_karyawan as $k) : ?>
                                    <option value="<?= $b = $k['id_karyawan'] ?>" <?= ($a==$b) ? 'selected' : '' ?> ><?= $k['nama_karyawan'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" align="">Unit Mesin</label>
                        <div class="col-sm-8">
                            <input type="hidden" class="id_mesin_lama" value="<?= $d_kelolaan['id_mesin'] ?>">
                            <select class="form-control select3 id_mesin">
                                <option value=" ">-- Pilih Mesin --</option>
                                <?php $d = $d_kelolaan['id_mesin'] ?>
                                <?php foreach ($d_mesin as $m) : ?>
                                    <option value="<?= $e = $m['id_mesin'] ?>" <?= ($d==$e) ? 'selected' : '' ?> ><?= $m['nama_mesin'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
        <div class="col-md-12 col-md-offset-6" align="right">

            <button type="button" class="btn btn-light btn-wth-icon btn-rounded icon-right" value="<?= count($d_mesin) ?>" id="cancel"><span class="btn-text">Cancel</span> <span class="icon-label"><span class="fa fa-close"></span> </span></button>
            <button type="submit" class="btn btn-success btn-wth-icon btn-rounded icon-right"><span class="btn-text">Ubah Data Kelolaan</span> <span class="icon-label"><span class="fa fa-pencil"></span> </span></button>

        </div>
        </div>
    </form>
</div>

<script>
    $(".select3").select2();
</script>