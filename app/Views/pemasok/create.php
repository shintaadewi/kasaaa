<?= $this->extend('index') ?>
<?= $this->section('content') ?>

<form action="<?= base_url('pemasok/store') ?>" method="post">
    <div class="form-group">
        <label for="nama_pemasok">Nama Pemasok</label>
        <input type="text" name="nama_pemasok" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="kontak">Kontak</label>
        <input type="text" name="kontak" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="<?= base_url('pemasok') ?>" class="btn btn-secondary">Kembali</a>
</form>

<?= $this->endSection() ?>