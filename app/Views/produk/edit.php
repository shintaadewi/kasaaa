<?= $this->extend('index') ?>
<?= $this->section('content') ?>

<form action="<?= base_url('produk/update/' . $produk['id_produk']) ?>" method="post">
    <div class="form-group">
        <label for="nama_produk">Nama Produk</label>
        <input type="text" name="nama_produk" class="form-control" value="<?= $produk['nama_produk'] ?>" required>
    </div>
    <div class="form-group">
        <label for="id_kategori">ID Kategori</label>
        <select name="id_kategori" class="form-control" required>
            <?php foreach ($kategori as $item): ?>
                <option value="<?= $item['id_kategori'] ?>" <?= ($item['id_kategori'] == $produk['id_kategori']) ? 'selected' : '' ?>><?= $item['nama_kategori'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="harga">Harga</label>
        <input type="number" name="harga" class="form-control" value="<?= $produk['harga'] ?>" required>
    </div>
    <div class="form-group">
        <label for="stok">Stok</label>
        <input type="number" name="stok" class="form-control" value="<?= $produk['stok_tersedia'] ?>" required>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="<?= base_url('produk') ?>" class="btn btn-secondary">Kembali</a>
</form>

<?= $this->endSection() ?>