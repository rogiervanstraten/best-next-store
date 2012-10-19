<?php defined('BASEPATH') OR exit('No direct script access allowed');

class App extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
		$this->template->set_theme('app')->set_layout('admin');
		
	}

	//redirect if needed, otherwise display the user list
	function index()
	{
		$this->data['title'] = 'Dasboard';
		
		$this->template
			->title('Best Next Store Admin', $this->data['title'])
			->build('dashboard/app/index', $this->data);
			
	}

}
