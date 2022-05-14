<?php
if (!isset($_SERVER['HTTP_REFERER'])) { //prevent user access the page through url
  echo "<body style='background-color:powderblue;text-align:center;'>";
  echo "<div>";
  echo "<h1>Access Denied!</h1>";
  echo "<br>";
  echo "<h1>Redirecting you to the main page in 3 seconds...</h1>";
  echo "</div>";
  echo "<img src='images/lock.jpg' style='background-color:powderblue;' alt='access denied' width='660' height='345'>";
  echo "</body>";
  header("refresh:3; url=index.php");
  exit;
}
session_start();
if (!empty($_POST["insertSub"])) { //if the user click the insert button
  $currentUserId = $_SESSION["currentUserId"];
  include_once('includes/fragment/databaseConnection.php');
  $insertAName = trim($_POST['insertAName']);
  $insertACategory = trim($_POST['insertACategory']);
  $insertDueDate = $_POST['insertDueDate'];
  $insertANotes = trim($_POST['insertANotes']);
  $insertAStatus = $_POST['insertAStatus'];

  mysqli_query($mysqli, "insert assignment (user_id,name,category,due_date,note,status) values ($currentUserId,'$insertAName','$insertACategory','$insertDueDate','$insertANotes',$insertAStatus)");
  $_SESSION['insertSuccess'] = 'Inserted successfully!';
  $mysqli->close();
  header('location:manager.php');
  exit();
}
?>
<!DOCTYPE html>
<html style="font-size: 16px;">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <meta name="keywords" content="​Insert a new Assignment Record here">
  <meta name="description" content="">
  <meta name="page_type" content="np-template-header-footer-from-plugin">
  <title>insert</title>
  <link rel="stylesheet" href="nicepage.css" media="screen">
  <link rel="stylesheet" href="insert.css" media="screen">
  <meta name="generator" content="Nicepage 4.6.5, nicepage.com">
  <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
  <script language="javascript" type="text/javascript">
    function removeSpacesTrim(string) {
      return string.trim();
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
  <meta property="og:title" content="insert">
  <meta property="og:type" content="website">
</head>

<body class="u-body u-xl-mode">
  <?php require_once("includes/fragment/header.php"); ?>
  <section class="u-clearfix u-image u-section-1" id="sec-fec9" data-image-width="1980" data-image-height="1114">
    <div class="u-clearfix u-sheet u-sheet-1">
      <h1 class="u-align-center u-text u-text-default u-text-1"> Insert a new Assignment Record here</h1>
      <div class="u-form u-form-1">
        <form action="" method="POST" class="u-clearfix u-form-spacing-22 u-form-vertical u-inner-form" name="insertForm" style="padding: 10px;">
          <div class="u-form-group u-form-name">
            <label for="name-1948" class="u-label">Assignment Name:</label>
            <input type="text" placeholder="A1 for Cloud" id="name-1948" name="insertAName" onblur="this.value=removeSpacesTrim(this.value);" maxlength="100" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-18 u-white" required="">
          </div>
          <div class="u-form-group u-form-group-2">
            <label for="text-9923" class="u-label">Assignment Category:</label>
            <input type="text" id="text-9923" name="insertACategory" onblur="this.value=removeSpacesTrim(this.value);" maxlength="50" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-18 u-white" placeholder="Cloud Computing" required="required">
          </div>
          <div class="u-form-date u-form-group u-form-group-3">
            <label for="date-494f" class="u-label">Assignment Due Date:</label>
            <input type="date" placeholder="YYY-MM-DD" id="date-494f" name="insertDueDate" onkeydown="return false" min="1970-01-01" max="2122-01-31" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-18 u-white" required="">
          </div>
          <div class="u-form-group u-form-textarea u-form-group-4">
            <label for="textarea-8fcc" class="u-label">Assignment Notes:</label>
            <textarea rows="4" cols="50" id="textarea-8fcc" name="insertANotes" onblur="this.value=removeSpacesTrim(this.value);" maxlength="200" placeholder="Enter your notes here... Or leave it blank..." class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-18 u-white"></textarea>
          </div>
          <div class="u-form-group u-form-select u-form-group-5">
            <label for="select-4103" class="u-label">Assignment Status:</label>
            <div class="u-form-select-wrapper">
              <select id="select-4103" name="insertAStatus" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-18 u-white" required="required">
                <option value='0' selected>To Do</option>
                <option value='1'>Completed</option>
              </select>
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" version="1" class="u-caret">
                <path fill="currentColor" d="M4 8L0 4h8z"></path>
              </svg>
            </div>
          </div>
          <div class="u-align-left u-form-group u-form-submit">
            <input type="submit" name="insertSub" value="Insert" class="u-active-black u-border-none u-btn u-btn-round u-btn-submit u-button-style u-hover-palette-2-base u-palette-1-base u-radius-50 u-btn-1">
            <input style="margin-left:25px;" type="reset" value="Reset" class="u-active-black u-border-none u-btn u-btn-round u-btn-submit u-button-style u-hover-palette-2-base u-palette-1-base u-radius-50 u-btn-1">
          </div>
        </form>
      </div>
      <a href="manager.php" class="u-active-none u-border-2 u-border-palette-1-base u-bottom-left-radius-0 u-bottom-right-radius-0 u-btn u-btn-rectangle u-button-style u-hover-none u-none u-radius-0 u-text-active-black u-text-hover-palette-2-base u-top-left-radius-0 u-top-right-radius-0 u-btn-3">Back to Manager<span style="font-weight: 700;"></span>
      </a>
    </div>
  </section>
  <?php require_once("includes/fragment/footer.php"); ?>
</body>

</html>