<?php 
/**
 * Main template
 * 
 * @var Page $page
 */
?>
<!doctype html>
<html lang="lv">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="#ScienceForUkraine is a voluntary initiative whose mission is to support students and researchers from Ukraine directly affected by the Russia’s invasion." />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= htmlspecialchars($page->title) ?></title>
    <link href="assets/leaflet/leaflet.css" rel="stylesheet">
    <link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="assets/local_css/default_page.css" rel="stylesheet">
        
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-BVWXGWBK9R"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-BVWXGWBK9R');
    </script>
  </head>

  <body>
    <div class="row info">
      <div class="col order-lg-2">
        <img src="assets/sfu-banner.png" alt="Science For Ukraine " class="logo" />
      </div>
      <div class="col nav order-lg-1">
        <p>Navigation</p>
        <ul>          
          <li><a href="help.html">How you can help</a></li>
          <li><a href="team.html">Team</a></li>
        </ul>    
      </div>
      <div class="col order-lg-3"></div>
    </div>

    <?= $page->content ?>

    <script src="assets/leaflet/leaflet.js"></script>
    <script src="assets/load_map.js"></script>
    <script>L.Icon.Default.imagePath = 'assets/leaflet/images/';</script>  
    <script src="data.js?v=F"></script>
    <script src="draw.js?v=3"></script>
</body>


</html>
