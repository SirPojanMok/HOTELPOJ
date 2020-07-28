<?php
    
    $con = mysqli_connect("localhost", "root", "");

    if (!$con) {
        die ('Salah pangkalan data'.mysqli_connect_error());
    }

    mysqli_select_db($con, 'hotelpoj');

    $nama_pengguna = $_POST['nama_pengguna'];
    $kata_laluan_pengguna =  $_POST['kata_laluan_pengguna'];


    $sql = "SELECT * FROM katalaluan WHERE nama ='$nama_pengguna'";

    $result = mysqli_query($con, $sql);
    $sql_1 = "SELECT email FROM email WHERE nama='$nama_pengguna'";



    while ($row_1 = mysqli_fetch_array($result)) {
        $kata_laluan = $row_1['kata_laluan'];
    }
    
    $result_1 = mysqli_query($con, $sql_1);
    
    while ($row = mysqli_fetch_array($result_1)) {
        $email_pengguna = $row['email'];
    }
    
    $hasil = mysqli_num_rows($result);
    
    if ($hasil > 0) {
        if (password_verify($kata_laluan_pengguna, $kata_laluan)) {
            session_start();
            $_SESSION['nama_pengguna'] = $nama_pengguna;
            $_SESSION['email_pengguna'] = $email_pengguna;

            header("Location:index.php");
        } else {
            header("Location:login-form.php");
        }
    } else {
        header("Location:login-form.php");
    }
    
    mysqli_close($con);






?>