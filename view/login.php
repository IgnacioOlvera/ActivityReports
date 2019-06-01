<!DOCTYPE html>
<html lang="sp">

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
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class=p-2>
                <img src="./images/QMC_LOGO.png" alt="QMC">
            </div>
        </div>
        <form id="login">
            <div class="d-flex flex-column ">
                <div class="form-group p-2">
                    <label for="username">Name:</label>
                    <input type="text" id="username" name="username" class="form-control" plaseholder="Username"
                        require>
                </div>
                <div class="form-group p-2">
                    <label for="pass">Password:</label>
                    <input type="password" id="pass" name="pass" class="form-control" plaseholder="Password" require>
                </div>
                <div class="form-groups p-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>


        </form>
        <p id="message"></p>
    </div>
    <!-- Custom Theme Scripts -->
    <script src="../scripts/jquery.js"></script>
    <script src="./css/bootstrap/js/bootstrap.min.js"></script>
    <script src="../scripts/scripts.js"></script>
    <script src="../scripts/notify.js"></script>
    <script>Login()</script>

</body>

</html>