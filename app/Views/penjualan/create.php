<?= $this->extend('index') ?>
<?= $this->section('content') ?>

<div class="container">
    <h2>Tambah Penjualan</h2>
    <form action="<?= base_url('/penjualan/store') ?>" method="post">
        <div class="form-group">
            <label for="id_pelanggan">Pelanggan</label>
            <select name="id_pelanggan" id="id_pelanggan" class="form-control" required>
                <option value="">Pilih Pelanggan</option>
                <?php foreach ($pelanggan as $p): ?>
                    <option value="<?= $p['id_pelanggan'] ?>"><?= $p['nama_pelanggan'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="produk">Produk</label>
            <div id="produk-container">
                <div class="row mb-2">
                    <div class="col">
                        <select name="produk[0][id]" class="form-control produk-select" required onchange="updateHarga(this)">
                            <option value="">Pilih Produk</option>
                            <?php foreach ($produk as $p): ?>
                                <option value="<?= $p['id_produk'] ?>" data-harga="<?= $p['harga'] ?>"><?= $p['nama_produk'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col">
                        <input type="number" name="produk[0][jumlah]" class="form-control" placeholder="Jumlah" required>
                    </div>
                    <div class="col">
                        <input type="text" name="produk[0][harga_satuan]" class="form-control harga-satuan" placeholder="Harga Satuan" readonly>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-secondary" id="tambah-produk">Tambah Produk</button>
        </div>

        <button type="submit" class="btn btn-success">Simpan Penjualan</button>
        <a href="<?= base_url('/penjualan') ?>" class="btn btn-danger">Batal</a>
    </form>
</div>

<script>
    function updateHarga(selectElement) {
        const hargaInput = selectElement.closest('.row').querySelector('input[name^="produk"][name$="[harga_satuan]"]');
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const harga = selectedOption.getAttribute('data-harga');
        hargaInput.value = harga; // Mengisi harga satuan sesuai produk yang dipilih
    }

    document.getElementById('tambah-produk').addEventListener('click', function() {
        const container = document.getElementById('produk-container');
        const index = container.children.length;

        const newRow = document.createElement('div');
        newRow.className = 'row mb-2';
        newRow.innerHTML = `
            <div class="col">
                <select name="produk[${index}][id]" class="form-control produk-select" required onchange="updateHarga(this)">
                    <option value="">Pilih Produk</option>
                    <?php foreach ($produk as $p): ?>
                        <option value="<?= $p['id_produk'] ?>" data-harga="<?= $p['harga'] ?>"><?= $p['nama_produk'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col">
                <input type="number" name="produk[${index}][jumlah]" class="form-control" placeholder="Jumlah" required>
            </div>
            <div class="col">
                <input type="text" name="produk[${index}][harga_satuan]" class="form-control harga-satuan" placeholder="Harga Satuan" readonly>
            </div>
        `;
        container.appendChild(newRow);
    });
</script>

<?= $this->endSection() ?>