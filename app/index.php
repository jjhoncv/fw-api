<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>::Fw::</title>
    <link rel="stylesheet" href="static/css/index.css">
</head>
<body>
    <header>
        <div class="logo">Fw</div>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/admin">Admin</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="wrapper">
            <br/><br/>
            <h1>Title</h1>
            <p>Description</p>
        </div>
    </main>
    <footer>
        <div class="foot">© Powered desing</div>
    </footer>
</body>
</html>
<!--
<h1>Hello Cloudreach!</h1>
<h4>Attempting MySQL connection from php...</h4>
<?php

$host = 'mysql';
$user = 'root';
$pass = 'rootpassword';
$conn = new mysqli($host, $user, $pass);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected to MySQL successfully!";
?>