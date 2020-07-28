<?php 
    session_start();
    
	if(!isset($_SESSION['nama_pengguna'])){
	   header("Location:login-form.php");
    }
    
    $nama_pengguna = $_SESSION['nama_pengguna'];
    $email_pengguna = $_SESSION['email_pengguna'];
?>
<html>
    <head>
        <title>Borang Tempahan</title>
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
            <form action = "penempahan-process.php" method="POST">
                <h2> Borang Tempahan </h2>

                <label>Nama</label></br>
                <input class="input-box" name = "nama_penempah" type = "text" value = "<?php print $nama_pengguna; ?>" disabled="disabled"></br>

                <label>Kad pengenalan</label></br>
                <input class="input-box" name = "kad_pengenalan_penempah" type = "text"></br>
                
                <label>Nombor telefon</label></br>
                <input class="input-box" name = "nombor_telefon_penempah" type = "text"></br>

                <label>Email</label></br>
                <input class="input-box" name = "email_penempah" type = "text" value="<?php print $_SESSION['email_pengguna']?>" disabled="disabled"></br>

                <label>Jenis bilik</label></br>
                <select class="input-box" name = "jenis_bilik_penempah">
                    <option value="Single Room">Single Room</option>
                    <option value="Double Room">Double Room</option>
                    <option value="King Room">King Room</option>
                    <option value="Suite Room">Suite Room</option>
                </select></br>


                <label>Jumlah tempahan</label></br>
                <select class="input-box" name = "jumlah_tempahan_penempah">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select></br>

                <label>Tarikh masuk</label></br>
                <input class="input-box" name = "tarikh_masuk_penempah" type = "date"></br>

                <label>Tarikh keluar</label></br>
                <input class="input-box" name = "tarikh_keluar_penempah" type = "date"></br>

                <input class="nav-btn" name = "submit" value = "Kemuka" type = "submit">

            </form>
        </main>
    </body>
</html>