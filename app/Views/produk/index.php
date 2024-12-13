<?= $this->extend('index') ?>
<?= $this->section('content') ?>

<a href="<?= base_url('produk/create') ?>" class="btn btn-primary mb-3">Tambah Produk</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Nama Kategori</th>
            <th>Harga</th>
            <!-- <th>Stok</th> -->
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($produk as $i => $item): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= esc($item['nama_produk']) ?></td>
                <td><?= esc($item['nama_kategori']) ?></td> <!-- Menampilkan Nama Kategori -->
                <td><?= esc($item['harga']) ?></td>
                <!-- <td><?= esc($item['stok_tersedia']) ?></td>  -->
                <td>
                    <a href="<?= base_url('produk/edit/' . $item['id_produk']) ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="<?= base_url('produk/delete/' . $item['id_produk']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>