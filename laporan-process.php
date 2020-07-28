<?php
    session_start();

	if(!isset($_SESSION['nama_pengguna'])){
	   header("Location:login-form.php");
	}

    $nama_pengguna = $_SESSION['nama_pengguna'];
    $email_pengguna = $_SESSION['email_pengguna'];
    // Connection to databse and selecting table
    $con = mysqli_connect("localhost", "root", "");

    if (!$con) {
        die ('Salah database'.mysqli_connect_error());
    }

    mysqli_select_db($con, 'hotelpoj');

    // Keep the form's data in a variable
    $update_kad_pengenalan_penempah = $_POST['kad_pengenalan_penempah'];
    $update_nombor_telefon_penempah = $_POST['nombor_telefon_penempah'];
    $update_jenis_bilik_penempah = $_POST['jenis_bilik_penempah'];
    $update_jumlah_tempahan_penempah = $_POST['jumlah_tempahan_penempah'];
    $update_tarikh_masuk_penempah = $_POST['tarikh_masuk_penempah'];
    $update_tarikh_keluar_penempah = $_POST['tarikh_keluar_penempah'];
   
    // The calculations to find the total price of the reservations.

    $harga_bilik = 0;
    $jumlah_hari = 0;
    $update_jumlah_harga_bilik = 0;

        // Find the price of the selected room
    
    if ($update_jenis_bilik_penempah == "Single Room"){
        $harga_bilik = 99;
    } elseif ($update_jenis_bilik_penempah == "Double Room"){
        $harga_bilik = 190;
    } elseif ($update_jenis_bilik_penempah == "King Room"){
        $harga_bilik = 300;
    } elseif ($update_jenis_bilik_penempah == "Suite Room"){
        $harga_bilik = 500;
    } else {
        $harga_bilik = "ERROR";
    }

        // Find the amount of day
    
    $start = date_create($update_tarikh_masuk_penempah);
    $end = date_create($update_tarikh_keluar_penempah);    
    $jumlah_hari = date_diff($start, $end);
    $jumlah_hari = $jumlah_hari -> format('%a');

        // Find the total price
    
        $update_jumlah_harga_bilik = $harga_bilik * $jumlah_hari * $update_jumlah_tempahan_penempah;

    // Finding the IC
    $sql_4 ="SELECT kad_pengenalan FROM pelanggan WHERE email='$email_pengguna'";

    $result_4 = mysqli_query($con, $sql_4);

    while ($row_4 = mysqli_fetch_array($result_4)) {
        $kad_pengenalan_penempah = $row_4['kad_pengenalan'];
    }
    
    // Getting the data using IC 
    $sql_5 = "SELECT * FROM menempah WHERE kad_pengenalan ='$kad_pengenalan_penempah'";
    $result_5 = mysqli_query($con, $sql_5);

    $hasil_5 = mysqli_num_rows($result_5);
    while ($row = mysqli_fetch_array($result_5)) {
            
        // Getting  id
        $id_bilik = $row['id_bilik'];
    }
    // Doing Queries

    // Pelanggan's Query
    $sql = "UPDATE pelanggan SET kad_pengenalan='$update_kad_pengenalan_penempah', nombor_telefon='$update_nombor_telefon_penempah', email='$email_pengguna' WHERE email='$email_pengguna'";
    $hasil = mysqli_query($con, $sql);

    // Menempah's Query
    $sql_1 = "UPDATE menempah SET kad_pengenalan='$update_kad_pengenalan_penempah', jumlah_tempahan='$update_jumlah_tempahan_penempah', tarikh_masuk='$update_tarikh_masuk_penempah', tarikh_keluar='$update_tarikh_keluar_penempah' WHERE kad_pengenalan = '$kad_pengenalan_penempah'";
    $hasil_1 = mysqli_query($con, $sql_1);

    // Price's Query
    $sql_2 = "UPDATE bilik_hotel SET harga_bilik='$update_jumlah_harga_bilik' WHERE id_bilik='$id_bilik'";
    $hasil_2 = mysqli_query($con, $sql_2);

    // Phone Numbers' Query
    $sql_3 = "UPDATE telefon nombor_telefon='$update_nombor_telefon_penempah', nama='$nama_pengguna' WHERE nama='$nama_pengguna'";
    $hasil_3 = mysqli_query($con, $sql_3);

    mysqli_close($con);
    header("Location:index.php");
?>