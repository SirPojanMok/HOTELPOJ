<?php

    // connecting to database

    $con = mysqli_connect("localhost", "root", "");

    if (!$con) {
        die ('Salah pangkalan data'.mysqli_connect_error());
    }

    mysqli_select_db($con, 'hotelpoj');

    // Getting data from form

    $nama_pengguna = $_POST['nama_pengguna'];
    $kata_laluan_pengguna = $_POST['kata_laluan_pengguna'];
    $email_pengguna = $_POST['email_pengguna'];


    
    $hashed_kata_laluan = password_hash($kata_laluan_pengguna, PASSWORD_DEFAULT);
    // Doing multiple query simultaniously
    $sql = "SELECT * FROM katalaluan WHERE nama='$nama_pengguna'";
    $sql_1 = "INSERT INTO email (email, nama) VALUES ('$email_pengguna','$nama_pengguna');";
    $sql_2 = "INSERT INTO katalaluan (kata_laluan, nama) VALUES('$hashed_kata_laluan','$nama_pengguna');";

    $result = mysqli_query($con, $sql);

    $hasil = mysqli_num_rows($result);
    
    if ($hasil > 0){
        header("Location:signup-form.php");
    } else {
        if (!filter_var($email_pengguna, FILTER_VALIDATE_EMAIL)) {
            header("Location:signup-form.php");
        } else {
            $result_1 = mysqli_query($con, $sql_1);
            $result_2 = mysqli_query($con, $sql_2);
            header("Location:login-form.php");
        }
    }


    // closing database

    mysqli_close($con);

?>