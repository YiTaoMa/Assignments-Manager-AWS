<?php
session_start();
?>
<!DOCTYPE html>
<html style="font-size: 16px;">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <meta name="keywords" content="Assignments Manager">
  <meta name="description" content="">
  <meta name="page_type" content="np-template-header-footer-from-plugin">
  <title>index</title>
  <link rel="stylesheet" href="nicepage.css" media="screen">
  <link rel="stylesheet" href="index.css" media="screen">
  <meta name="generator" content="Nicepage 4.6.5, nicepage.com">
  <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
  <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Playball:400">
  <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Organization",
      "name": "",
      "logo": "images/logo.png"
    }
  </script>
  <meta name="theme-color" content="#478ac9">
  <meta property="og:title" content="index">
  <meta property="og:type" content="website">
</head>

<body data-home-page="index.html" data-home-page-title="index" class="u-body u-xl-mode">
  <?php require_once("includes/fragment/header.php"); ?>
  <section class="u-align-center u-clearfix u-image u-section-1" id="sec-025c" data-image-width="1980" data-image-height="1114">
    <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
      <?php
      if (isset($_SESSION['register_success_Already_LoggedIn'])) {
        echo '<b><h4 style="color:green;text-align:center;">' . $_SESSION['register_success_Already_LoggedIn'] . '</h4></b>';
        unset($_SESSION['register_success_Already_LoggedIn']);
      }
      ?>
      <h1 class="u-text u-text-default u-title u-text-1"> Assignments are coming!&nbsp;</h1>
      <p class="u-text u-text-2"> With it comes anger, anxiety and stress.</p>
      <div class="u-expanded-width u-gallery u-layout-grid u-lightbox u-show-text-on-hover u-gallery-1">
        <div class="u-gallery-inner u-gallery-inner-1">
          <div class="u-effect-fade u-gallery-item" data-href="https://nicepage.com/wordpress-themes">
            <div class="u-back-slide" data-image-width="1280" data-image-height="853">
              <img class="u-back-image u-expanded" src="images/92e06111279de33916caec8e9fdcda5fe0262446a040e6c8bdc91432eced575232ff2e3f43cbf589eb4ed0ec0ebdc202151cf17d8cb02993e4bd72_1280.jpg">
            </div>
            <div class="u-over-slide u-shading u-over-slide-1">
              <h3 class="u-gallery-heading"></h3>
              <p class="u-gallery-text"></p>
            </div>
          </div>
          <div class="u-effect-fade u-gallery-item" data-href="https://nicepage.com/wysiwyg-html-editor">
            <div class="u-back-slide" data-image-width="1280" data-image-height="853">
              <img class="u-back-image u-expanded" src="images/9f9b100c33d2f8fc5a32f0ad9ffd78025f0a748ea94b9659f5e84e7572817b02d0d48481a24bb3fb36ba435f94c60240fc57e0f88169aebe91056f_1280.jpg">
            </div>
            <div class="u-over-slide u-shading u-over-slide-2">
              <h3 class="u-gallery-heading"></h3>
              <p class="u-gallery-text"></p>
            </div>
          </div>
          <div class="u-effect-fade u-gallery-item" data-href="https://nicepage.studio">
            <div class="u-back-slide" data-image-width="1280" data-image-height="668">
              <img class="u-back-image u-expanded" src="images/f8cd324df2c39b409f933ce8aae32d4ee103dfdd0c6e7a5364dc653b789cfa7f4f4aa4c682a6ff63c602728e9598a4e733519345a6694b2c5edc75_1280.jpg">
            </div>
            <div class="u-over-slide u-shading u-over-slide-3">
              <h3 class="u-gallery-heading"></h3>
              <p class="u-gallery-text"></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="u-align-center u-clearfix u-image u-section-2" id="carousel_d209" data-image-width="1980" data-image-height="1114">
    <div class="u-clearfix u-layout-wrap u-layout-wrap-1">
      <div class="u-gutter-0 u-layout">
        <div class="u-layout-row">
          <div class="u-container-style u-layout-cell u-size-29 u-layout-cell-1">
            <div class="u-container-layout u-container-layout-1">
              <h1 class="u-align-center u-custom-font u-text u-text-palette-1-dark-3 u-text-1">Assignments Manager</h1>
              <p class="u-align-center u-text u-text-2"> Are you still worried about the arrival of various assignments? Do you find it difficult to plan your assignments? Then, today you have come to the right place where your worries will vanish. What are you waiting for, let's destroy worries together!</p>
              <a href="register.php" class="u-active-palette-3-base u-btn u-btn-round u-button-style u-grey-90 u-hover-palette-2-base u-radius-20 u-btn-1" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction=""><span class="u-icon u-icon-1"></span>&nbsp;Register
              </a>
              <?php if ($_SESSION["user_name"]) { ?>
                <a href="logout.php" class="u-active-palette-3-base u-btn u-btn-round u-button-style u-grey-90 u-hover-palette-2-base u-radius-20 u-btn-2" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">Logout</a>
              <?php } else { ?>
                <a href="login.php" class="u-active-palette-3-base u-btn u-btn-round u-button-style u-grey-90 u-hover-palette-2-base u-radius-20 u-btn-2" data-animation-name="" data-animation-duration="0" data-animation-delay="0" data-animation-direction="">Login</a>
              <?php } ?>
            </div>
          </div>
          <div class="u-align-right u-container-style u-image u-layout-cell u-size-31 u-image-1" data-image-width="1333" data-image-height="1000">
            <div class="u-container-layout u-valign-bottom u-container-layout-2"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php require_once("includes/fragment/footer.php"); ?>
  <script type="text/javascript" src="//xx.addthis.com/js/xxx/addthis_widget.js#pubid=xxxxxxxx"></script>
</body>

</html>