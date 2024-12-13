<?= $this->extend('index') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <h1 class="mb-4">Detail Penjualan</h1>

    <div class="card mb-4">
        <div class="card-header">
            <h3>ID Penjualan: <?= $penjualan['id_penjualan'] ?></h3>
        </div>
        <div class="card-body">
            <p><strong>Pelanggan:</strong> <?= isset($pelanggan['nama_pelanggan']) ? $pelanggan['nama_pelanggan'] : 'Pelanggan tidak ditemukan' ?></p>
            <p><strong>Total Harga:</strong> <?= number_format($penjualan['total_harga'], 2, ',', '.') ?> IDR</p>
            <p><strong>Tanggal Penjualan:</strong> <?= date('d-m-Y H:i:s', strtotime($penjualan['tanggal_penjualan'])) ?></p>
        </div>
    </div>

    

    <div class="d-flex justify-content-between mt-4">
        <a href="<?= base_url('/penjualan/edit/' . $penjualan['id_penjualan']) ?>" class="btn btn-warning">Edit Penjualan</a>
        <a href="<?= base_url('/penjualan') ?>" class="btn btn-primary">Kembali</a>
    </div>
</div>

<?= $this->endSection() ?>