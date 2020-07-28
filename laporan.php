<?php
    error_reporting(E_ERROR);
    session_start();
    
    if(!isset($_SESSION['nama_pengguna'])){
        header("Location:login-form.php");
    }
    // Account's
    $nama_pengguna = $_SESSION['nama_pengguna'];
    $email_pengguna = $_SESSION['email_pengguna'];
    
    // Connecting database and selecting table
    $con = mysqli_connect("localhost", "root", "");
    
    if (!$con) {
        die ('Salah database'.mysqli_connect_error());
    }
    
    mysqli_select_db($con, 'hotelpoj');

    $sql = "SELECT kad_pengenalan FROM pelanggan WHERE email='$email_pengguna'";

    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_array($result)) {
        $kad_pengenalan_penempah = $row['kad_pengenalan'];
    }

    $sql_1 = "SELECT nombor_telefon FROM telefon WHERE nama='$nama_pengguna'";

    $result_1 = mysqli_query($con, $sql_1);
    while ($row_1 = mysqli_fetch_array($result_1)) {
        $nombor_telefon_penempah = $row_1['nombor_telefon'];
    }

    $sql_2 = "SELECT * FROM menempah WHERE kad_pengenalan ='$kad_pengenalan_penempah'";
    $result_2 = mysqli_query($con, $sql_2);


    while ($row_2 = mysqli_fetch_array($result_2)) {
        $id_bilik_penempah = $row_2['id_bilik'];
        $jumlah_tempahan_penempah = $row_2['jumlah_tempahan'];
        $tarikh_masuk_penempah = $row_2['tarikh_masuk'];
        $tarikh_keluar_penempah = $row_2['tarikh_keluar'];
    }


    $sql_3 = "SELECT harga_bilik FROM bilik_hotel WHERE id_bilik='$id_bilik_penempah'";
    $result_3 = mysqli_query($con, $sql_3);

    while ($row_3 = mysqli_fetch_array($result_3)) {
        $jumlah_bayaran_penempah = $row_3['harga_bilik'];
    }

    $start = date_create($tarikh_masuk_penempah);
    $end = date_create($tarikh_keluar_penempah);    
    $jumlah_hari = date_diff($start, $end);
    $jumlah_hari = $jumlah_hari -> format('%a');

    if ($jumlah_bayaran_penempah / $jumlah_tempahan_penempah / $jumlah_hari == 99){
        $jenis_bilik = 'Single Room';
    } elseif ($jumlah_bayaran_penempah / $jumlah_tempahan_penempah / $jumlah_hari == 190) {
        $jenis_bilik = 'Double Room';
    } elseif ($jumlah_bayaran_penempah / $jumlah_tempahan_penempah / $jumlah_hari == 300) {
        $jenis_bilik = 'King Room';
    } elseif ($jumlah_bayaran_penempah / $jumlah_tempahan_penempah / $jumlah_hari == 500) {
        $jenis_bilik = 'Suite Room';
    } else {
        $jenis_bilik = 'NULL';
    }

    mysqli_close($con);
?>

<html>
    <head>
        <title>Laporan Tempahan</title>
        <link href="https://fonts.googleapis.com/css2?family=Recursive:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="design/form.css">
	</head>
	<header>
		<div id="header-box">
			<nav id="header-box-1">
				<a class="nav-header" href="index.php">HOTEL POJ</a>
			</nav>
			<nav id="header-box-2">
				<p><a class="nav-header" href="index.php">Home</a></p>
				<p><a class="nav-header" href="index.php#main-box">Jenis Bilik</a></p>
				<p><a class="nav-header" href="penempahan.php">Borang Tempahan</a></p>
				<p><a class="nav-header" href="laporan.php">Laporan Tempahan</a></p>
				<p><a class="nav-header" href="logout.php">Logout</a></p>
			</nav>
		</div>
    </header>
    <body>
        <main id="form-box">
            <form>
                <h2>Laporan Tempahan</h2>
                <label>Nama</label></br>
                <input class="input-box" name = "nama_penempah" type = "text" value = "<?php print $nama_pengguna; ?>" disabled="disabled"></br>

                <label>Kad pengenalan</label></br>
                <input class="input-box" name = "kad_pengenalan_penempah" type = "text" value = "<?php print $kad_pengenalan_penempah; ?>" disabled="disabled"></br>

                <label>Nombor telefon</label></br>
                <input class="input-box" name = "nombor_telefon_penempah" type = "text" value = "<?php print $nombor_telefon_penempah; ?>" disabled="disabled"></br>

                <label>Email</label></br>
                <input class="input-box" name = "email_penempah" type = "text" value="<?php print $email_pengguna?>" disabled="disabled"></br>

                <label>Jenis bilik</label></br>
                <input class="input-box" name = "jenis_bilik_penempah" type="text" value = "<?php print $jenis_bilik; ?>" disabled="disabled"></br>
        

                <label>Jumlah tempahan</label></br>
                <input class="input-box" name = "jumlah_tempahan_penempah" type="text" value = "<?php print $jumlah_tempahan_penempah; ?>" disabled="disabled"></br>


                <label>Tarikh masuk</label></br>
                <input class="input-box" name = "tarikh_masuk_penempah" type = "date" value = "<?php print $tarikh_masuk_penempah; ?>" disabled="disabled"></br>

                <label>Tarikh keluar</label></br>
                <input class="input-box" name = "tarikh_keluar_penempah" type = "date" value = "<?php print $tarikh_keluar_penempah; ?>" disabled="disabled"></br>

                <label>Jumlah Bayaran</label></br>
                <input class="input-box" name = "tarikh_keluar_penempah" type = "text" value = "<?php print 'RM'.$jumlah_bayaran_penempah; ?>" disabled="disabled"></br>

                <div class="box-tempahan-btn">
                    <a class="nav-btn" href="edit-laporan.php">Edit</a>
                    <input class="nav-btn" type='button' value='Print' onClick='window.print()'>
                <div>
            </form>
        </main>
    </body>
</html>