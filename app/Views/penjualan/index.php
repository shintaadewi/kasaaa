<?= $this->extend('index') ?>
<?= $this->section('content') ?>

<div class="container">
    <h2>Daftar Penjualan</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <a href="<?= base_url('/penjualan/create') ?>" class="btn btn-primary mb-3">Tambah Penjualan</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal Penjualan</th>
                <th>Total Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($penjualan) && count($penjualan) > 0): ?>
                <?php foreach ($penjualan as $index => $p): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $p['nama_pelanggan'] ?></td>
                        <td><?= date('d-m-Y', strtotime($p['tanggal_penjualan'])) ?></td>
                        <td>Rp <?= number_format($p['total_harga'], 0, ',', '.') ?></td>
                        <td>
                            <a href="<?= base_url('/penjualan/detail/' . $p['id_penjualan']) ?>" class="btn btn-info btn-sm">Detail</a>
                            <!-- <a href="<?= base_url('/penjualan/edit/' . $p['id_penjualan']) ?>" class="btn btn-warning btn-sm">Edit</a> -->
                            <form action="<?= base_url('/penjualan/delete/' . $p['id_penjualan']) ?>" method="post" class="d-inline">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus penjualan ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data penjualan</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>