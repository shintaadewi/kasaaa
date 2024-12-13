<?= $this->extend('index') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <h2>Daftar Stok Produk</h2>

    <!-- Form Pencarian -->
    <form class="mb-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari produk..." id="searchInput" onkeyup="searchTable()">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" onclick="searchTable()">Cari</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered table-striped" id="stokTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Stok Masuk</th>
                <th>Stok Keluar</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stok as $i => $item): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= $item['nama_produk']; ?></td>
                    <td><?= $item['stok_masuk']; ?></td>
                    <td><?= $item['stok_keluar']; ?></td>
                    <td><?= $item['tanggal']; ?></td>
                    <td>
                        <a href="<?= base_url('stok/edit/' . $item['id_stok']); ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="<?= base_url('stok/delete/' . $item['id_stok']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus stok ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    function searchTable() {
        let input = document.getElementById("searchInput");
        let filter = input.value.toLowerCase();
        let table = document.getElementById("stokTable");
        let tr = table.getElementsByTagName("tr");

        // Loop through all table rows, except the first (header)
        for (let i = 1; i < tr.length; i++) {
            let td = tr[i].getElementsByTagName("td");
            let found = false;
            // Loop through all cells in the row
            for (let j = 0; j < td.length - 1; j++) { // Exclude the last column (Actions)
                if (td[j]) {
                    let txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toLowerCase().indexOf(filter) > -1) {
                        found = true;
                    }
                }
            }
            // Show or hide the row based on the search filter
            tr[i].style.display = found ? "" : "none";
        }
    }
</script>

<?= $this->endSection() ?>