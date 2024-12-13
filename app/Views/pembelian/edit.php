<?= $this->extend('index') ?>
<?= $this->section('content') ?>
<div class="container mt-5">
    <h2>Edit Pembelian</h2>
    <form action="<?= base_url('pembelian/update/' . $pembelian['id_pembelian']); ?>" method="POST">
        <?= csrf_field(); ?>
        <div class="form-group">
            <label for="id_pemasok">Pemasok</label>
            <select name="id_pemasok" id="id_pemasok" class="form-control" required>
                <option value="">Pilih Pemasok</option>
                <?php foreach ($pemasok as $p): ?>
                    <option value="<?= $p['id_pemasok']; ?>" <?= $p['id_pemasok'] == $pembelian['id_pemasok'] ? 'selected' : ''; ?>><?= $p['nama_pemasok']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="tanggal_pembelian">Tanggal Pembelian</label>
            <input type="date" name="tanggal_pembelian" id="tanggal_pembelian" class="form-control" value="<?= $pembelian['tanggal_pembelian']; ?>" required>
        </div>
        <div class="form-group">
            <label for="detail_pembelian">Detail Pembelian (Produk dan Kuantitas)</label>
            <div id="detail-pembelian">
                <?php foreach ($detailPembelian as $index => $detail): ?>
                    <div class="input-group mb-2">
                        <select name="detail_pembelian[<?= $index; ?>][id_produk]" class="form-control" required>
                            <option value="">Pilih Produk</option>
                            <?php foreach ($produk as $p): ?>
                                <option value="<?= $p['id_produk']; ?>" <?= $p['id_produk'] == $detail['id_produk'] ? 'selected' : ''; ?>><?= $p['nama_produk']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <input type="number" name="detail_pembelian[<?= $index; ?>][kuantitas]" class="form-control" value="<?= $detail['kuantitas']; ?>" placeholder="Kuantitas" required>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="button" class="btn btn-secondary" id="add-detail">Tambah Detail</button>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Pembelian</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script>
    $(document).ready(function() {
        let index = <?= count($detailPembelian); ?>; // Hitung jumlah detail yang ada
        $('#add-detail').click(function() {
            $('#detail-pembelian').append(`
                <div class="input-group mb-2">
                    <select name="detail_pembelian[${index}][id_produk]" class="form-control" required>
                        <option value="">Pilih Produk</option>
                        <?php foreach ($produk as $p): ?>
                            <option value="<?= $p['id_produk']; ?>"><?= $p['nama_produk']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="number" name="detail_pembelian[${index}][kuantitas]" class="form-control" placeholder="Kuantitas" required>
                </div>
            `);
            index++;
        });
    });
</script>
<?= $this->endSection(); ?>