<?= $this->extend('index') ?>
<?= $this->section('content') ?>

<form action="<?= base_url('produk/store') ?>" method="post">
    <?= csrf_field() ?> <!-- Tambahkan CSRF token untuk keamanan -->

    <div class="form-group">
        <label for="nama_produk">Nama Produk</label>
        <input type="text" name="nama_produk" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="id_kategori">ID Kategori</label>
        <select name="id_kategori" class="form-control" required>
            <option value="">Pilih Kategori</option> <!-- Tambahkan opsi untuk memilih kategori -->
            <?php foreach ($kategori as $item): ?>
                <option value="<?= esc($item['id_kategori']) ?>"><?= esc($item['nama_kategori']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="harga">Harga</label>
        <input type="number" name="harga" class="form-control" required>
    </div>

    <!-- <div class="form-group">
        <label for="stok_tersedia">Stok</label>
        <input type="number" name="stok_tersedia" class="form-control" required>
    </div> -->

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="<?= base_url('produk') ?>" class="btn btn-secondary">Kembali</a>
</form>

<?= $this->endSection() ?>