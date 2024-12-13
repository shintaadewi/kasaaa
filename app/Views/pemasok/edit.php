<?= $this->extend('index') ?>
<?= $this->section('content') ?>

<form action="<?= base_url('pemasok/update/' . $pemasok['id_pemasok']) ?>" method="post">
    <div class="form-group">
        <label for="nama_pemasok">Nama Pemasok</label>
        <input type="text" name="nama_pemasok" class="form-control" value="<?= $pemasok['nama_pemasok'] ?>" required>
    </div>
    <div class="form-group">
        <label for="kontak">Kontak</label>
        <input type="text" name="kontak" class="form-control" value="<?= $pemasok['kontak'] ?>" required>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="<?= base_url('pemasok') ?>" class="btn btn-secondary">Kembali</a>
</form>

<?= $this->endSection() ?>