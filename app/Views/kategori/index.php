<?= $this->extend('index') ?>
<?= $this->section('content') ?>

<a href="<?= base_url('kategori/create') ?>" class="btn btn-primary mb-3">Tambah Kategori</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($kategori as $i => $item): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= $item['nama_kategori'] ?></td>
                <td>
                    <a href="<?= base_url('kategori/edit/' . $item['id_kategori']) ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="<?= base_url('kategori/delete/' . $item['id_kategori']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>