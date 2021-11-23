<div class="card bg-light mb-30" id="edit_reminder">
    <div class="card-header" style="color: black">Ubah Reminder</div>
    <form id="form_ubah_reminder">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <input type="hidden" class="id_reminder" value="<?= $d_reminder['id_reminder'] ?>">
                    <label class="col-sm-4 col-form-label" align="">Mesin</label>
                    <div class="col-sm-8">
                        <select class="form-control select3 id_mesin">
                                <option value=" ">-- Pilih Mesin --</option>
                            <?php foreach ($d_mesin as $m): ?>
                                <option value="<?= $a = $m['id_mesin'] ?>" <?= ($id_mesin == $a) ? 'selected' : ''?>><?= $m['nama_mesin'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label" align="">Jenis Reminder</label>
                    <div class="col-sm-8">
                        <select class="form-control select3 id_jenis_reminder">
                            <option value=" ">-- Pilih Jenis Reminder --</option>
                            <?php foreach ($d_jenis as $j) : ?>
                                <option value="<?= $b = $j['id_jenis_reminder'] ?>" <?= ($d_reminder['id_jenis_reminder'] == $b) ? 'selected' : ''?>>Level <?= $j['level'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="col-md-12 col-md-offset-6" align="right">

            <button type="button" class="btn btn-light btn-wth-icon btn-rounded icon-right" id="cancel"><span class="btn-text">Cancel</span> <span class="icon-label"><span class="fa fa-close"></span> </span></button>
            <button type="submit" class="btn btn-success btn-wth-icon btn-rounded icon-right"><span class="btn-text">Ubah Data Reminder</span> <span class="icon-label"><span class="fa fa-pencil"></span> </span></button>

        </div>
    </div>
    </form>
</div>

<script>
    $(".select3").select2();
</script>