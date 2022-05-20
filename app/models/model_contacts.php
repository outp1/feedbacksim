<?php 

class Model_Feedapi extends Model
{
	
	public function __construct() 
	{
		parent::__construct();
	}

	public function imageCreateFromAny($filepath) {
   		 $type = exif_imagetype($filepath); // [] if you don't have exif you could use getImageSize()
   		 $allowedTypes = array(
   		     1,  // [] gif
   		     2,  // [] jpg
   		     3,  // [] png
   		     6   // [] bmp
   		 );
   		 if (!in_array($type, $allowedTypes)) {
   		     return false;
   		 }
   		 switch ($type) {
   		     case 1 :
   		         $im = imageCreateFromGif($filepath);
   		     break;
   		     case 2 :
   		         $im = imageCreateFromJpeg($filepath);
   		     break;
   		     case 3 :
   		         $im = imageCreateFromPng($filepath);
   		     break;
   		     case 6 :
   		         $im = imageCreateFromBmp($filepath);
   		     break;
   		 }   
   		 return $im; 
} 

	public function rand_id($length)
	{
		$unique = False;
		while (!$unique) {
			$gen_id = '';
			for($i = 0; $i < $length; $i++) {
				$gen_id .= mt_rand(0, 9);	
			}
			$query = "SELECT review_id FROM reviews WHERE review_id = $gen_id";
			$res = pg_fetch_row(pg_query($this->conn, $query));
			$unique = !$res;
		}
		return $gen_id;
	}

	public function post_data(){
		$review_id = $this->rand_id(6);
		$image_id = 0;
		if (!empty($_FILES['image']['tmp_name'])) {
			$image = $_FILES['image'];
			$image_name = $_FILES['image']['tmp_name'];
			$error = $_FILES['image']['error'];
			if ($error != UPLOAD_ERR_OK || !is_uploaded_file($image_name)) {
				$errorMessages = [
     				 UPLOAD_ERR_INI_SIZE   => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
     				 UPLOAD_ERR_FORM_SIZE  => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
     				 UPLOAD_ERR_PARTIAL    => 'Загружаемый файл был получен только частично.',
     				 UPLOAD_ERR_NO_FILE    => 'Файл не был загружен.',
     				 UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
     				 UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
     				 UPLOAD_ERR_EXTENSION  => 'PHP-расширение остановило загрузку файла.',
    				];
    				$unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';
				$outputMessage = isset($errorMessages[$error]) ? $errorMessages[$error] : $unknownMessage;
				die($outputMessage);
			} 
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mime = (string) finfo_file($finfo, $image_name); 
			if (strpos($mime, 'image') === false) { return "!image";}
			$image_size = getimagesize($image_name);
			$limitWidth  = 320;
			$limitHeight = 240;
			if ($image_size[1] > $limitHeight || $image_size[0] > $limitWidth) {
				$image_p = imagecreatetruecolor($limitWidth, $limitHeight);
				$image_c = $this->imageCreateFromAny($image_name);
				imagecopyresampled($image_p, $image_c, 0, 0, 0, 0, $limitWidth, $limitHeight, $image_size[0], $image_size[1]);
			}
			$image_new_name = md5_file($image_name);
			$image_extension = image_type_to_extension($image_size[2]);
			$format = str_replace('jpeg', 'jpg', $image_extension);
			$image_id = $image_new_name . $format;
			if(isset($image_p)) {
				if (!imagejpeg($image_p, _PROJECT_DIR . '/assets/upload/' . $image_id)){
					  die('При записи изображения на диск произошла ошибка.');
				}
			}
			else {
				if (!move_uploaded_file($image_name, _PROJECT_DIR . '/assets/upload/' . $image_id)) {
					  die('При записи изображения на диск произошла ошибка.');
				}
			}
		}
		else $image_id = 0;
		$message_date = date('F d \в H:i');
		$date = date('c');
		$query = "INSERT INTO reviews (review_id, username, email, review_text, image_id, message_date, date)
			              VALUES  ('$review_id', '$_POST[name]', '$_POST[email]', '$_POST[message]', '$image_id', '$message_date', '$date');";
		pg_query($this->conn, $query);
		header('Content-Type: application/json');
		$data = ['result' => 'ok'];
		echo json_encode($data);
	}
}

?>

