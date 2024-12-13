<?= $this->extend('index') ?>
<?= $this->section('content') ?>

<form action="<?= base_url('stok/store') ?>" method="post">
    <div class="form-group">
        <label for="id_produk">ID Produk</label>
        <select name="id_produk" class="form-control" required>
            <?php foreach ($produk as $item): ?>
                <option value="<?= $item['id_produk'] ?>"><?= $item['nama_produk'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="stok_masuk">Stok Masuk</label>
        <input type="number" name="stok_masuk" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="stok_keluar">Stok Keluar</label>
        <input type="number" name="stok_keluar" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="tanggal">Tanggal</label>
        <input type="date" name="tanggal" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="<?= base_url('stok') ?>" class="btn btn-secondary">Kembali</a>
</form>

<?= $this->endSection() ?>