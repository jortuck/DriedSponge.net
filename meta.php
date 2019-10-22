
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-140402227-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-140402227-3');
</script>

<?php

if ( date("m") == "10" ){
    $theme = "https://driedsponge.net/css/spook.css";
    $themefav = "https://cdn.driedsponge.net/img/favicon-spook.ico";
} else {
    $theme = "https://driedsponge.net/css/textclass.css";
    $themefav = "https://cdn.driedsponge.net/img/zfavicon.ico";
}


?>
<meta name="theme-color" content="#007BFF">
 <link id="styless" rel="stylesheet" href = "<?php echo $theme; ?>" >
 <link id="favicon" rel="icon" href = "<?php echo $themefav; ?>" type="image/x-icon">