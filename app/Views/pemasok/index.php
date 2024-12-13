<?= $this->extend('index') ?>
<?= $this->section('content') ?>

<a href="<?= base_url('pemasok/create') ?>" class="btn btn-primary mb-3">Tambah Pemasok</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pemasok</th>
            <th>Kontak</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pemasok as $i => $item): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= $item['nama_pemasok'] ?></td>
                <td><?= $item['kontak'] ?></td>
                <td>
                    <a href="<?= base_url('pemasok/edit/' . $item['id_pemasok']) ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="<?= base_url('pemasok/delete/' . $item['id_pemasok']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>