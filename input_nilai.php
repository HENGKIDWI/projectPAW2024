<?php
// ...existing code...
// Fetch existing values from the database
$query = "SELECT nilai FROM nilai_siswa WHERE siswa_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $siswa_id);
$stmt->execute();
$result = $stmt->get_result();
$nilai = $result->fetch_assoc()['nilai'] ?? '';
// ...existing code...
?>
<input type="text" name="nilai" value="<?php echo htmlspecialchars($nilai); ?>" />
// ...existing code...
