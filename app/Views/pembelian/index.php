<?= $this->extend('index') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <h2>Daftar Pembelian</h2>
    <a href="<?= base_url('pembelian/create'); ?>" class="btn btn-primary mb-3">Tambah Pembelian</a>
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Pemasok</th>
                <th>Tanggal Pembelian</th>
                <th>Total Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pembelian as $i => $item): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= $item['nama_pemasok'] ?></td>
                    <td><?= $item['tanggal_pembelian'] ?></td>
                    <td><?= number_format($item['total_harga'], 2) ?></td>
                    <td>
                        <a href="<?= base_url('pembelian/edit/' . $item['id_pembelian']); ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form action="<?= base_url('pembelian/delete/' . $item['id_pembelian']); ?>" method="POST" style="display:inline;">
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                        </form>
                        <a href="<?= base_url('pembelian/detail/' . $item['id_pembelian']); ?>" class="btn btn-info btn-sm">Detail</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

<?= $this->endSection(); ?>