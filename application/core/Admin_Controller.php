<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Admin_Controller extends MY_Controller 
{
	
	function __construct() 
	{
		
		parent::__construct();
		
		if ( ! self::_check_access())
		{
			redirect('app/login');
		}
		
		$this->template->set_theme('app');
		
		//$https = FALSE;
		/*
		if ($https and strtolower(substr(current_url(), 4, 1)) != 's')
		{
			redirect(str_replace('http:', 'https:', current_url()).'?session='.session_id());
		}*/
					
	}

	private function _check_access()
	{
		
		$allowed = array('app/login','app/logout','app/forgot_password');
		
		$current = $this->uri->segment(1, '') . '/' . $this->uri->segment(2, 'index');

		if (in_array($current, $allowed))
		{
			return TRUE;
		}
		else if (!$this->ion_auth->logged_in())
		{
			redirect('app/login');
		}
		else if ($this->ion_auth->logged_in())
		{
			return TRUE;
		}

		return FALSE;
	}
		
}