<form class="feedback" id="feedback" name="form" required=''>
  <h2>Оставьте отзыв:</h2>
  <input name="name" type="text" placeholder="Имя" required=''/>
  <br>
  <input name="email" type="text" placeholder="E-mail" required=''/>
  <br>
  <br>
  <textarea cols="32" name="message" rows="5" placeholder="Текст сообщения" required=''>
  </textarea>
  <br>
  <input type="file" id="feedpic" name="image">
  <br>
  <input type="submit" value="Отправить" />
</form>
<div class="reviews_container">
<?php 
include_once _PROJECT_DIR . "/app/scripts/review_containers.php"; 
get_containers($data);
?>
</div>
