<?php

function cmp($a, $b) 
{
    if ($a["date"] == $b["date"]) {
        return 0;
    }
    return (strtotime($b["date"]) < strtotime($a["date"])) ? -1 : 1;
}
//$a = Array(
//      Array("date" => "01.09.2016", "sum" => "450"),
//      Array("date" => "31.08.2016", "sum" => "156"),
//      Array("date" => "02.09.2016","sum" => "888"));
//
//usort($a, "cmp");

function get_containers($data) {
	usort($data, "cmp");
	foreach($data as $review) {
		if($review["mod_status"] == 't') {
			if ($review["image_id"] != '0') $image = $review["image_id"];
			else $image = 'chelovek.jpg';
			$container = "
	<div class='container'>
	  <img src='/assets/upload/$image' alt='Avatar' style='width:90px'>
	  <p><span>$review[username]</span> $review[message_date]</p>
	  <p>$review[review_text]</p>
	</div>
	";		
			echo $container;
		}
	}
	
}

function get_containers_4admin($data) {
	usort($data, "cmp");
	foreach($data as $review) {
		if($review["mod_status"] == 't') {
			if ($review["image_id"] != '0') $image = $review["image_id"];
			else $image = 'chelovek.jpg';
			$container = "
	<div class='container'>
		$review[email]
	  <img src='/assets/upload/$image' alt='Avatar' style='width:90px'>
	  <p><span>$review[username]</span> $review[message_date]</p>
	  <p>$review[review_text]</p>
	  <br>
	  <p class='accepted_r'>Принят</p>
	</div>
	";		
			echo $container;
		}
		else {
			if ($review["image_id"] != '0') $image = $review["image_id"];
			else $image = 'chelovek.jpg';
			$container = "
	<div class='container'>
		$review[email]
	  <img src='/assets/upload/$image' alt='Avatar' style='width:90px'>
	  <p><span>$review[username]</span> $review[message_date]</p>
	  <p>$review[review_text]</p> 
	  <br>
	  <a href='' class='edit_review' id='$review[review_id]'>Редактировать</a>
	  <a href='' class='acccept_review' id='$review[review_id]'>Принять</a>
	</div>
	";		
			echo $container;
		}

	}
	
}
//<div class="container">
//  <img src="bandmember.jpg" alt="Avatar" style="width:90px">
//  <p><span></span> CEO at Mighty Schools.</p>
//  <p>HTML CSS saved us from a web disaster.</p>
//</div>
//
//<div class="container">
//  <img src="avatar_g2.jpg" alt="Avatar" style="width:90px">
//  <p><span >Rebecca Flex.</span> CEO at Company.</p>
//  <p>No one is better than HTML CSS.</p>
//</div>

?>
