function Login() {
    $('#login').on('submit', function (e) {
        e.preventDefault();
        var username = $("#username").val();
        var pass = $("#pass").val();
        $.ajax({
            data: { username: username, pass: pass },
            url: '../components/login.php',
            type: 'post',
            success: function (response) {
                window.location.href = "../index.php";
            },
            error: function () {
                $('#message').html('Usuario y/ contraseña incorrectos').css('color', 'red');
            }
        })
    });
}

function MyReports() {
    $('.reports').on('click', function () {
        reportId = $(this).data('reportid');
        $.ajax({
            data: { reportId: reportId },
            url: './components/getReports.php',
            type: 'post',
            success: function (response) {
                $('#reportsContainer').html(response);
                $("#ReportsTable").treetable({ expandable: true });
                $("#ReportsTable a").css({ 'color': 'blue', 'text-decoration': 'underline' });

                $('.delete').confirm({
                    title: 'Delete File',
                    content: 'Do you confirm this file deletion?',
                    buttons: {
                        confirm: function () {
                            location.href = this.$target.attr('href');
                        },
                        cancel: function () {

                        }
                    }
                });


            },
            error: function () {

            }
        })
    });



    $.ajax({
        url: './components/upload_file.php',
        success: function (result) {
            $('#TypeReport').html(result)
        },
        error: function () {
            $.notify("An Error has occured");
        }
    });

}

function Users() {
    let randomPass = Math.random().toString(36).slice(-8);
    $('#pass').val(randomPass);
    $.ajax({
        url: '../components/UserComponents/ListUsers.php',
        success: function (result) {
            $('#UserList').html(result);
            $('#list a').on('click', function () {
                $("#findusername").val($(this).data('target'))
                $.ajax({
                    data: { username: $(this).data('target') },
                    url: '../components/UserComponents/SearchUser.php',
                    type: 'post',
                    success: function (result) {
                        $('input[type="checkbox"]').prop('checked', false);
                        foundUser = JSON.parse(result);
                        $('#foundName').val(foundUser.name);
                        $('#foundUsername').val(foundUser.username);
                        $('#foundEmail').val(foundUser.email);
                        $('#foundPass').val('*****************');
                        (foundUser.active == 1) ? $('#active').trigger('click') : $('#inactive').trigger('click');
                    },
                    error: function () {
                        $.notify("An Error has occured");
                    }
                });
            });
        },
        error: function () {
            $.notify("An Error has occured");
        }
    });

    $('#submitAddUser').confirm(
        {
            title: 'Delete File',
            content: 'Do you confirm this file deletion?',
            buttons: {
                confirm: function () {
                    $('#AddUser').trigger('submit');
                },
                cancel: function () {

                }
            }
        }
    );

    $('#AddUser').on('submit', function (e) {
        var username = $("#username").val();
        var name = $("#name").val();
        var pass = $("#pass").val();
        let email = $('#email').val();
        $.ajax({
            data: { username: username, pass: pass, name: name, email: email },
            url: '../components/UserComponents/AddUser.php',
            type: 'post',
            success: function () {
                $.notify("User has been added successfully", "success");
            },
            error: function () {
                $.notify("An Error has occured");
            }
        });
        $('#AddUser input[type=text]').val("");
    });

    $('#contentAllow a').on('click', function () {
        $('.panel').hide();
        $($(this).data('target')).show();
    });
    $('#SearchUser').on('submit', function (e) {
        e.preventDefault();
        var username = $("#findusername").val() || $(this).data('target');
        $.ajax({
            data: { username: username },
            url: '../components/UserComponents/SearchUser.php',
            type: 'post',
            success: function (result) {
                $('input[type="checkbox"]').prop('checked', false);
                foundUser = JSON.parse(result);
                $('#foundName').val(foundUser.name);
                $('#foundUsername').val(foundUser.username);
                $('#foundEmail').val(foundUser.email);
                $('#foundPass').val('*****************');
                (foundUser.active == 1) ? $('#active').trigger('click') : $('#inactive').trigger('click');
            },
            error: function () {
                $.notify("An Error has occured");
            }
        });
    });
    $('#resetPass').on('click', function () {
        $.confirm({
            title: 'Password Reset',
            content: 'Do you confirm this password reset? ',
            buttons: {
                confirm: function () {
                    $.ajax({
                        data: { username: $('#foundUsername').val() },
                        url: '../components/UserComponents/ResetPass.php',
                        type: 'post',
                        success: function (result) {
                            $.notify("Password Reset", "success");
                            $('#foundPass').attr('type', 'text');
                            $('#foundPass').val(result);
                            $('#label').html('Provide this password to the new user*');
                        },
                        error: function () {
                            $.notify("An Error has occured");
                        }
                    });
                },
                cancel: function () {
                    $.alert('Canceled!');
                }
            }
        });


    });
    let active = 0;
    $('#ResultUser').on('submit', function (e) {
        e.preventDefault();
        let data = {
            username: $("#findusername").val(),
            name: $('#foundName').val(),
            email: $('#foundEmail').val(),
            state: active
        }
        $.ajax({
            data: data,
            url: '../components/UserComponents/ModifyUser.php',
            type: 'post',
            success: function (result) {
                $.notify("User Updated Successfully", "success");

            },
            error: function () {
                $.notify("An Error has occured");
            }

        });

    });

    $('#UserPermissionForm').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '../components/UserComponents/GetUserPermissions.php',
            data: { username: $('#NamePermission').val() },
            type: 'post',
            success: function (result) {
                result = result.split('|');
                $('#AvailabledReports').html(result[1]);
                $('#UserAllowedReposts').html(result[0]);

                $('#UserAllowedReposts a , #AvailabledReports a').on('click', function () {
                    let option = 0;
                    if ($(this).attr('class') == 'allowed') {
                        option = 1;
                    } else {
                        option = 2;
                    }
                    $.ajax({
                        data: {
                            username: $('#NamePermission').val(),
                            report_id: $(this).data('target'),
                            option: option
                        },
                        url: '../components/UserComponents/GrantPermissions.php',
                        type: 'post',
                        success: function (result) {
                            $.notify("Permission Updated Successfully", "success");
                            $('#UserPermissionForm').trigger("submit");
                        },
                        error: function () {
                            $.notify("An Error has occured");
                        }
                    });
                });
            },
            error: function () {
                $.notify("An Error has occured");
            }
        });
    });

    $('input[type="checkbox"]').on('click', function () {
        active = $(this).data('val');
        $('input[type="checkbox"]').not(this).prop('checked', false);
    });
}

function Reports() {
    $.ajax({
        url: '../components/getAllReports.php',
        success: function (result) {
            $('#reportsCatalog').html(result);
            $('#reportsCatalog a').on('click', function () {
                $("#ReportName").val($(this).data('target'));
                $('#submitNewName').attr('disabled', false);
            });
        },
        error: function () {
            $.notify("An Error has occurred");
        }

    });

    $('#AddReport').on('submit', function (e) {
        e.preventDefault();
        let reportName = $("#ReportName").val();
        $.ajax({
            data: {
                name: reportName
            },
            url: '../components/AddReport.php',
            type: 'post',
            success: function (result) {
                location.reload();
            },
            error: function () {
                $.notify("An Error has occurred");
            }
        });
    });

    $('#NewName').on('submit', function () {
        let reportName = $("#ReportName").val();
        let newReportName = $("#NewReportName").val();
        $.ajax({
            data: {
                name: reportName,
                newName: newReportName
            },
            url: '../components/ChangeReportName.php',
            type: 'post',
            success: function (result) {
                location.reload();
            },
            error: function () {
                $.notify("An Error has occurred");
            }
        });
    });

    $("#ReportName").on('keyup', function () {
        if ($(this).val().length != 0) {
            $('#submitNewName').attr('disabled', false);
        } else {
            $('#submitNewName').attr('disabled', true);
        }
    });

}