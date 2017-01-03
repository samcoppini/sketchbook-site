<!DOCTYPE html>
<html>
  <head>
    <title>Sam's Sketchbook</title>
    <link href="stylesheet.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <h1>Archive:</h1>
<?php
    $drawings = json_decode(file_get_contents("drawings.json"), true);
    $index = count($drawings);
    $base_url = "http://" . $_SERVER["SERVER_NAME"] . "/";

    while ($index-- > 0) {
      $drawing = $drawings[$index];
      ?>
        <a href="<?= $base_url . "?page=" . $index ?>">
          <?= $drawing["name"] ?>
        </a><br />
      <?php
    }
?>
  </body>
</html>
