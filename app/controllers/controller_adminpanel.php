<?php
class Controller_adminpanel extends Controller
{
	function __construct()
	{
		parent::__construct();
		$this->model = new Model_AdmPanel();
	}
	
	function action_index()
	{
		//сохранение сессий через куки пришлось удалить, так как куки разрешено ставить только при Get методе,
		//но времени на выполнение дополнительного редиректа не хватило
		$data = $this->model->get_data();
		$this->view->generate('admpanel_view.php', 'template_view.php', $data);
	}

	function action_moderate(){
		var_dump($_POST);
		if (!empty($_POST)){
			$this->model->moderate($_POST);	
		}
	}
}
?>

