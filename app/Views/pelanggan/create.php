<?= $this->extend('index') ?>
<?= $this->section('content') ?>

<h1>Tambah Pelanggan</h1>

<form action="<?= base_url('pelanggan/store') ?>" method="post">
    <?= csrf_field() ?>
    <div class="mb-3">
        <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
        <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
    </div>
    <div class="mb-3">
        <label for="kontak" class="form-label">Kontak</label>
        <input type="text" class="form-control" id="kontak" name="kontak" required>
    </div>
    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea class="form-control" id="alamat" name="alamat" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

<?= $this->endSection() ?>