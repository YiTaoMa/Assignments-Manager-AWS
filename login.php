<?php
require_once "configure.php"; // part of login function just called configure

if (isset($_SESSION["currentUserId"])) { // if the user already logged in can not login again
  echo "<body style='background-color:powderblue;text-align:center;'>";
  echo "<div>";
  echo "<h1>You already logged in!</h1>";
  echo "<br>";
  echo "<h1>Redirecting you to the main page in 3 seconds...</h1>";
  echo "</div>";
  echo "<img src='images/lock.jpg' style='background-color:powderblue;' alt='access denied' width='660' height='345'>";
  echo "</body>";
  header("refresh:3; url=index.php");
  exit();
} else {
  if (isset($_COOKIE['idVariableFinal'])) { // if the user login with google success
    $getUIDFinal = $_COOKIE['idVariableFinal'];
    $getUNFinal = $_COOKIE['user_nameVariableFinal'];
    $getUEFinal = $_COOKIE['emailVariableFinal'];

    $_SESSION["currentUserId"] = $getUIDFinal;
    $_SESSION["user_name"] = $getUNFinal;
    $_SESSION["currentUserEmail"] = $getUEFinal;
    if (isset($_SESSION["currentUserId"])) {
      header("Location:manager.php");
      exit();
    }
  }
?>
  <!DOCTYPE html>
  <html style="font-size: 16px;">

  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Login Now">
    <meta name="description" content="">
    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <title>login</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="login.css" media="screen">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta name="generator" content="Nicepage 4.6.5, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    <style>
      a.googleLogin:link,
      a.googleLogin:visited {
        background-color: white;
        color: black;
        border: 2px solid blue;
        border-radius: 15px 50px;
        padding: 5px 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
      }

      a.googleLogin:hover,
      a.googleLogin:active {
        background-color: blue;
        color: white;
      }
    </style>

    <script>
      function ajaxCall(passedEmail, passedPassword) { // make a Get request to API Gateway
        $.ajax({
          method: 'GET',
          url: 'https://xxxxxx.execute-api.xxxxxxx.amazonaws.com/testLogin/loginpath?email=' + passedEmail + '&password=' + passedPassword,
          dataType: "json",
          success: function(result) { //when returned
            var stringResult = JSON.stringify(result);
            const myObj = JSON.parse(stringResult);
            var messageReturned = myObj.message;
            if (messageReturned === "Success") { // means login success
              var idVariable = myObj.id;
              var user_nameVariable = myObj.user_name;
              var emailVariable = myObj.email;
              // below add to cookie so can be used by php to set session
              document.cookie = "idVariableFinal=" + idVariable;
              document.cookie = "user_nameVariableFinal=" + user_nameVariable;
              document.cookie = "emailVariableFinal=" + emailVariable;
              location.reload(true); //reload the page to let php code capture cookie
            } else { // login fail, display error message
              $("#loginFailError").html(messageReturned);
            }
          },
          error: function ajaxError(jqXHR) { // if something went wrong, display error message
            console.error('Error: ', jqXHR.responseText);
          }
        });
      }
    </script>
    <script language="javascript" type="text/javascript">
      function removeSpaces(string) {
        return string.split(' ').join('');
      }
    </script>
    <script type="application/ld+json">
      {
        "@context": "http://schema.org",
        "@type": "Organization",
        "name": "",
        "logo": "images/logo.png"
      }
    </script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="login">
    <meta property="og:type" content="website">
  </head>
  <?php
  if (isset($_POST['login_submit'])) { // the user clicks login button
    $postEmail = $_POST["email"];
    $postPassword = $_POST["password"];
    // below invoke ajax function
    echo "<script type='text/javascript'>
    var postEmail_var = '$postEmail';
    var postPassword_var = '$postPassword';
    ajaxCall(postEmail_var,postPassword_var);
    </script>";
  }
  ?>

  <body class="u-body u-xl-mode">
    <?php require_once("includes/fragment/header.php"); ?>
    <section class="u-clearfix u-image u-section-1" id="sec-3921" data-image-width="1980" data-image-height="1114">
      <div class="u-clearfix u-sheet u-valign-middle-xl u-sheet-1">
        <div class="u-clearfix u-expanded-width u-gutter-0 u-layout-wrap u-layout-wrap-1">
          <div class="u-layout" style="">
            <div class="u-layout-row" style="">
              <div class="u-align-center u-container-style u-hidden-sm u-hidden-xs u-image u-layout-cell u-right-cell u-size-30 u-size-xs-60 u-image-1" src="" data-image-width="1280" data-image-height="925">
                <div class="u-container-layout u-valign-middle u-container-layout-1" src=""></div>
              </div>
              <div class="u-align-left u-container-style u-layout-cell u-left-cell u-size-30 u-size-xs-60 u-white u-layout-cell-2" src="">
                <div class="u-container-layout u-valign-bottom-sm u-container-layout-2">
                  <?php
                  if (isset($_SESSION['register_success'])) {
                    echo '<b><h4 style="color:green;text-align:center;">' . $_SESSION['register_success'] . '</h4></b>';
                    unset($_SESSION['register_success']);
                  }
                  ?>
                  <h1 class="u-text u-text-default u-text-1">Login Now</h1><span class="u-file-icon u-icon u-icon-1"><img src="images/295128.png" alt=""></span>
                  <div class="u-align-center u-form u-form-1">
                    <form action="login.php" method="POST" name="frmUser" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" style="padding: 10px;">
                      <div class="u-form-email u-form-group u-label-top u-form-group-1">
                        <b><span id="loginFailError" style="margin:auto;display:table;color:red;"></span></b>
                        <label for="email-5965" class="u-label">Email:</label>
                        <input type="email" placeholder="Enter a valid email address | sample@gmail.com" id="email-5965" name="email" onblur="this.value=removeSpaces(this.value);" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-50 u-white" required="">
                      </div>
                      <div class="u-form-group u-label-top u-form-group-2">
                        <label for="text-7d55" class="u-label">Password:</label>
                        <input type="password" placeholder="xxxxxxxx" id="text-7d55" name="password" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-50 u-white" required="required">
                      </div>
                      <div class="u-align-center u-form-group u-form-submit u-label-top">
                        <input type="submit" name="login_submit" value="Login" class="u-active-black u-border-none u-btn u-btn-round u-btn-submit u-button-style u-hover-palette-2-base u-palette-1-base u-radius-50 u-btn-1">
                        <br>
                        <br>
                        <?php echo $loginButton; ?>
                      </div>
                    </form>
                  </div>
                  <a href="register.php" class="u-active-none u-align-right u-border-2 u-border-palette-1-base u-bottom-left-radius-0 u-bottom-right-radius-0 u-btn u-btn-rectangle u-button-style u-hover-none u-none u-radius-0 u-text-active-black u-text-hover-palette-2-base u-top-left-radius-0 u-top-right-radius-0 u-btn-2">Don't have an Account?</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php require_once("includes/fragment/footer.php"); ?>
    <script type="text/javascript" src="//xx.addthis.com/js/xxx/addthis_widget.js#pubid=xxxxxxxxxxx"></script>
  </body>

  </html>
<?php
}
?>