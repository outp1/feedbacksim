<?php
	// импорт конфига
	$dotenv = Dotenv\Dotenv::createImmutable(_PROJECT_DIR);
	$dotenv->load();

	require_once 'core/psqlighter.php';
	require_once 'core/model.php';
	require_once 'core/view.php'; 
	require_once 'core/controller.php'; 
	require_once 'core/route.php'; 
	Route::start();
?>
