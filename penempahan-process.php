<?php
    session_start();


	if(!isset($_SESSION['nama_pengguna'])){
	   header("Location:login-form.php");
    }
    
    // Account's
    $nama_pengguna = $_SESSION['nama_pengguna'];
    $email_pengguna = $_SESSION['email_pengguna'];
    
    // Connection to databse and selecting table
    $con = mysqli_connect("localhost", "root", "");

    if (!$con) {
        die ('Salah database'.mysqli_connect_error());
    }

    mysqli_select_db($con, 'hotelpoj');

    // Keep the form's data in a variable

    $kad_pengenalan_penempah = $_POST['kad_pengenalan_penempah'];
    $nombor_telefon_penempah = $_POST['nombor_telefon_penempah'];
    $jenis_bilik_penempah = $_POST['jenis_bilik_penempah'];
    $jumlah_tempahan_penempah = $_POST['jumlah_tempahan_penempah'];
    $tarikh_masuk_penempah = $_POST['tarikh_masuk_penempah'];
    $tarikh_keluar_penempah = $_POST['tarikh_keluar_penempah'];


    // The calculations to find the total price of the reservations.

    $harga_bilik = 0;
    $jumlah_hari = 0;
    $jumlah_harga_bilik = 0;

    // Find the price of the selected room
    
    if ($jenis_bilik_penempah == "Single Room"){
        $harga_bilik = 99;
    } elseif ($jenis_bilik_penempah == "Double Room"){
        $harga_bilik = 190;
    } elseif ($jenis_bilik_penempah == "King Room"){
        $harga_bilik = 300;
    } elseif ($jenis_bilik_penempah == "Suite Room"){
        $harga_bilik = 500;
    } else {
        $harga_bilik = 0;
    }

    // Find the amount of day
    
    $start = date_create($tarikh_masuk_penempah);
    $end = date_create($tarikh_keluar_penempah);    
    $jumlah_hari = date_diff($start, $end);
    $jumlah_hari = $jumlah_hari -> format('%a');

    // Find the total price
    $jumlah_harga_bilik = $harga_bilik * $jumlah_hari * $jumlah_tempahan_penempah;



    // Doing Queries

    // Pelanggan's Query
    $sql = "INSERT INTO pelanggan (kad_pengenalan, nombor_telefon, email) VALUES ('$kad_pengenalan_penempah', '$nombor_telefon_penempah', '$email_pengguna')";
    $hasil = mysqli_query($con, $sql);

    // Menempah's Query
    $sql_1 = "INSERT INTO menempah (kad_pengenalan, jumlah_tempahan, tarikh_masuk, tarikh_keluar) VALUES ('$kad_pengenalan_penempah', '$jumlah_tempahan_penempah', '$tarikh_masuk_penempah', '$tarikh_keluar_penempah')";
    $hasil_1 = mysqli_query($con, $sql_1);

    // Price's Query
    $sql_2 = "INSERT INTO bilik_hotel (harga_bilik) VALUES ('$jumlah_harga_bilik')";
    $hasil_2 = mysqli_query($con, $sql_2);

    // Phone Numbers' Query
    $sql_3 = "INSERT INTO telefon (nombor_telefon, nama) VALUES ('$nombor_telefon_penempah', '$nama_pengguna')";
    $hasil_3 = mysqli_query($con, $sql_3);
    mysqli_close($con);

    header("Location:index.php");

?>
