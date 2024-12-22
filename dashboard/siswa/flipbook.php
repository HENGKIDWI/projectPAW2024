<?php
// Mendapatkan file PDF dari query string
$pdfFile = isset($_GET['file']) ? urldecode($_GET['file']) : '';

// Periksa apakah file ada
$filePath = '../../uploads/ebook/assets/books/' . $pdfFile;

if (empty($pdfFile) || !file_exists($filePath)) {
    die('File tidak ditemukan atau tidak valid.');
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>3D FlipBook - <?php echo htmlspecialchars($pdfFile); ?></title>
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <!-- Flipbook StyleSheet -->
    <link href="../../uploads/ebook/assets/css/dflip.min.css" rel="stylesheet" type="text/css" />

    <!-- Icons Stylesheet -->
    <link
      href="../../uploads/ebook/assets/css/themify-icons.min.css"
      rel="stylesheet"
      type="text/css"
    />
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
     
          <!-- Dynamic Flipbook -->
          <div
            class="_df_book"
            height="600"
            webgl="true"
            backgroundcolor="teal"
            source="<?php echo htmlspecialchars($filePath); ?>"
            id="df_manual_book"
          >
        </div>
        </div>
      </div>
    </div>

    <!-- jQuery  -->
    <script src="../../uploads/ebook/assets/js/libs/jquery.min.js" type="text/javascript"></script>
    <script src="../../uploads/ebook/assets/js/libs/three.min.js" type="text/javascript"></script>
    <script src="../../uploads/ebook/assets/js/libs/compatibility.js" type="text/javascript"></script>
    <script src="../../uploads/ebook/assets/js/libs/mockup.min.js" type="text/javascript"></script>
    <script src="../../uploads/ebook/assets/js/libs/pdf.min.js" type="text/javascript"></script>
    <script src="../../uploads/ebook/assets/js/libs/pdf.worker.min.js" type="text/javascript"></script>
    <!-- Flipbook main Js file -->
    <script src="../../uploads/ebook/assets/js/dflip.min.js" type="text/javascript"></script>
  </body>
</html>
