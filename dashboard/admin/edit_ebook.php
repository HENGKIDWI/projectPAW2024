<?php
// edit.php
include '../../koneksi.php';
include 'ebook_proses.php';
include 'kategori.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $deskripsi = $_POST['deskripsi'];
    $kategori_id = $_POST['kategori_id'];

    // Hapus data e-book yang ada dari database
    $sql = "DELETE FROM ebooks WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Upload file baru
    $folder_tujuan = '../../uploads/ebook/assets/books/';
    $target_file = $folder_tujuan . basename($_FILES["file_path"]["name"]);

    // Cek apakah file berhasil diunggah
    if (move_uploaded_file($_FILES["file_path"]["tmp_name"], $target_file)) {
        // Tambahkan e-book baru ke database
        addEbook($conn, $judul, $penulis, $deskripsi, $target_file, $kategori_id);
        header("Location: ebook.php");
        exit();
    } else {
        echo "Maaf, terjadi kesalahan saat mengunggah file.";
    }
}

// Ambil data e-book untuk ditampilkan di form
$id = $_GET['id'];
$sql = "SELECT * FROM ebooks WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$ebook = $result->fetch_assoc();
$kategoris = getKategoris($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit E-Book</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Edit E-Book</h1>
        <form action="edit_ebook.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($ebook['id']); ?>">
            <div class="form-group">
                <input type="text" name="judul" class="form-control" placeholder="Judul" value="<?php echo htmlspecialchars($ebook['judul']); ?>" required>
            </div>
            <div class="form-group">
                <input type="text" name="penulis" class="form-control" placeholder="Penulis" value="<?php echo htmlspecialchars($ebook['penulis']); ?>" required>
            </div>
            <div class="form-group">
                <textarea name="deskripsi" class="form-control" placeholder="Deskripsi" required><?php echo htmlspecialchars($ebook['deskripsi']); ?></textarea>
            </div>
            <div class="form-group">
                <select name="kategori_id" class="form-control" required>
                    <option value="">Pilih Kategori</option>
                    <?php foreach ($kategoris as $kategori): ?>
                        <option value="<?php echo htmlspecialchars($kategori['id']); ?>" <?php echo $kategori['id'] == $ebook['kategori_id'] ? 'selected' : ''; ?>><?php echo htmlspecialchars($kategori['nama_kategori']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <input type="file" name="file_path" class="form-control" required>
                <small class="form-text text-muted">File baru harus diunggah.</small>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>