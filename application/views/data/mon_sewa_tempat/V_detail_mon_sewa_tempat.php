<style>
    #mon tr {
        border-top: hidden;
    }
</style>

<div class="modal-body">
    <div class="col-md-12 table-responsive">
        <table id="mon" class="table table-hover">
            <tr>
                <th>Nama Mesin</th>
                <td>:</td>
                <td><?= $d_mesin['nama_mesin'] ?></td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>:</td>
                <td><?= $d_mesin['alamat'] ?></td>
            </tr>
            <tr>
                <th>Tanggal Jatuh Tempo</th>
                <td>:</td>
                <td><?= tgl_indo($d_mesin['tgl_jatuh_tempo']) ?></td>
            </tr>
            <tr>
                <th>Nilai Kontrak</th>
                <td>:</td>
                <td>Rp. <?= number_format($d_mesin['nilai_kontrak'],0,'.','.') ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td>:</td>
                <td><?php $s = $d_mesin['status'] ?>
                    <?php if ($s == 1): ?>
                        <i class="badge badge-success">Save</i> 
                    <?php elseif ($s == 2): ?>
                        <i class="badge badge-sun">Warning</i> 
                    <?php else: ?>
                        <i class="badge badge-red">Due Date</i> 
                    <?php endif; ?>
                </td>
            </tr>
        </table>
    </div>
</div>