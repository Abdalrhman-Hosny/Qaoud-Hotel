<?php
    require('db_config.php');
    require('essentials.php');

    session_start();
    if(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin']==true) {
        redirect('dashboard.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login page</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <!-- Bootstrap icons link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!-- swipper link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <!-- css file -->
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">

    <div class="login-form text-center bg-white rounded shadow overflow-hidden">
        <form method="POST">
            <h4 class="bg-dark text-white py-3">Admin login Panel</h4>
            <div class="p-4">
                <div class="mb-3">
                    <input name="admin_name" type="text" class="form-control shadow-none text-center" placeholder="Admin Name" required>
                </div>
                <div class="mb-4">
                    <input name="admin_pass" type="password" class="form-control shadow-none text-center" placeholder="Password" required>
                </div>
                <button name="login" type="submit" class="btn text-white custom-bg">LOGIN</button>
            </div>
        </form>
    </div>

    <?php 
        if(isset($_POST['login'])) {
            $frm_data = filteration($_POST);

            $query = "select * from `admin_cred` where `admin_name`=? and `admin_pass`=?";
            $values = [$frm_data['admin_name'],$frm_data['admin_pass']];
            $res = select($query,$values,"ss");
            
            if($res->num_rows==1) {
                $row = mysqli_fetch_assoc($res);
                $_SESSION['adminLogin'] = true;
                $_SESSION['amdinId'] = $row['sr-no'];
                redirect('dashboard.php');
            }
            else {
                alert('Error','Login failed - Invalid Credentials!');
            }
        }
    ?>


    <!-- Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous"></script>


</body>
</html>