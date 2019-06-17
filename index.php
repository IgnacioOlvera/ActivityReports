<?php
require './components/User.php';
session_start();
if (!$_SESSION['user']) {
    header("Location: ./view/login.php");
} else {
    require './components/allowedReports.php';
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="./view/images/favicon.png" type="image/x-icon" />
        <link rel="stylesheet" href="./view/css/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="./view/css/custom.css">
        <link rel="stylesheet" href="./view/css/tree-table/css/jquery.treetable.css">
        <link rel="stylesheet" href="./view/css/tree-table/css/jquery.treetable.theme.default.css">
        <link rel="stylesheet" href="./view/jquery-confirm/css/jquery-confirm.css">
        <title>Sistema De Gestión</title>
    </head>

    <body>
        <!-- Modal -->
        <div class="modal" id="addReportModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Heading</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form id="AddFile" method="POST" action="./components/upload_file.php" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="TypeReport">Select Report:</label>
                                <select name="TypeReport" class="form-control" id="TypeReport"></select>
                            </div>
                            <div class="form-group">
                                <label for="ActivityDate">Activity Date: </label>
                                <input type="date" class="form-control" type="datetime" name="ActivityDate" id="ActivityDate">
                            </div>

                            <label for="overwrite">Overwrite:</label><input type="checkbox" value="1" name="overwrite" id="overwrite">

                            <div class="form-group">
                                <label for="File">File to Load: </label>
                                <input type="file" class="form-control" name="uploadedFile" id="file">
                            </div>
                            <input type="submit" id="sendFile" name="uploadBtn" class="btn btn-primary" value="Upload" />
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
        <!-- Fin Modal -->
        <div class="wrapper">
            <!-- Sidebar -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>QMC Activity Reports</h3>
                    <h2>My Reports</h2>
                </div>
                <ul class="list-unstyled components" id="contentAllow">
                    <?php echo $reports; ?>
                </ul>
            </nav>
            <div class="container-fluid">
                <div class="content">
                    <div class="row">
                        <div class="col-md-11">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php">My Reports</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="./view/users.php">Users</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="./view/reports.php">Reports</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-1">
                            <ul class=" nav nav-tabs">
                                <li>
                                    Hello, <?php echo $_SESSION['user']->username ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-11">
                                    <h3 id="title">Reports</h3>
                                </div>
                                <div id="openModal" class="col-md-1">
                                    <button class="btn btn-success" data-toggle="modal" data-target="#addReportModal">Add File +</button>
                                </div>
                            </div>
                        </div>
                        <center><label><a href="#" id="collapse">Collapse All</label> <label>|</label> <label><a href="#" id="expand">Expand All</label></a></center>
                        <div class="card-body" id="reportsContainer">
                            <h1>No Report Selected</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Custom Theme Scripts -->
            <script src="./scripts/jquery.js"></script>
            <script src="./view/css/bootstrap/js/bootstrap.js"></script>
            <script src="./view/jquery-confirm/js/jquery-confirm.js"></script>
            <script src="./view/css/tree-table/jquery.treetable.js"></script>
            <script src="./scripts/scripts.js"></script>
            <script src="./scripts/notify.js"></script>
            <script>
                MyReports();
                $.ajax({
                    url: './components/listReports.php',
                    success: function(result) {
                        $('#TypeReport').html(result)
                    },
                    error: function() {
                        $.notify("An Error has occured");
                    }
                });
            </script>
            <?php
            if (isset($_GET['status']) && $_GET['status'] == 500) {
                ?>
                <script>
                    $.notify('<?php if (isset($_SESSION['message'])) echo $_SESSION['message']; ?>');
                </script>
            <?php
        }
        ?>
            <?php
            if (isset($_GET['status']) && $_GET['status'] == 200) {
                ?>
                <script>
                    $.notify('<?php if (isset($_SESSION['message'])) echo $_SESSION['message']; ?>', "success");
                </script>
            <?php
        }
        ?>
        </div>
    </body>


    </html>
<?php
}
?>