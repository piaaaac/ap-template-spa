<?php
/*

1. [ONLY FIRST TIME] htaccess always brings to index.php and passes UID as get parameter
2. [ALWAYS ON PAGE CHANGE] ajax request for UID
3. [ALWAYS ON PAGE CHANGE] get rendered stuff

1. [DYNAMIC PAGE CHANGE] js history push
2. [ALWAYS ON PAGE CHANGE] ajax request for UID
3. [ALWAYS ON PAGE CHANGE] get rendered stuff

*/

require "config.php";

$url = "https://...org";
$urlSocialImg = $url. "/assets/images/....jpg";
$title = "Site title";
$desc = "Site description";
$twitterAuthor = "@...";
?>

<!DOCTYPE html><html><head>

  <title><?= $title ?></title>
  <base href="<?= $urls["site"] ?>/"> <!-- to match with .htaccess if url is rewritten -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="description" content="<?= $desc ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

  <!-- TWITTER -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:site" content="<?= $twitterAuthor ?>" />
  <meta name="twitter:title" content="<?= $title ?>" />
  <meta name="twitter:description" content="<?= $desc ?>" />
  <meta name="twitter:image" content="<?= $urlSocialImg ?>" />

  <!-- OG -->
  <meta property="og:url" content="<?= $url ?>" />
  <meta property="og:image" content="<?= $urlSocialImg ?>" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="<?= $title ?>" />
  <meta property="og:description" content="<?= $desc ?>" />

  <!-- Favicon -->

  <!-- Vendor -->
  <script src="assets/lib/jquery-3.5.1/jquery-3.5.1.min.js"></script>
  <script src="assets/lib/handlebars-4.7.6/handlebars.js"></script>

  <!-- Style -->
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-custom.css">
  <link rel="stylesheet" type="text/css" href="assets/css/index.css">

</head>
<body>

<?php

// --- load json
$jsonStr = file_get_contents("frontendSettings.json");
$frontendSettings = json_decode($jsonStr, true);

$jsonStr = file_get_contents("apiBindings.json");
$apiBindings = json_decode($jsonStr, true);

$uid = $_GET["uid"] ?? "home";
require "templates.php";

?>

<nav class="header">
  <div class="left">
    <?php foreach ($frontendSettings["menuItems"] as $item): ?>
      <a class="" href="javascript:;" onclick="a.handleMenuClick('<?= $item["id"] ?>')"><?= $item["pageTitle"] ?></a>
    <?php endforeach ?>
  </div>
  <div class="right">
    <button class="hamburger hamburger--slider" type="button" onclick="a.toggleMenu();">
      <span class="hamburger-box"><span class="hamburger-inner"></span></span>
    </button>
  </div>
</nav>

<nav id="menu-xs">
  <?php foreach ($frontendSettings["menuItems"] as $item): ?>
    <a class="" href="javascript:;" onclick="a.handleMenuClick('<?= $item["id"] ?>')"><?= $item["pageTitle"] ?></a>
  <?php endforeach ?>
</nav>

<main>
  <div id="content"></div>
</main>

<script src="assets/js/index.js"></script>
<script type="text/javascript">

console.log("detected language: ", '<?= $lang ?>');
var settings = <?= json_encode($frontendSettings) ?>;
var apiBindings = <?= json_encode($apiBindings) ?>;
var initialPageId = '<?= $uid ?>';
var baseUrl = '<?= $urls["site"] ?>';
var a;
$(document).ready(function () {
  a = new App(initialPageId);
});

</script>  
</body>
</html>