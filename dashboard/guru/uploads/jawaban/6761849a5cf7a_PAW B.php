<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Siswa dan Nilai</title>
</head>
<body>

    <h2>Form Input Nilai Siswa</h2>

    <form action="" method="POST">
        <label for="name">Nama Siswa:</label>
        <input type="text" name="names[]" required>
        <br><br>

        <label for="subject1">Nilai Mata Pelajaran 1:</label>
        <input type="number" name="subject1[]" required>
        <br><br>

        <label for="subject2">Nilai Mata Pelajaran 2:</label>
        <input type="number" name="subject2[]" required>
        <br><br>

        <label for="subject3">Nilai Mata Pelajaran 3:</label>
        <input type="number" name="subject3[]" required>
        <br><br>

        <button type="submit" name="submit">Tambah Siswa</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $names = $_POST['names'];
        $subject1 = $_POST['subject1'];
        $subject2 = $_POST['subject2'];
        $subject3 = $_POST['subject3'];

        $totalClassSum = 0;
        $maxScore = -INF;
        $minScore = INF;
        $numStudents = count($names);

        echo "<h3>Hasil</h3>";
        echo "<ul>";

        for ($i = 0; $i < $numStudents; $i++) {
            $totalScore = $subject1[$i] + $subject2[$i] + $subject3[$i];
            $averageScore = $totalScore / 3;

            echo "<li>" . $names[$i] . ": Rata-rata = " . number_format($averageScore, 2) . "</li>";

            $totalClassSum += $averageScore;
            $maxScore = max($maxScore, $subject1[$i], $subject2[$i], $subject3[$i]);
            $minScore = min($minScore, $subject1[$i], $subject2[$i], $subject3[$i]);
        }

        echo "</ul>";

        $classAverage = $totalClassSum / $numStudents;

        echo "<p>Rata-rata kelas: " . number_format($classAverage, 2) . "</p>";
        echo "<p>Nilai tertinggi: " . $maxScore . "</p>";
        echo "<p>Nilai terendah: " . $minScore . "</p>";
    }
    ?>

</body>
</html>