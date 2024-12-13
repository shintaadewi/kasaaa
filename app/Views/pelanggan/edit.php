<?= $this->extend('index') ?>
<?= $this->section('content') ?>

<h1>Edit Pelanggan</h1>

<form action="<?= base_url('pelanggan/update/' . $pelanggan['id_pelanggan']) ?>" method="post">
    <?= csrf_field() ?>
    <div class="mb-3">
        <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
        <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?= esc($pelanggan['nama_pelanggan']) ?>" required>
    </div>
    <div class="mb-3">
        <label for="kontak" class="form-label">Kontak</label>
        <input type="text" class="form-control" id="kontak" name="kontak" value="<?= esc($pelanggan['kontak']) ?>" required>
    </div>
    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea class="form-control" id="alamat" name="alamat" required><?= esc($pelanggan['alamat']) ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?= $this->endSection() ?>