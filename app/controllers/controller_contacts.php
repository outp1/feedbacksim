<?php
class Controller_contacts extends Controller
{

	function __construct()
	{
		parent::__construct();
		$this->model = new Model_Feedapi();
	}
	
	function action_index()
	{
	}

	function action_feedapi(){
		if (!empty($_POST)){
			$this->model->post_data();	
		}
	}

}
