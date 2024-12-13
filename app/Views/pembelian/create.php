<?= $this->extend('index') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <h2>Tambah Pembelian</h2>
    <form action="<?= base_url('pembelian/store'); ?>" method="POST">
        <?= csrf_field(); ?>
        <div class="form-group">
            <label for="id_pemasok">Pemasok</label>
            <select name="id_pemasok" id="id_pemasok" class="form-control" required>
                <option value="">Pilih Pemasok</option>
                <?php foreach ($pemasok as $p): ?>
                    <option value="<?= $p['id_pemasok']; ?>"><?= $p['nama_pemasok']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="tanggal_pembelian">Tanggal Pembelian</label>
            <input type="date" name="tanggal_pembelian" id="tanggal_pembelian" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="detail_pembelian">Detail Pembelian (Produk dan Kuantitas)</label>
            <div id="detail-pembelian">
                <div class="input-group mb-2">
                    <select name="detail_pembelian[0][id_produk]" class="form-control" required>
                        <option value="">Pilih Produk</option>
                        <?php foreach ($produk as $p): ?>
                            <option value="<?= $p['id_produk']; ?>"><?= $p['nama_produk']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="number" name="detail_pembelian[0][kuantitas]" class="form-control" placeholder="Kuantitas" required>
                </div>
            </div>
            <button type="button" class="btn btn-secondary" id="add-detail">Tambah Detail</button>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Pembelian</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script>
    $(document).ready(function() {
        let index = 1;
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

<?= $this->endSection() ?>