<?php include "../include/dbConfig.php";

authCheck('admin','login');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Project | Officer Panel - Zila Vikash Manch</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>

<body class="bg-light">
    <?php include "../include/navbar.php"; ?>
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-2 bg-dark" style="height:92.5vh">
                <?php include "../include/side.php";?>
            </div>
            <div class="col-10 p-4">
                <div class="row">
                    <div class="col-8 h4">Manage Notifications</div>
                    <div class="col-4">
                        <a href="addNotification.php" class="btn btn-dark float-end me-5">Add Notification</a>
                    </div>
                </div>
                <table class="table mt-3">
                    <tr>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                    <?php
                     $callingNotifications = mysqli_query($connect,"select * from notifications");
                     while ($row = mysqli_fetch_array($callingNotifications)) { ?>
                    <tr>
                        <td><?= $row['n_category'];?></td>
                        <td class="text-truncate"><?= $row['n_description'];?></td>
                        <td>
                            <?php
                             if ($row['status']==1): ?>
                            <a href="manageNotification.php?status=<?=$row['status'];?>&n_id=<?=$row['n_id'];?>">
                                <span class="badge bg-success text-white">Open</span>
                            </a>
                            <?php else: ?>
                            <a href="manageNotification.php?status=<?=$row['status'];?>&n_id=<?=$row['n_id'];?>">
                                <span class="badge bg-dark text-white">Close</span>
                            </a>
                            <?php endif;?>
                        </td>
                        <td><?= date("d-M-Y",strtotime($row['date']));?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>
<?php
  
  if (isset($_GET['status'])) {
      $status = $_GET['status'];
      $e_id = $_GET['n_id'];


      if ($status==0) {
          $query = "update notifications set status='1' where n_id='$e_id'";
      }
      elseif ($status==1) {
        $query = "update notifications set status='0' where n_id='$e_id'";
      }

      $run = mysqli_query($connect,$query);
      if ($run) {
          redirect("manageNotification");
      }
  }

?>