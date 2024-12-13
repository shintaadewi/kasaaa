<?= $this->extend('index') ?>
<?= $this->section('content') ?>

<a href="<?= base_url('pelanggan/create') ?>" class="btn btn-primary mb-3">Tambah Pelanggan</a>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kontak</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pelanggan as $i => $item): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= esc($item['nama_pelanggan']) ?></td>
                <td><?= esc($item['kontak']) ?></td>
                <td>
                    <a href="<?= base_url('pelanggan/edit/' . $item['id_pelanggan']) ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="<?= base_url('pelanggan/delete/' . $item['id_pelanggan']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>