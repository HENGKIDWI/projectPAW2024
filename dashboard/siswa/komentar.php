<?php
include '../../koneksi.php';

session_start();

if (!isset($_SESSION['nama_lengkap'])) {
    header("Location: ../../login.php");
    exit;
}

$forum_id = $_GET['id'];

// Ambil forum berdasarkan ID
$query = "SELECT f.*, s.nama_lengkap FROM forum f JOIN siswa s ON f.dibuat_oleh = s.id_siswa WHERE f.id_forum = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $forum_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$forum = mysqli_fetch_assoc($result);

// Ambil komentar
$query = "SELECT k.*, s.nama_lengkap 
          FROM komentar k 
          JOIN siswa s ON k.siswa_id = s.id_siswa 
          WHERE k.forum_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $forum_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$komentar = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komentar Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #f4f7f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }
        .btn-primary {
            background-color: #5A67D8;
            border: none;
        }
        .btn-primary:hover {
            background-color: #4C51BF;
        }
        .comment-bubble {
    max-width: 70%;
    padding: 12px 16px;
    border-radius: 20px;
    margin: 8px 0;
    position: relative;
    animation: fadeIn 0.3s ease-in-out;
}

.comment-bubble.self {
    background-color: #E6FFFA;
    align-self: flex-end;
    margin-left: auto; /* Posisi ke kanan */
    text-align: right; /* Teks rata kanan */
}

.comment-bubble.other {
    background-color: #EDF2F7;
    align-self: flex-start;
    margin-right: auto; /* Posisi ke kiri */
    text-align: left; /* Teks rata kiri */
}

.comment-container {
    display: flex;
    flex-direction: column;
}

        .comment-list {
            max-height: 350px;
            overflow-y: auto;
            margin-bottom: 10px;
            padding: 10px;
            background: #fff;
            border-radius: 10px;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h1 class="h5"><?= htmlspecialchars($forum['judul']) ?></h1>
            </div>
            <div class="card-body">
                <p><strong>Oleh:</strong> <?= htmlspecialchars($forum['nama_lengkap']) ?></p>
                <p><?= htmlspecialchars($forum['deskripsi']) ?></p>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h2 class="h6">Komentar</h2>
            </div>
            <div class="card-body">
                <div class="comment-list" id="comment-list">
                    <?php foreach ($komentar as $kom): ?>
                        <div class="comment-container">
    <div class="comment-bubble <?= ($kom['nama_lengkap'] == $_SESSION['nama_lengkap']) ? 'self' : 'other' ?>">
        <span class="fw-bold d-block"><?= htmlspecialchars($kom['nama_lengkap']) ?></span>
        <p><?= htmlspecialchars($kom['isi_komentar']) ?></p>
    </div>
</div>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-info text-white">
                <h2 class="h6">Buat Komentar Baru</h2>
            </div>
            <div class="card-body">
                <form id="comment-form" method="POST">
                    <input type="hidden" name="forum_id" id="forum_id" value="<?= $forum_id ?>">
                    <div class="mb-3">
                        <label for="isi_komentar" class="form-label">Komentar:</label>
                        <textarea name="isi_komentar" id="isi_komentar" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim Komentar</button>
                    <a href="forum.php" class="btn btn-secondary">Selesai</a>
                </form>
            </div>
        </div>
    </div>

    <script>
    $("#comment-form").on("submit", function(event) {
    event.preventDefault(); // Mencegah form default submit

    const forumId = $("#forum_id").val();
    const isiKomentar = $("#isi_komentar").val();

    // Kirim AJAX request
    $.ajax({
        url: "buat_komentar.php", // URL endpoint untuk memasukkan komentar baru
        type: "POST",
        data: {
            forum_id: forumId,
            isi_komentar: isiKomentar
        },
        success: function(response) {
            const data = JSON.parse(response);
            if (data.success) {
                // Tambahkan komentar baru ke list komentar
                const newComment = `<div class='comment-container'>
                    <div class='comment-bubble self'>
                        <span class='fw-bold d-block'>${data.nama_lengkap}</span>
                        <p>${data.isi_komentar}</p>
                    </div>
                </div>`;
                $("#comment-list").append(newComment); // Menambahkan komentar di bawah list komentar

                // Bersihkan textarea dan scroll ke bawah
                $("#isi_komentar").val(""); // Bersihkan textarea
                $("#comment-list").scrollTop($("#comment-list")[0].scrollHeight); // Scroll ke bawah untuk komentar terbaru
            } else {
                alert("Gagal menambahkan komentar. Coba lagi.");
            }
        },
        error: function() {
            alert("Terjadi kesalahan saat mengirim komentar. Coba lagi.");
        }
    });
});


</script>

</body>
</html>
