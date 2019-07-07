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
        <link rel="stylesheet" href="./css/tree-table/css/jquery.treetable.css">
        <link rel="stylesheet" href="./css/tree-table/css/jquery.treetable.theme.default.css">
        <link rel="stylesheet" href="../view/jquery-confirm/css/jquery-confirm.css">
        <title>Sistema De Gestión</title>
    </head>

    <body>

        <div class="wrapper">
            <!-- Sidebar -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>QMC Documents</h3>
                    <h4>Reports Manage</h4>
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
                            <div class="row">
                                <div class="panel col-md-6">
                                    <div class="card-header">
                                        <h3>Add Report</h3>
                                    </div>
                                    <form id="AddReport" action="../components/AddReport.php" method="post">
                                        <div class="d-flex flex-column">
                                            <div class="form-group p-2">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="name">Report Name:</label>
                                                        <input type="text" id="ReportName" name="name" class="form-control" plaseholder="Name" require>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="name">Customer</label>
                                                        <input list="customers" id="customer" class="form-control" name="customer" />
                                                        <datalist id="customers">
                                                        </datalist>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-groups p-2">
                                                <button type="submit" id="submitAddReport" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                    <form id="NewName">
                                        <div class="d-flex flex-column">
                                            <div class="form-group p-2">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="name">New Report Name:</label>
                                                        <input type="text" id="NewReportName" name="NewReportName" class="form-control" plaseholder="Name" require>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="name">Customer</label>
                                                        <input list="customers" id="NewCustomer" class="form-control" name="customer" />
                                                        <datalist id="NewCustomers">
                                                        </datalist>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-groups p-2">
                                            <button type="submit" id="submitNewName" disabled="true" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3>Reports</h3>
                                        </div>
                                        <div class="card-body" id="reportsCatalog" style="color:blue">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Custom Theme Scripts -->
            <script src="../scripts/jquery.js"></script>
            <script src="./css/bootstrap/js/bootstrap.js"></script>
            <script src="./css/tree-table/jquery.treetable.js"></script>
            <script src="../view/jquery-confirm/js/jquery-confirm.js"></script>
            <script src="../scripts/scripts.js"></script>
            <script src="../scripts/notify.js"></script>
            <script>
                Reports();
            </script>
            <?php
            if (isset($_GET['status']) && $_GET['status'] == 500) {
                ?>
                <script>
                    $.notify('<?php if (isset($_SESSION['
                message '])) echo $_SESSION['
                message ']; ?>');
                </script>
            <?php
            }
            ?>
            <?php
            if (isset($_GET['status']) && $_GET['status'] == 200) {
                ?>
                <script>
                    $.notify('<?php if (isset($_SESSION['
                message '])) echo $_SESSION['
                message ']; ?>', "success");
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