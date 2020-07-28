<?php 
	session_start();
	if(!isset($_SESSION['nama_pengguna'])){
	   header("Location: login-form.php");
	}
?>

<html>
	<head>
		<title>Homepage</title>
		<link href="https://fonts.googleapis.com/css2?family=Recursive:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="design/homepage.css">
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
			<h1> Selamat Datang </h1>
			<h2> Jenis Bilik yang Hotel Kami Sediakan </h2>
			<p><a class="nav-room" href="single-room.php">Single Room / RM99</a></p>
			<p><a class="nav-room" href="double-room.php">Double Room / RM190</a></p>
			<p><a class="nav-room" href="king-room.php">King Room / RM300</a></p>
			<p><a class="nav-room" href="suite-room.php">Suite Room / RM500</a></p>
		</main>
	</body>
</html>
