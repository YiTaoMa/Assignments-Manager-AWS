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
$notChangeAtAll = "";
$row = $_SESSION['updateRow'];
$currentUserId = $_SESSION["currentUserId"]; // if use can access hits page the user
//must already logged in because this page can only access thorough the manager.php
//and manager.php can only accessed by logged in user. it means the user id must exist in the session already.

if (!empty($_POST["upSubConfirm$row[0]"])) { //if user clicks update button
  $upAName = trim($_POST['upAName']);
  $upACategory = trim($_POST['upACategory']);
  $upDueDate = $_POST['upDueDate'];
  $upANotes = trim($_POST['upANotes']);
  $upAStatus = $_POST['upAStatus'];
  if ($upANotes == "Nothing here~") {
    $sanitizedUpANote = "";
  } else {
    $sanitizedUpANote = $upANotes;
  }
  if (
    $upAName == trim($row[1]) &&
    $upACategory == trim($row[2]) && $upDueDate == $row[3]
    && $sanitizedUpANote == trim($row[4]) && $upAStatus == $row[5]
  ) { // if user did not change anything
    $notChangeAtAll = "You have not change anything yet!";
  } else { // there are changes
    include_once('includes/fragment/databaseConnection.php');
    mysqli_query($mysqli, "update assignment set name='$upAName',category='$upACategory',due_date='$upDueDate',note='$sanitizedUpANote',status=$upAStatus where id=$row[0] and user_id=$currentUserId");
    $_SESSION['updateSuccess'] = 'Update successfully!';
    unset($_SESSION['updateRow']);
    $mysqli->close();
    header('location:manager.php');
    exit();
  }
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
  <title>update</title>
  <link rel="stylesheet" href="nicepage.css" media="screen">
  <link rel="stylesheet" href="update.css" media="screen">
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
  <meta property="og:title" content="update">
  <meta property="og:type" content="website">
</head>

<body class="u-body u-xl-mode">
  <?php require_once("includes/fragment/header.php"); ?>
  <section class="u-clearfix u-image u-section-1" id="sec-fec9" data-image-width="1980" data-image-height="1114">
    <div class="u-clearfix u-sheet u-sheet-1">
      <h1 class="u-align-center u-text u-text-default u-text-1"> Update your assignments information here</h1>
      <span style="margin:auto;display:table;color:red;"><b><?php if ($notChangeAtAll != "") {
                                                              echo $notChangeAtAll;
                                                            } ?></b></span>
      <div class="u-form u-form-1">
        <form action="" method="POST" class="u-clearfix u-form-spacing-20 u-form-vertical u-inner-form" name="updateForm" style="padding: 10px;">
          <?php
          $sanitizedRow4VarNotes = "";
          $sanitizedRow5VarStatus = "";
          $anotherStatus = "";
          $anotherStatusDatabaseValue = "";

          if (empty($row[4])) {
            $sanitizedRow4VarNotes = "Nothing here~";
          } else {
            $sanitizedRow4VarNotes = $row[4];
          }
          if ($row[5] == 0) {
            $sanitizedRow5VarStatus = "To Do";
          } else {
            $sanitizedRow5VarStatus = "Completed";
          }
          if ($sanitizedRow5VarStatus == 'To Do') {
            $anotherStatus = 'Completed';
          } else {
            $anotherStatus = 'To Do';
          }
          if ($anotherStatus == 'To Do') {
            $anotherStatusDatabaseValue = 0;
          } else {
            $anotherStatusDatabaseValue = 1;
          }

          echo "
        <div class='u-form-group u-form-name'>
        <label for='name-1948' class='u-label'>Assignment Name:</label>
        <input id='name-1948' type='text' name='upAName' class='u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-18 u-white' required onblur='this.value=removeSpacesTrim(this.value);' maxlength='100' placeholder='$row[1]' value='$row[1]' />
        </div>
         
        <div class='u-form-group u-form-group-2'>
        <label for='text-9923' class='u-label'>Assignment Category:</label>
        <input id='text-9923' class='u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-18 u-white' type='text' name='upACategory' required onblur='this.value=removeSpacesTrim(this.value);' maxlength='50' placeholder='$row[2]' value='$row[2]' />
        </div>

        <div class='u-form-date u-form-group u-form-group-3'>
        <label for='date-494f' class='u-label'>Assignment Due Date:</label>
        <input id='date-494f' class='u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-18 u-white' type='date' required onkeydown='return false' min='1970-01-01' max='2122-01-31' name='upDueDate' placeholder='$row[3]' value='$row[3]'>
        </div>
 
        <div class='u-form-group u-form-textarea u-form-group-4'>
        <label for='textarea-8fcc' class='u-label'>Assignment Notes:</label>
        <textarea rows='4' cols='50' id='textarea-8fcc' name='upANotes'  class='u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-18 u-white' onblur='this.value=removeSpacesTrim(this.value);' maxlength='200' placeholder='$sanitizedRow4VarNotes'>$sanitizedRow4VarNotes</textarea>
        </div>
        
        <div class='u-form-group u-form-select u-form-group-5'>
        <label for='upAStatus' class='u-label'>Assignment Status:</label>
        <div class='u-form-select-wrapper'>
          <select id='select-4103' name='upAStatus' class='u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-18 u-white' required>
            <option value='$row[5]' selected>$sanitizedRow5VarStatus</option>
            <option value='$anotherStatusDatabaseValue'>$anotherStatus</option>
          </select>
          <svg xmlns='http://www.w3.org/2000/svg' width='14' height='12' version='1' class='u-caret'><path fill='currentColor' d='M4 8L0 4h8z'></path></svg>
        </div>
      </div>
       
      <div class='u-align-left u-form-group u-form-submit'>
      <input type='submit' class='u-active-black u-border-none u-btn u-btn-round u-btn-submit u-button-style u-hover-palette-2-base u-palette-1-base u-radius-50 u-btn-1' value='Confirm to Update' name='upSubConfirm$row[0]'/>
    </div> 
        ";
          ?>
        </form>
      </div>
      <a href="manager.php" style="margin-left:690px;" class="u-active-none u-align-center u-border-2 u-border-palette-1-base u-bottom-left-radius-0 u-bottom-right-radius-0 u-btn u-btn-rectangle u-button-style u-hover-none u-none u-radius-0 u-text-active-black u-text-hover-palette-2-base u-top-left-radius-0 u-top-right-radius-0 u-btn-2">Back to Manager<span style="font-weight: 700;"></span>
      </a>
    </div>
  </section>
  <?php require_once("includes/fragment/footer.php"); ?>
</body>

</html>