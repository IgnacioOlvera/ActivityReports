 <?php
    require '../components/User.php';
    session_start();

    if (!$_SESSION['user']) {
        header("Location: ../view/login.php");
    } else {
        require '../components/allowedReports.php'
        ?>
     <!DOCTYPE html>
     <html lang="en">

     <head>
         <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
         <!-- Meta, title, CSS, favicons, etc. -->
         <meta charset="utf-8">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <link rel="icon" href="./images/favicon.png" type="image/x-icon" />
         <link rel="stylesheet" href="./css/bootstrap/css/bootstrap.css">
         <link rel="stylesheet" href="./css/custom.css">
         <title>Sistema De Gestión</title>
     </head>

     <body>

         <div class="wrapper">
             <!-- Sidebar -->
             <nav id="sidebar">
                 <div class="sidebar-header">
                     <h3>QMC Activity Reports</h3>
                 </div>
             </nav>
             <div class="container-fluid">
                 <div class="content">
                     <div class="row">
                         <div class="col-md-11">
                             <ul class="nav nav-tabs">
                                 <li class="nav-item">
                                     <a class="nav-link" href="../index.php">My Reports</a>
                                 </li>
                                 <li class="nav-item">
                                     <a class="nav-link" href="./users.php">Users</a>
                                 </li>
                                 <li class="nav-item">
                                     <a class="nav-link" href="./reports.php">Reports</a>
                                 </li>
                                 <li class="nav-item">
                                     <a class="nav-link" href="./feedback.php">Feddback</a>
                                 </li>
                             </ul>
                         </div>
                         <div class="col-md-1">
                             <ul class=" nav nav-tabs">
                                 <li>
                                     <a href="../components/logout.php"> Hello, <?php echo $_SESSION['user']->username ?></a>
                                 </li>
                             </ul>
                         </div>
                     </div>
                     <div class="card">
                         <div class="card-body">
                             <div class="card-header">
                                 <h3>Send Feedback</h3>
                             </div>
                             <form action="../components/sendFeedback.php?username=<?php echo $_SESSION['user']->id ?>" method="GET">
                                 <div class="form-group">
                                     <label for="comments">Feedback:</label>
                                     <textarea class="form-control" name="comments" id="comments" cols="30" rows="10"></textarea>
                                 </div>
                                 <input type="submit" value="Send Feedback" class="btn btn-success">
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- Custom Theme Scripts -->
             <script src="../scripts/jquery.js"></script>
             <script src="./css/bootstrap/js/bootstrap.js"></script>
         </div>
     </body>


     </html>
 <?php
    }
    ?>