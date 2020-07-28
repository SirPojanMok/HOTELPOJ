<html>
    <head>
        <title>Signup</title>
        <link href="https://fonts.googleapis.com/css2?family=Recursive:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="design/signup.css">
    </head>
    <header>
        <nav id="header-box"><a href="signup-form.php">HOTEL POJ</a></nav>
    </header>
    <body>
        <div id="form-box">
            <form action = "signup-process.php" method="POST">
                <p>Sila masukkan butiran tersebut untuk mendaftar</p>
                <label>Nama</label></br>
                <input class="input-box" name = "nama_pengguna" type = "text" spellcheck="false"></br>

                <label>Kata laluan</label></br>
                <input class="input-box" name = "kata_laluan_pengguna" type = "password" spellcheck="false"></br>

                <label>Email</label></br>
                <input class="input-box" name = "email_pengguna" type = "text" spellcheck="false"></br>

                <input class="submit-box" name = "submit" value = "Kemuka" type = "submit">
                <p><a class="link-navigation" href="login-form.php">Sudah memiliki akaun? Log masuk</a></p>
            </form>
        </div>
    </body>
</html>