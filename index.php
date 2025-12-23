<?php
include_once 'koneksi.php';

// --- Bagian 1: Logika Pencarian ---
$q = "";
$sql_where = "";
if (isset($_GET['submit']) && !empty($_GET['q'])) {
    $q = $_GET['q'];
    $sql_where = " WHERE nama LIKE '{$q}%'"; 
}

// --- Bagian 2: Logika Pagination ---
$sql_count = "SELECT COUNT(*) FROM data_barang" . $sql_where;
$result_count = mysqli_query($conn, $sql_count);
$r_data = mysqli_fetch_row($result_count);
$count = $r_data[0];

$per_page = 5; // Saya ubah jadi 5 supaya tidak terlalu sering ganti halaman
$num_page = ceil($count / $per_page);
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $per_page;

// --- Bagian 3: Query Utama ---
$sql = "SELECT * FROM data_barang" . $sql_where . " LIMIT {$offset}, {$per_page}";
$result = mysqli_query($conn, $sql);

$title = 'Daftar Barang';
include_once 'header.php'; 
?>

<div class="container">
    <h1>Membuat Databse Sederhana</h1>

    <div class="nav-blue">
        <a href="index.php">Home</a>
        <a href="login.php">Login</a>
    </div>

    <a href="tambah_barang.php" class="btn btn-tambah">Tambah Barang Baru</a>

    <form action="" method="get" style="margin-bottom: 20px;">
        <label>Cari Nama Barang: </label>
        <input type="text" name="q" class="input-q" value="<?php echo $q ?>" placeholder="Ketik nama...">
        <input type="submit" name="submit" value="Cari" class="btn btn-cari">
    </form>

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f8bbd0; color: white;">
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Harga Jual</th>
                <th>Harga Beli</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if($result && mysqli_num_rows($result) > 0): ?>
                <?php while($row = mysqli_fetch_array($result)): ?>
                <tr>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $row['kategori']; ?></td>
                    <td>Rp <?php echo number_format($row['harga_jual'], 0, ',', '.'); ?></td>
                    <td>Rp <?php echo number_format($row['harga_beli'], 0, ',', '.'); ?></td>
                    <td style="text-align: center;"><?php echo $row['stok']; ?></td>
                    <td style="text-align: center;">
                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-edit">Edit</a>
                        <a href="hapus.php?id=<?php echo $row['id']; ?>" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus barang ini?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align: center; padding: 20px;">Data tidak ditemukan atau masih kosong.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <ul class="pagination" style="margin-top: 20px; list-style: none; display: flex;">
        <?php if($page > 1): ?>
            <li><a href="?page=<?php echo $page-1; ?>&q=<?php echo $q; ?>&submit=Cari" style="padding: 8px; text-decoration: none; border: 1px solid #ccc; margin-right: 5px;">&laquo; Prev</a></li>
        <?php endif; ?>

        <?php for ($i=1; $i <= $num_page; $i++): 
            $link = "?page={$i}";
            if (!empty($q)) $link .= "&q={$q}&submit=Cari";
            $active = ($page == $i) ? "background-color: #f8bbd0; color: white;" : "";
        ?>
            <li><a href="<?php echo $link; ?>" style="padding: 8px; text-decoration: none; border: 1px solid #ccc; margin-right: 5px; <?php echo $active; ?>"><?php echo $i; ?></a></li>
        <?php endfor; ?>

        <?php if($page < $num_page): ?>
            <li><a href="?page=<?php echo $page+1; ?>&q=<?php echo $q; ?>&submit=Cari" style="padding: 8px; text-decoration: none; border: 1px solid #ccc;">Next &raquo;</a></li>
        <?php endif; ?>
    </ul>

    <footer style="margin-top: 30px; border-top: 1px solid #ccc; padding-top: 10px;">
        &copy; 2025 - UNIVERSITAS PELITA BANGSA
    </footer>
</div>

<?php include_once 'footer.php'; ?>