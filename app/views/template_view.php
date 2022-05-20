<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>Сайт</title>
	<link rel="stylesheet" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
<body>
<div class="wrapper">
<div class="header">
<h1 class="headerLogo"><a href="/">FEEDBACK SIMULATOR</a></h1>
<a class="headerButton" href="login">Войти</a>
</div>
<div class="main">
	<?php include 'app/views/'.$content_view; ?>
</div>
<div class="footer">
<p>Copyright ©<time datetime="2022">2022</time> 
      Daniil Sobolev =) </p>
   <address>Krasnodar, Russia.</address>
</div>
</div>
</body>
<script src="js/main.js"></script> 
</html>
