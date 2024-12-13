<?= $this->extend('index') ?>
<?= $this->section('content') ?>

<form action="<?= base_url('detail_penjualan/store') ?>" method="post">
    <div class="form-group">
        <label for="id_penjualan">ID Penjualan</label>
        <select name="id_penjualan" class="form-control" required>
            <?php foreach ($penjualan as $item): ?>
                <option value="<?= $item['id_penjualan'] ?>"><?= $item['id_penjualan'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="id_produk">ID Produk</label>
        <select name="id_produk" class="form-control" required>
            <?php foreach ($produk as $item): ?>
                <option value="<?= $item['id_produk'] ?>"><?= $item['nama_produk'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="jumlah">Jumlah</label>
        <input type="number" name="jumlah" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="harga_satuan">Harga Satuan</label>
        <input type="number" name="harga_satuan" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="<?= base_url('detail_penjualan') ?>" class="btn btn-secondary">Kembali</a>
</form>

<?= $this->endSection() ?>