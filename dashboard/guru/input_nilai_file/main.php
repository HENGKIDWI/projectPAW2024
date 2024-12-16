<?php
// session_start();
// require_once '../../koneksi.php';
// require_once '../../layout/header.php';
// if (!isset($_SESSION['username'])) {
//     header("Location: login.php");
//     exit;
// } blm d
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>input_nilai</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <!-- container pilih tugas -->
  <div class="container">
    <?php //require_once '../../layout/sidebar.php'; 
    ?>
    <h3>Input Nilai</h3>
    <div class="dropdown">
      <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        pilih tugas
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">Tugas</a></li>
        <li><a class="dropdown-item" href="#">Ujian</a></li>
      </ul>
    </div>
  </div>

  <!-- container jika tugas -->
  <div class="container">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nama</th>
          <th scope="col">kelas</th>
          <th scope="col">Nilai</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>Mark</td>
          <td>x-1</td>
          <td><input type="number"></td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- container jika ujian -->
  <div class="container">
  <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama</th>
      <th scope="col">kelas</th>
      <th scope="col">Nilai</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>x-1</td>
      <td><!--upload file--></td>
    </tr>
  </tbody>
</table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>