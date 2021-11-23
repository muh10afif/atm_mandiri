<div class="card bg-light mb-30" id="edit_pengguna">
    <div class="card-header" style="color: black">Ubah Pengguna</div>
    <form id="form_ubah_pengguna">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <input type="hidden" class="id_pengguna" value="<?= $d_pengguna['id_pengguna'] ?>" >
                    <label class="col-sm-4 col-form-label">Karyawan</label>
                    <div class="col-sm-8">
                        <select class="form-control select3 karyawan" disabled>
                            <option value=""><?= $d_pengguna['nama_karyawan']; ?></option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Level</label>
                    <div class="col-sm-8">
                        <select class="form-control select3 level">
                            <?php $a = $d_pengguna['level']; ?>
                            <option value=" ">-- Pilih Level --</option>
                            <option value="1" <?= ($a==1) ? 'selected' : '' ?>>Admin</option>
                            <option value="2" <?= ($a==2) ? 'selected' : '' ?>>Head</option>
                            <option value="3" <?= ($a==3) ? 'selected' : '' ?>>Manager</option>
                            <option value="4" <?= ($a==4) ? 'selected' : '' ?>>Officer</option>
                            <option value="5" <?= ($a==5) ? 'selected' : '' ?>>Team</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Bagian</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?= $d_pengguna['bagian']?>" readonly>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Username</label>
                    <div class="col-sm-8">
                        <input type="text" name="username" id="username" class="form-control username" value="<?= $d_pengguna['username'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Password</label>
                    <div class="col-sm-8">
                        <input type="password" name="password" id="password" class="form-control password" value="<?= $d_pengguna['password'] ?>" >
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck1" onclick="myFunction()">
                            <label class="custom-control-label" for="customCheck1">Show Password</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="col-md-12 col-md-offset-6" align="right">

        <button type="button" class="btn btn-light btn-wth-icon btn-rounded icon-right" value="<?= count($d_karyawan) ?>" id="cancel"><span class="btn-text">Cancel</span> <span class="icon-label"><span class="fa fa-close"></span> </span></button>
        <button type="submit" class="btn btn-success btn-wth-icon btn-rounded icon-right"><span class="btn-text">Ubah Data Pengguna</span> <span class="icon-label"><span class="fa fa-pencil"></span> </span></button>

        </div>
    </div>
    </form>
</div>

<script>
    $(".select3").select2();
</script>