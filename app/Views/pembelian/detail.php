<?= $this->extend('index') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <h1 class="mb-4">Detail Pembelian</h1>

    <div class="card mb-4">
        <div class="card-header">
            <h3>ID Pembelian: <?= $pembelian['id_pembelian'] ?></h3>
        </div>
        <div class="card-body">
            <p><strong>Pemasok:</strong> <?= isset($pemasok['nama_pemasok']) ? $pemasok['nama_pemasok'] : 'Pemasok tidak ditemukan' ?></p>
            <p><strong>Total Harga:</strong> <?= number_format($pembelian['total_harga'], 2, ',', '.') ?> IDR</p>
            <p><strong>Tanggal Pembelian:</strong> <?= date('d-m-Y H:i:s', strtotime($pembelian['tanggal_pembelian'])) ?></p>
        </div>
    </div>

    <h2>Detail Produk yang Dibeli</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID Produk</th>
                    <th>Nama Produk</th>
                    <th>Kuantitas</th>
                    <th>Harga Satuan (IDR)</th>
                    <th>Subtotal (IDR)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($detail_pembelian)): ?>
                    <?php foreach ($detail_pembelian as $item): ?>
                        <tr>
                            <td><?= $item['id_produk'] ?></td>
                            <td><?= isset($produkArray[$item['id_produk']]) ? $produkArray[$item['id_produk']]['nama_produk'] : 'Produk tidak ditemukan' ?></td>
                            <td><?= $item['kuantitas'] ?></td>
                            <td><?= number_format($produkArray[$item['id_produk']]['harga'], 2, ',', '.') ?></td>
                            <td><?= number_format($item['kuantitas'] * $produkArray[$item['id_produk']]['harga'], 2, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada detail produk untuk pembelian ini.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <a href="<?= base_url('/pembelian/edit/' . $pembelian['id_pembelian']) ?>" class="btn btn-warning">Edit Pembelian</a>
        <a href="<?= base_url('/pembelian') ?>" class="btn btn-primary">Kembali</a>
    </div>
</div>

<?= $this->endSection() ?>
