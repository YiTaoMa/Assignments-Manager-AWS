<?php
session_start();
?>
<!DOCTYPE html>
<html style="font-size: 16px;">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <meta name="keywords" content="​Welcome to your very own assignment manager, Ethan!, ​INSERT, ​Send an Email, SEARCH, ​The main actions you can do here">
  <meta name="description" content="">
  <meta name="page_type" content="np-template-header-footer-from-plugin">
  <title>manager</title>
  <link rel="stylesheet" href="nicepage.css" media="screen">
  <link rel="stylesheet" href="manager.css" media="screen">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <meta name="generator" content="Nicepage 4.6.5, nicepage.com">
  <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
  <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
  <style>
    #paddingButtonDel {
      margin-bottom: 10px;
    }
  </style>
  <script language="javascript" type="text/javascript">
    function removeSpacesTrim(string) {
      return string.trim();
    }
    $(document).ready(function() { //auto load when page start
      var limit = 1;
      $.ajax({ // facts API using Get request
        method: 'GET',
        url: 'https://api.api-ninjas.com/v1/facts?limit=' + limit,
        headers: {
          'X-Api-Key': 'Your API Key'
        },
        contentType: 'application/json',
        success: function(result) { // this is a json array
          // we always require 1 fact from api so always index 0 in array
          var fact = result[0]['fact'];
          $("#fact").html(fact);
        },
        error: function ajaxError(jqXHR) {
          console.error('Error: ', jqXHR.responseText);
        }
      });
    });
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
  <meta property="og:title" content="manager">
  <meta property="og:type" content="website">
</head>
<?php
if ($_SESSION["user_name"]) {
  $currentUserId = $_SESSION["currentUserId"];
?>

  <body class="u-body u-xl-mode">
    <?php require_once("includes/fragment/header.php"); ?>
    <section class="u-clearfix u-image u-section-1" id="sec-147a" data-image-width="1980" data-image-height="1114">
      <div class="u-clearfix u-sheet u-sheet-1">
        <?php echo '<h2 class="u-align-center u-custom-font u-font-montserrat u-text u-text-1">Welcome to your very own Assignment Manager, ' . $_SESSION["user_name"] . '!</h2>' ?>
        <br>
        <h5 style="text-align: center;color: #c24fd6;"><b>Interesting Facts</b></h5>
        <h5 style="text-align: center;color: #c24fd6;" id="fact"></h5>
        <?php
        if (isset($_SESSION['insertSuccess'])) { // if captured this session variable means insert success
          echo '<b><h4 style="color:green;text-align:center;">' . $_SESSION['insertSuccess'] . '</h4></b>'; //这里两个“.”注意 因为是变量，所以需要"."
          unset($_SESSION['insertSuccess']); //used then unset
        }
        if (isset($_SESSION["emailSentStatus"])) {
          echo '<b><h4 style="color:green;text-align:center;">' . $_SESSION["emailSentStatus"] . '</h4></b>';
          unset($_SESSION["emailSentStatus"]);
        }
        if (isset($_SESSION['deleteSuccess'])) {
          echo '<b><h4 style="color:green;text-align:center;">' . $_SESSION['deleteSuccess'] . '</h4></b>';
          unset($_SESSION['deleteSuccess']);
        }
        if (isset($_SESSION['updateSuccess'])) {
          echo '<b><h4 style="color:green;text-align:center;">' . $_SESSION['updateSuccess'] . '</h4></b>';
          unset($_SESSION['updateSuccess']);
        }
        ?>
        <h2 class="u-text u-text-2">SEARCH</h2>
        <p class="u-align-center u-text u-text-3"> Leave it blank and click the "Search" button to display all your assignments! ​Or enter what you want to search for and click the search button</p>
        <div class="u-form u-form-1">
          <form action="" method="POST" class="u-clearfix u-form-horizontal u-form-spacing-10 u-inner-form" source="custom" name="form" style="padding: 10px;">
            <div class="u-form-email u-form-group">
              <label for="email-ee12" class="u-form-control-hidden u-label"></label>
              <input type="text" id="email-ee12" name="searchInput" onblur="this.value=removeSpacesTrim(this.value);" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-20 u-white" placeholder="Enter something to search">
            </div>
            <div class="u-align-center u-form-group u-form-submit">
              <input type="submit" value="Search" name="searchSubmit" class="u-active-black u-border-none u-btn u-btn-round u-btn-submit u-button-style u-hover-palette-2-base u-palette-1-base u-radius-50 u-btn-1" />
            </div>
        </div>
        <div class="u-expanded-width-lg u-expanded-width-xl u-table u-table-responsive u-table-1">
          <table class="u-table-entity">
            <colgroup>
              <col width="14.3%">
              <col width="14.3%">
              <col width="14.3%">
              <col width="14.3%">
              <col width="14.3%">
              <col width="14.5%">
              <col width="14.000000000000004%">
            </colgroup>
            <thead class="u-align-center u-palette-4-base u-table-header u-table-header-1">
              <tr style="height: 113px;">
                <th class="u-border-3 u-border-palette-4-base u-table-cell u-table-cell-1"> Assignment No.</th>
                <th class="u-border-3 u-border-palette-4-base u-table-cell u-table-cell-2"> Assignment Name</th>
                <th class="u-border-3 u-border-palette-4-base u-table-cell u-table-cell-3"> Assignment Category</th>
                <th class="u-border-3 u-border-palette-4-base u-table-cell u-table-cell-4"> Assignment Due date</th>
                <th class="u-border-3 u-border-palette-4-base u-table-cell u-table-cell-5">Assignment Note</th>
                <th class="u-border-3 u-border-palette-4-base u-table-cell u-table-cell-6">Assignment Status</th>
                <th class="u-border-3 u-border-palette-4-base u-table-cell u-table-cell-7">Operations</th>
              </tr>
            </thead>
            <tbody class="u-table-body u-white u-table-body-1">
              <?php
              include_once('includes/fragment/databaseConnection.php');
              $noRecordAtAll = "";
              $notFoundSearch = "";
              //2 situations, 1 is user clicks search, another one is not clicks the search,if clicks, display the content the user searched for, else display this user's whole records if have any.
              if (empty($_POST["searchSubmit"])) { //if not click the search
                $res = mysqli_query($mysqli, "select id,name,category,due_date,note,status from assignment where user_id=$currentUserId order by due_date"); //全结果集//$res 为返回的结果集 
                if (mysqli_num_rows($res) == 0) {
                  $noRecordAtAll = "You don't have any assignment records yet ~ please click the ‘Insert’ button to start your journey!";
                }
              } else { //clicks the search
                $sanitizedSearchForStatus = "";
                $searchInput = $_POST["searchInput"]; //get user input
                // assignment id and user id in the database should not be visible to the user
                if (strpos(strtolower("To Do"), strtolower($searchInput)) !== false) { //$searchInput exists in "To Do"
                  $sanitizedSearchForStatus = 0;
                } else if (strpos(strtolower("ToDo"), strtolower($searchInput)) !== false) {
                  $sanitizedSearchForStatus = 0;
                } else if (strpos(strtolower("Completed"), strtolower($searchInput)) !== false) { //$searchInput exists in "Completed"
                  $sanitizedSearchForStatus = 1;
                } else {
                  $sanitizedSearchForStatus = $searchInput;
                }
                $res = mysqli_query($mysqli, "
					select id,name,category,due_date,note,status from 
					( select id,name,category,due_date,note,status 
					from assignment where user_id=$currentUserId ) 
					AS alias 
					where name like '%$searchInput%' or category like '%$searchInput%' or due_date like '%$searchInput%'or note like '%$searchInput%' or status like '%$sanitizedSearchForStatus%' order by due_date
					"); //get result set
                if (mysqli_num_rows($res) == 0) { // if nothing returned, means searched content not found
                  $notFoundSearch = "The content you searched for was not found ~ please try searching for other content!";
                }
              }
              if (mysqli_num_rows($res) == 0 && !empty($noRecordAtAll)) {
                //then display message
                $_SESSION['nothingFound'] = $noRecordAtAll;
              } else if (mysqli_num_rows($res) == 0 && !empty($notFoundSearch)) {
                //then display message
                $_SESSION['nothingFound'] = $notFoundSearch;
              }
              $incrementAssNum = 1;

              while ($row = mysqli_fetch_array($res)) { //for each row in the result set
                echo '<tr style="height: 67px;">';

                $dateColor = "black";
                $currentDate = date('Y-m-d');
                $oneWeekAfterToday = strtotime('+1 week', strtotime($currentDate));
                $sanitizedOneWeekAfterToday = date("Y-m-d", $oneWeekAfterToday);
                if ($row[3] <= $sanitizedOneWeekAfterToday && $row[3] >= $currentDate && $row[5] != 1) { //if the due date is between today and the date that 1 week after today
                  $dateColor = "red";
                }

                $sanitizedRow4VarNotes = "";
                $sanitizedRow5VarStatus = "";
                if (empty($row[4])) {
                  $sanitizedRow4VarNotes = "Nothing here~";
                } else {
                  $sanitizedRow4VarNotes = $row[4];
                }
                if ($row[5] == 0) { // 0 means false not completed the assignments
                  $sanitizedRow5VarStatus = "To Do";
                } else {
                  $sanitizedRow5VarStatus = "Completed";
                }

                echo "<td class='u-border-1 u-border-grey-30 u-first-column u-grey-5 u-table-cell u-table-cell-8'>
              $incrementAssNum</td>
              <td class='u-border-1 u-border-grey-30 u-table-cell'>$row[1]</td>
              <td class='u-border-1 u-border-grey-30 u-table-cell'>$row[2]</td>
              <b><td style='color:$dateColor;' class='u-border-1 u-border-grey-30 u-table-cell'>$row[3]</td></b>
				<td class='u-border-1 u-border-grey-30 u-table-cell'>
				$sanitizedRow4VarNotes
				</td>
				<td class='u-border-1 u-border-grey-30 u-table-cell'>
        $sanitizedRow5VarStatus</td>
			  <td class='u-border-1 u-border-grey-30 u-table-cell'>
			  <input id='paddingButtonDel' type='submit' class='u-active-black u-border-none u-btn u-btn-round u-btn-submit u-button-style u-hover-palette-2-base u-palette-1-base u-radius-50 u-btn-1' name='delsub$row[0]' value='Delete' /> 
        <input type='submit' class='u-active-black u-border-none u-btn u-btn-round u-btn-submit u-button-style u-hover-palette-2-base u-palette-1-base u-radius-50 u-btn-1' name='upsub$row[0]' value='Update' />
			  </td>";
                //first echo finish above
                echo '</tr>';
                // -------------------------------------------
                if (!empty($_POST["upsub$row[0]"])) { //if click current update button associated with current row
                  $_SESSION['updateRow'] = $row; // used in update.php
                  echo '<script>
						location.href="update.php";
					</script>';
                }

                if (!empty($_POST["delsub$row[0]"])) { //if clicked delete button associated with current row (current assignment record)
                  $_SESSION['delSID'] = $row[0]; // used in del.php
                  // below ask user if want to delete, if yes go to del.php
                  echo '<script>
				 if (confirm("Are you sure you want to permanently delete this Assignment record?") == true){
				 	location.href="del.php";
				 }
			     </script>';
                }
                $incrementAssNum++;
              }
              $mysqli->close();
              ?>
            </tbody>
          </table>
          <?php
          if (isset($_SESSION['nothingFound'])) {
            echo '<b><h4 style="color:blue;text-align:center;">' . $_SESSION['nothingFound'] . '</h4></b>';
            unset($_SESSION['nothingFound']);
          }
          ?>
        </div>
        </form>
        <div class="u-clearfix u-expanded-width u-gradient u-layout-wrap u-layout-wrap-1">
          <div class="u-layout">
            <div class="u-layout-row">
              <div class="u-container-style u-layout-cell u-size-30 u-layout-cell-1">
                <div class="u-container-layout u-container-layout-1">
                  <h2 class="u-text u-text-default u-text-4"> INSERT</h2>
                  <p class="u-align-center u-text u-text-5"> Don't have any assignment records yet? Want to insert a new assignment record? Insert your new assignment by clicking on the "Insert button" below!</p>
                  <input style="padding: 10px 27px;margin-left:200px;margin-top:29px;" type="button" value="Insert" name="insertButton" class="u-active-black u-border-none u-btn u-btn-round u-btn-submit u-button-style u-hover-palette-2-base u-palette-1-base u-radius-50 u-btn-1" onClick="location.href='insert.php'" />
                </div>
              </div>
              <div class="u-container-style u-layout-cell u-size-30 u-layout-cell-2">
                <div class="u-container-layout u-container-layout-2">
                  <h2 class="u-text u-text-default u-text-6"> Send an Email</h2>
                  <p class="u-align-center u-text u-text-7"> Want to know which assignments you need to submit in the coming week? Want to see them more easily via email?<br>With just one click, all the assignments you need to submit in the coming week will be delivered to your email address!<br>
                  </p>
                  <input style="padding: 10px 27px;margin-left:170px;" type="button" value="Send an Email" name="sendEmailButton" class="u-active-black u-border-none u-btn u-btn-round u-btn-submit u-button-style u-hover-palette-2-base u-palette-1-base u-radius-50 u-btn-1" onClick="location.href='mailPhpMailer.php'" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="u-align-center u-clearfix u-image u-section-2" id="carousel_8ad5" data-image-width="1980" data-image-height="1114">
      <div class="u-clearfix u-sheet u-sheet-1">
        <h2 class="u-text u-text-1"> The main actions you can do here</h2>
        <div class="u-list u-list-1">
          <div class="u-repeater u-repeater-1">
            <div class="u-align-left u-border-9 u-border-no-bottom u-border-no-right u-border-no-top u-border-palette-1-base u-container-style u-list-item u-radius-20 u-repeater-item u-shape-round u-white u-list-item-1">
              <div class="u-container-layout u-similar-container u-container-layout-1">
                <div class="u-image u-image-circle u-image-1" alt="" data-image-width="1280" data-image-height="1280"></div>
                <h4 class="u-custom-font u-font-montserrat u-text u-text-default u-text-2">Search your assignments</h4>
                <p class="u-text u-text-3"> Simply enter what you are searching for and click the search button to return assignments related to what you are searching for!</p>
              </div>
            </div>
            <div class="u-align-left u-border-9 u-border-no-bottom u-border-no-right u-border-no-top u-border-palette-1-base u-container-style u-list-item u-radius-20 u-repeater-item u-shape-round u-video-cover u-white u-list-item-2">
              <div class="u-container-layout u-similar-container u-container-layout-2">
                <div class="u-image u-image-circle u-image-2" alt="" data-image-width="1280" data-image-height="1280"></div>
                <h4 class="u-custom-font u-font-montserrat u-text u-text-default u-text-4">Add a new assignment</h4>
                <p class="u-text u-text-5"> Just tap the insert button, fill in the required content, submit it and it will be displayed in your manager!</p>
              </div>
            </div>
            <div class="u-align-left u-border-9 u-border-no-bottom u-border-no-right u-border-no-top u-border-palette-1-base u-container-style u-list-item u-radius-20 u-repeater-item u-shape-round u-video-cover u-white u-list-item-3">
              <div class="u-container-layout u-similar-container u-container-layout-3">
                <div class="u-image u-image-circle u-image-3" alt="" data-image-width="1280" data-image-height="970"></div>
                <h4 class="u-custom-font u-font-montserrat u-text u-text-default u-text-6">Update an assignment</h4>
                <p class="u-text u-text-7"> Simply click the Update button, change what needs to be changed and click the Submit button to update your assignment information!</p>
              </div>
            </div>
            <div class="u-align-left u-border-9 u-border-no-bottom u-border-no-right u-border-no-top u-border-palette-1-base u-container-style u-list-item u-radius-20 u-repeater-item u-shape-round u-video-cover u-white u-list-item-4">
              <div class="u-container-layout u-similar-container u-container-layout-4">
                <div class="u-image u-image-circle u-image-4" alt="" data-image-width="1280" data-image-height="640"></div>
                <h4 class="u-custom-font u-font-montserrat u-text u-text-default u-text-8">Delete an assignment</h4>
                <p class="u-text u-text-9"> Simply click the Delete button next to the corresponding assignment record to delete the current assignment!</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php require_once("includes/fragment/footer.php"); ?>
    <script type="text/javascript" src="//xx.addthis.com/js/xxx/addthis_widget.js#pubid=xxxxxxxxxxx"></script>
  </body>
<?php
} else {
  header('location:login.php');
  exit();
}
?>

</html>