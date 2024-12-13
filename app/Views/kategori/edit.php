<?= $this->extend('index') ?>
<?= $this->section('content') ?>

<form action="<?= base_url('kategori/update/' . $kategori['id_kategori']) ?>" method="post">
    <div class="form-group">
        <label for="nama_kategori">Nama Kategori</label>
        <input type="text" name="nama_kategori" class="form-control" value="<?= $kategori['nama_kategori'] ?>" required>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="<?= base_url('kategori') ?>" class="btn btn-secondary">Kembali</a>
</form>

<?= $this->endSection() ?>