<?php
  // Redirects the browser to a given URL
  function redirect($url) {
    header("Location: " . $url, true, 303);
    die();
  }

  // Displays the navigation buttons
  function display_buttons($page_num, $max) {
    $disabled_link = 'class="disabled"';
    if ($page_num > 0) {
      $first_link = 'href="?page=0"';
      $prev_link  = 'href="?page=' . ($page_num - 1) . '"';
    }
    else {
      $first_link = $disabled_link;
      $prev_link  = $disabled_link;
    }
    if ($page_num < $max) {
      $last_link = "href=\"?page=$max\"";
      $next_link = 'href="?page=' . ($page_num + 1) . '"';
    }
    else {
      $last_link = $disabled_link;
      $next_link = $disabled_link;
    }
  ?>
    <div class="nav-bar">
      <a <?= $first_link ?>>&lt;&lt;</a>
      <a <?= $prev_link ?>>&lt;</a>
      <a href="?page=random">?</a>
      <a <?= $next_link ?>>&gt;</a>
      <a <?= $last_link ?>>&gt;&gt;</a>
    </div>
  <?php
  }

  $base_url = "http://" . $_SERVER["SERVER_NAME"] . "/";
  $drawings = json_decode(file_get_contents("drawings.json"), true);
  $max_drawing_index = count($drawings) - 1;

  // Determine what drawing to display
  if (!isset($_GET["page"])) {
    $page_num = $max_drawing_index;
  }
  else {
    $page_num = $_GET["page"];
    if (!is_numeric($page_num)) {
      // Redirect to a random page if the page is set to random, but redirect
      // to the base url if it's set to any other nonnumeric value
      if ($page_num == "random")
        redirect($base_url . "?page=" . rand(0, $max_drawing_index));
      else
        redirect($base_url);
    }
    // Redirect from attempted access of drawings with an index too small
    // or too large
    elseif ($page_num < 0)
      redirect($base_url . "?page=0");
    elseif ($page_num > $max_drawing_index)
      redirect($base_url);
  }

  $drawing = $drawings[$page_num];
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Sam's Sketchbook Site</title>
    <link href="stylesheet.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <h1><?= $drawing["name"] ?></h1>
<?php display_buttons($page_num, $max_drawing_index); ?>
    <a href="<?= $drawing["link-url"] ?>" target="_blank">
      <img src="<?= $drawing["filename"] ?>"
           alt="<?= $drawing["name"] ?>"
           id="drawing" />
    </a>
<?php display_buttons($page_num, $max_drawing_index); ?>
  </body>
</html>
