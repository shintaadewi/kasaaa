<?= $this->extend('index') ?>
<?= $this->section('content') ?>

<form action="<?= base_url('kategori/store') ?>" method="post">
    <div class="form-group">
        <label for="nama_kategori">Nama Kategori</label>
        <input type="text" name="nama_kategori" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="<?= base_url('kategori') ?>" class="btn btn-secondary">Kembali</a>
</form>

<?= $this->endSection() ?>