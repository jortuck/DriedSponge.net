<meta charset="UTF-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="<?=v(url());?>css/argon.min.css">
<link rel="stylesheet" type="text/css" href="<?=v(url());?>css/aos.css" />
<link href='https://fonts.googleapis.com/css?family=Bangers' rel='stylesheet'>


<script src="<?=v(url());?>js/aos.js"></script>
<script src="<?=v(url());?>js/argon.js"></script>
<meta name="viewport" content="width = device-width, initial-scale = 1">
<!-- Global site tag (gtag.js) - Google Analytics -->


<?php


  $theme = url()."css/textclass.css";
  $themefav = url()."img/zfavicon.ico";
  $themecol = "#007BFF";


?>

<meta name="theme-color" content="<?= htmlspecialchars($themecol); ?>">
<link type="text/css" rel="stylesheet" href="<?=v(url());?>css/formatting.css">
<link type="text/css" rel="stylesheet" href="<?= htmlspecialchars($theme); ?>">

<link rel="icon" href="<?= htmlspecialchars($themefav); ?>" type="image/x-icon">
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-140402227-3"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-140402227-3"></script>
<script src="<?=v(url());?>functions.js"></script>
<style>
  @font-face {
    font-family: 'fortnite';
    src: url(<?=v(url());?>fonts/burbank.otf);
  }
</style>
<script>
  window.dataLayer = window.dataLayer || [];

  function gtag() {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());

  gtag('config', 'UA-140402227-3');
</script>