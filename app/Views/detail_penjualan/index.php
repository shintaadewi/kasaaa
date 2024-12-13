<?= $this->extend('index') ?>
<?= $this->section('content') ?>

<a href="<?= base_url('detail_penjualan/create') ?>" class="btn btn-primary mb-3">Tambah Detail Penjualan</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>ID Penjualan</th>
            <th>ID Produk</th>
            <th>Jumlah</th>
            <th>Harga Satuan</th>
            <th>Total Harga</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($detail_penjualan as $item): ?>
            <tr>
                <td><?= $item['id_detail_penjualan'] ?></td>
                <td><?= $item['id_penjualan'] ?></td>
                <td><?= $item['id_produk'] ?></td>
                <td><?= $item['jumlah'] ?></td>
                <td><?= $item['harga_satuan'] ?></td>
                <td><?= $item['total_harga'] ?></td>
                <td>
                    <a href="<?= base_url('detail_penjualan/edit/' . $item['id_detail_penjualan']) ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="<?= base_url('detail_penjualan/delete/' . $item['id_detail_penjualan']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>