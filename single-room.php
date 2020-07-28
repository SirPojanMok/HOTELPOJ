<?php 
	session_start();
	if(!isset($_SESSION['nama_pengguna'])){
	   header("Location:login-form.php");
	}
?>
<html>
    <head>
		<title>Single Room</title>
		<link href="https://fonts.googleapis.com/css2?family=Recursive:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="design/room.css">
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
        <main id="main-box">
            <h1>SINGLE ROOM / RM99</h1>
            <span id="detail-box">
                <p>Perincian mengenai bilik ini</p>
                <ul>
                    <li>Keluasan sebanyak 60 kaki persegi</li>
                    <li>Dilengkapi dengan alatan keperluan (televisyen, peti sejuk dan seterika)</li>
                    <li>Sarapan dan makan malam disediakan</li>
                    <li>Harga yang berpatutan untuk semua</li>
                </ul>
            </span>
            <p>Untuk menempah, klik butang tempah ataupun borang tempahan yang berada di setiap muka</p>
            <p><a href="penempahan.php">Tempah</a></p>
        </main>
    </body>



</html>