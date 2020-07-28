<?php 
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

    

    //$kad_pengenalan_penempah = '';
    $nombor_telefon_penempah = '';
    $jenis_bilik_penempah =''; 
    $jumlah_tempahan_penempah =''; 
    $tarikh_masuk_penempah = '';
    $tarikh_keluar_penempah = '';
    // FInding the IC number
    $sql_4 ="SELECT kad_pengenalan FROM pelanggan WHERE email='$email_pengguna'";

    $result_4 = mysqli_query($con, $sql_4);

    while ($row_4 = mysqli_fetch_array($result_4)) {
        $kad_pengenalan_penempah = $row_4['kad_pengenalan'];
    }

     // Getting the number using User's name
    $sql_1 ="SELECT nombor_telefon FROM telefon WHERE nama='$nama_pengguna'";
    $result_1 = mysqli_query($con, $sql_1);

    // Getting the data using IC 
    $sql_2 = "SELECT * FROM menempah WHERE kad_pengenalan ='$kad_pengenalan_penempah'";
    $result_2 = mysqli_query($con, $sql_2);

    $hasil_2 = mysqli_num_rows($result_2);


    if ($hasil_2 > 0) {

        while ($row = mysqli_fetch_array($result_2)) {
            
            // Getting the total price using id
            $id_bilik = $row['id_bilik'];
            $sql_3 ="SELECT harga_bilik FROM bilik_hotel WHERE id_bilik='$id_bilik'";
            $result_3 = mysqli_query($con, $sql_3);

            // Storing user's data into variable
            $kad_pengenalan = $row['kad_pengenalan'];
            $jumlah_tempahan = $row['jumlah_tempahan'];
            $tarikh_masuk = $row['tarikh_masuk'];
            $tarikh_keluar = $row['tarikh_keluar'];

            while ($row_2 = mysqli_fetch_array($result_1)) {
                
                // Storing user's data into variable
                $nombor_telefon = $row_2['nombor_telefon'];

                while ($row_3 = mysqli_fetch_array($result_3)) {

                    // Calculations to find the room's package
                    $start = date_create($tarikh_masuk);
                    $end = date_create($tarikh_keluar);    
                    $jumlah_hari = date_diff($start, $end);
                    $jumlah_hari = $jumlah_hari -> format('%a');

                    $jumlah_harga = $row_3['harga_bilik'];

                    if ($jumlah_harga / $jumlah_tempahan / $jumlah_hari == 99){
                        $jenis_bilik = 'Single Room';
                    } elseif ($jumlah_harga / $jumlah_tempahan / $jumlah_hari == 190) {
                        $jenis_bilik = 'Double Room';
                    } elseif ($jumlah_harga / $jumlah_tempahan / $jumlah_hari == 300) {
                        $jenis_bilik = 'King Room';
                    } elseif ($jumlah_harga / $jumlah_tempahan / $jumlah_hari == 500) {
                        $jenis_bilik = 'Suite Room';
                    } else {
                        $jenis_bilik = 'NULL';
                    }
                }
            }
        }
    } else {
        header("Location:penempahan.php");
    }


    mysqli_close($con);
?>

<html>
    <head> 
        <title>Edit Tempahan</title>
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
            <form action='laporan-process.php' method='POST'>
                <h2> Edit Tempahan </h2>
                
                <label>Nama</label></br>
                <input class="input-box" name = 'nama_penempah' type='text' value='<?php print $nama_pengguna; ?>' disabled='disabled'></br>

                <label>Kad Pengenalan</label></br>
                <input class="input-box" name= 'kad_pengenalan_penempah' type='text' value='<?php print $kad_pengenalan_penempah; ?>'></br>

                <label>Nombor Telefon</label></br>
                <input class="input-box" name= 'nombor_telefon_penempah' type='text' value='<?php print $nombor_telefon; ?>'></br>

                <label>Email</label></br>
                <input class="input-box" name= 'email_penempah' type='text' value='<?php print $email_pengguna; ?>' disabled='disabled'></br>

                <label>Jenis Bilik</label></br>
                <select class="input-box" name ='jenis_bilik_penempah'>
                    <option selected='selected'><?php print $jenis_bilik; ?></option>
                    <option value='Single Room'>Single Room</option>
                    <option value='Double Room'>Double Room</option>
                    <option value='King Room'>King Room</option>
                    <option value='Suite Room'>Suite Room</option>
                </select></br>
                                            
                <label>Jumlah Tempahan</label></br>
                <select class="input-box" name = 'jumlah_tempahan_penempah'>
                    <option selected='selected'><?php print $jumlah_tempahan; ?></option>
                    <option value='1'>1</option>
                    <option value='2'>2</option>
                    <option value='3'>3</option>
                    <option value='4'>4</option>
                    <option value='5'>5</option>
                    <option value='6'>6</option>
                </select></br>
                                            
                <label>Id Bilik</label></br>
                <input class="input-box" type='text' value='<?php print $id_bilik; ?>' disabled='disabled'></br>
                                                        
                <label>Tarikh Masuk</label></br>
                <input class="input-box" name= 'tarikh_masuk_penempah' type='date' value='<?php print $tarikh_masuk; ?>'></br>
                                            
                <label>Tarikh Keluar</label></br>
                <input class="input-box" name= 'tarikh_keluar_penempah' type='date' value='<?php print $tarikh_keluar; ?>'></br>

                <label>Jumlah Bayaran</label></br>
                <input class="input-box" name='jumlah_bayaran_penempah' type='text' value='<?php print $jumlah_harga; ?>' disabled='disabled'></br>
                <input class="nav-btn" value="Kemuka" type='submit'>
            </form>
        </main>
    </body>
</html>