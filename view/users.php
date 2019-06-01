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
                    <h3>QMC Activity Reports</h3>
                    <h2>Users</h2>
                </div>

                <ul class="list-unstyled components" id="contentAllow">
                    <li>
                        <a data-target="#AddUserPanel">Add Users</a>
                    </li>
                    <li>
                        <a data-target="#ModSearUser">Modify / Search Users</a>
                    </li>
                    <li>
                        <a data-target="#UserPermission">User Permissions</a>
                    </li>
                </ul>
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
                                    <button class="btn btn-warning">Log out</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="panel col-md-6" id="AddUserPanel">
                                <div class="card-header">
                                    <h3>Add User</h3>
                                </div>
                                <form id="AddUser">
                                    <div class="d-flex flex-column">
                                        <div class="form-group p-2">
                                            <label for="name">Name:</label>
                                            <input type="text" id="name" name="name" class="form-control" plaseholder="Name" require>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="username">Username:</label>
                                            <input type="text" id="username" name="username" class="form-control" plaseholder="Username" require>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="email">Email:</label>
                                            <input type="email" id="email" name="email" class="form-control" plaseholder="Email" require>
                                        </div>
                                        <div class="form-group p-2">
                                            <label for="pass">Password: </label>
                                            <input type="text" id="pass" name="pass" class="form-control" plaseholder="Password" require>
                                            <span>Provide this password to the new user*</span>
                                        </div>
                                        <div class="form-groups p-2">
                                            <button type="submit" id="submitAddUser" class="btn btn-primary">Submit</button>
                                        </div>
                                        <label id="label"></label>
                                    </div>
                                </form>
                            </div>
                            <div class="panel" id="ModSearUser" style="display: none">
                                <div class="card-header">
                                    <h3>Username Search</h3>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div>
                                            <form id="SearchUser">
                                                <div class="form-group">
                                                    <label for="name">Username:</label>
                                                    <input type="text" id="findusername" name="name" class="form-control" plaseholder="Username" require>
                                                </div>
                                                <div class="form-groups pull-right">
                                                    <button id="search" class="btn btn-primary">Search</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div>
                                            <form id="ResultUser">
                                                <div class="form-group">
                                                    <label for="name">Name:</label>
                                                    <input type="text" id="foundName" name="name" class="form-control" plaseholder="Name" require>
                                                </div>
                                                <div class="form-group p-2">
                                                    <label for="username">Username:</label>
                                                    <input type="text" id="foundUsername" name="username" class="form-control" plaseholder="Username" require>
                                                </div>
                                                <div class="form-group p-2">
                                                    <label for="email">Email:</label>
                                                    <input type="email" id="foundEmail" name="email" class="form-control" plaseholder="Email" require>
                                                </div>
                                                <div class="form-group p-2">
                                                    <label for="pass">Password: </label>
                                                    <input type="password" id="foundPass" name="pass" class="form-control" plaseholder="Password" require>
                                                    <input type="button" id='resetPass' value="Reset Password">
                                                    <label id="aviso"></label>
                                                </div>
                                                <input type="checkbox" data-val='1' id="active"><label>Active</label>
                                                <input type="checkbox" data-val='0' id="inactive"><label>Deactive</label>
                                                <div class="form-groups p-2">
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3>User List</h3>
                                            </div>
                                            <div class="card-body">
                                                <div style="color:blue" id="UserList"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="panel" id="UserPermission" style='display:none'>
                                <form id="UserPermissionForm">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3>User Permissions</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="name">Username:</label>
                                                <input type="text" id="NamePermission" name="name" class="form-control" plaseholder="Username" require>
                                                <button class="btn btn-primary" type='submit'>Search User </button>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Available Reports</h5>
                                                        </div>
                                                        <div id="AvailabledReports" class="card-body"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Allow Reports</h5>
                                                        </div>
                                                        <div id="UserAllowedReposts" class="card-body">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Custom Theme Scripts -->
            <script src="../scripts/jquery.js"></script>
            <script src="./css/bootstrap/js/bootstrap.js"></script>
            <script src="./css/tree-table/jquery.treetable.js"></script>
            <script src="../scripts/scripts.js"></script>
            <script src="../scripts/notify.js"></script>
            <script src="../view/jquery-confirm/js/jquery-confirm.js"></script>
            <script>
                Users();
            </script>
        </div>
    </body>


    </html>
<?php
}
?>