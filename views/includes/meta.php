<meta charset="UTF-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://driedsponge.net/css/aos.css" />
<script src="https://driedsponge.net/js/aos.js"></script>
<meta name="viewport" content="width = device-width, initial-scale = 1">
<!-- Global site tag (gtag.js) - Google Analytics -->


<?php

if (date("m") == "10") {
  $theme = "css/spook.css";
  $themefav = "https://cdn.driedsponge.net/img/favicon-spook.ico";
  $themecol = "#E4541C";
  // $decoration = "https://driedsponge.net/js/bats.js";
} else {
  $theme = "../css/textclass.css";
  $themefav = "../img/zfavicon.ico";
  $themecol = "#007BFF";
}

/* if ( date("m") == "12" ){
  $theme = "https://driedsponge.net/css/december.css";
  $themefav = "https://cdn.driedsponge.net/img/zfavicon.ico";
  $themecol = "#000";
  $decoration = "https://driedsponge.net/js/snowstorm.js";
  $decorationbool = true;
} else {
  $theme = "https://driedsponge.net/css/textclass.css";
  $themefav = "https://cdn.driedsponge.net/img/zfavicon.ico";
  $themecol = "#007BFF";
  $decorationbool = false;
} */

?>

<meta name="theme-color" content="<?= htmlspecialchars($themecol); ?>">
<link rel="stylesheet" href="../css/formatting.css">
<link id="styless" rel="stylesheet" href="<?= htmlspecialchars($theme); ?>">

<link rel="icon" href="<?= htmlspecialchars($themefav); ?>" type="image/x-icon">
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-140402227-3"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-140402227-3"></script>


<script>
  window.dataLayer = window.dataLayer || [];

  function gtag() {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());

  gtag('config', 'UA-140402227-3');
</script>