<?php
// ...existing code...
// Count students who have been graded and those who haven't
$query_graded = "SELECT COUNT(*) as graded_count FROM nilai_siswa WHERE nilai IS NOT NULL";
$query_not_graded = "SELECT COUNT(*) as not_graded_count FROM siswa WHERE id NOT IN (SELECT siswa_id FROM nilai_siswa WHERE nilai IS NOT NULL)";
$graded_count = $conn->query($query_graded)->fetch_assoc()['graded_count'];
$not_graded_count = $conn->query($query_not_graded)->fetch_assoc()['not_graded_count'];
?>
<div>
    <p>Siswa yang sudah dinilai: <?php echo $graded_count; ?></p>
    <p>Siswa yang belum dinilai: <?php echo $not_graded_count; ?></p>
</div>
// ...existing code...
