<?php
session_start();
if (isset($_COOKIE['alowAccessFinal'])) { // if the user registered by aws lambda function
  if (isset($_SESSION["currentUserId"])) { // if user already logged in
    $_SESSION["register_success_Already_LoggedIn"] = "Register another account successfully! You can now log in to another account!";
    unset($_COOKIE['alowAccessFinal']);
    setcookie('alowAccessFinal', '', time() - 3600, '/');
    header('location:index.php');
    exit();
  } else {
    $_SESSION["register_success"] = "Register successfully, please login!";
    unset($_COOKIE['alowAccessFinal']);
    setcookie('alowAccessFinal', '', time() - 3600, '/');
    header('location:login.php');
    exit();
  }
}
?>
<!DOCTYPE html>
<html style="font-size: 16px;">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <meta name="keywords" content="Register Now">
  <meta name="description" content="">
  <meta name="page_type" content="np-template-header-footer-from-plugin">
  <title>register</title>
  <link rel="stylesheet" href="nicepage.css" media="screen">
  <link rel="stylesheet" href="register.css" media="screen">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <meta name="generator" content="Nicepage 4.6.5, nicepage.com">
  <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
  <script>
    function ajaxCallRegister(postUsernameR_var, postEmailR_var, postPassR_var, postConfirmPassR_var) {
      $.ajax({ // ajax send get request to api gateway
        method: 'GET',
        url: 'https://xxxxxxxx.execute-api.xxxxxx.amazonaws.com/registerStage/registerpath?userName=' + postUsernameR_var + '&email=' + postEmailR_var + '&password=' + postPassR_var + '&confirmPassword=' + postConfirmPassR_var,
        dataType: "json",
        success: function(result) {
          var stringResult = JSON.stringify(result);
          const myObj = JSON.parse(stringResult);
          var noErrors = myObj.registerUser;
          if (noErrors == "true") { // means we can register user
            var alowAccess = "true";
            document.cookie = "alowAccessFinal=" + alowAccess;
            location.reload(true);
          } else { // can not register user, display error messages
            var userNameError = myObj.userNameError;
            var emailError = myObj.emailError;
            var confirmPassError = myObj.confirmPassError;

            if (userNameError != "") {
              $("#userNameError").html(userNameError);
            }
            if (emailError != "") {
              $("#emailError").html(emailError);
            }
            if (confirmPassError != "") {
              $("#confirmPassError").html(confirmPassError);
            }
          }
        },
        error: function ajaxError(jqXHR) {
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
  <meta property="og:title" content="register">
  <meta property="og:type" content="website">
</head>
<?php
if (isset($_POST['reg_user'])) { //if clicked register user
  $userName = $_POST['userName'];
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  $confirmPass = $_POST['confirmPass'];

  echo "<script type='text/javascript'>
    var postUsernameR_var = '$userName';
    var postEmailR_var = '$email';
    var postPassR_var = '$pass';
    var postConfirmPassR_var = '$confirmPass';
    ajaxCallRegister(postUsernameR_var,postEmailR_var,postPassR_var,postConfirmPassR_var);
    </script>";
}
?>

<body class="u-body u-xl-mode">
  <?php require_once("includes/fragment/header.php"); ?>
  <section class="u-clearfix u-image u-section-1" id="sec-73e1" data-image-width="1980" data-image-height="1114">
    <div class="u-clearfix u-sheet u-valign-middle-xl u-valign-middle-xs u-sheet-1">
      <div class="u-clearfix u-expanded-width u-gutter-0 u-layout-wrap u-layout-wrap-1">
        <div class="u-layout" style="">
          <div class="u-layout-row" style="">
            <div class="u-align-center u-container-style u-hidden-sm u-hidden-xs u-image u-layout-cell u-right-cell u-size-30 u-size-xs-60 u-image-1" src="" data-image-width="1280" data-image-height="827">
              <div class="u-container-layout u-valign-middle u-container-layout-1" src=""></div>
            </div>
            <div class="u-align-left u-container-style u-layout-cell u-left-cell u-size-30 u-size-xs-60 u-white u-layout-cell-2" src="">
              <div class="u-container-layout u-valign-top-md u-valign-top-sm u-valign-top-xs u-container-layout-2">
                <h1 class="u-text u-text-default u-text-1">Register Now</h1>
                <div class="u-form u-form-1">
                  <form action="register.php" method="POST" class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" name="RegisterForm" style="padding: 10px;">
                    <div class="u-form-group u-form-name">
                      <b><span id="userNameError" style="text-align: center;margin:auto;display:table;color:red;"></span></b>
                      <label for="name-f04b" class="u-label">User Name: (No spaces allowed in between)</label>
                      <input type="text" placeholder="E.g. Ethan" id="name-f04b" name="userName" maxlength="15" onblur="this.value=removeSpaces(this.value);" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-50 u-white" required="">
                    </div>
                    <div class="u-form-email u-form-group">
                      <b><span id="emailError" style="text-align: center;margin:auto;display:table;color:red;"></span></b>

                      <label for="email-f04b" class="u-label">Valid Email:</label>
                      <input type="email" placeholder="E.g. validAddress@gmail.com" id="email-f04b" name="email" onblur="this.value=removeSpaces(this.value);" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-50 u-white" required="">
                    </div>
                    <div class="u-form-group u-form-group-3">
                      <label for="text-e182" class="u-label">Password (Minimum 8 digits):</label>
                      <input type="password" placeholder="XXXXXXXX" id="text-e182" name="pass" minlength="8" maxlength="60" required="" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-50 u-white">
                    </div>
                    <div class="u-form-group u-form-group-4">
                      <b><span id="confirmPassError" style="text-align: center;margin:auto;display:table;color:red;"></span></b>

                      <label for="text-1b73" class="u-label">Confirm Password:</label>
                      <input type="password" placeholder="XXXXXXXX" id="text-1b73" name="confirmPass" required="" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-50 u-white">
                    </div>
                    <div class="u-align-center u-form-group u-form-submit u-label-top">
                      <input type="submit" name="reg_user" value="Register" class="u-active-black u-border-none u-btn u-btn-round u-btn-submit u-button-style u-hover-palette-2-base u-palette-1-base u-radius-50 u-btn-1">
                    </div>
                  </form>
                </div>
                <?php
                if (isset($_SESSION["currentUserId"])) {
                  echo "<a href='logout.php' class='u-border-none u-border-palette-1-base u-btn u-button-style u-none u-text-active-black u-text-hover-palette-2-base u-text-palette-1-base u-btn-2'>Log out to log in to a newly registered account!</a>";
                } else {
                  echo "<a href='login.php' class='u-border-none u-border-palette-1-base u-btn u-button-style u-none u-text-active-black u-text-hover-palette-2-base u-text-palette-1-base u-btn-2'>Already have an Account?</a>";
                }
                ?>
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