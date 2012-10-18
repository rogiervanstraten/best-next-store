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
		
		$https = FALSE;
		
		if ($https and strtolower(substr(current_url(), 4, 1)) != 's')
		{
			redirect(str_replace('http:', 'https:', current_url()).'?session='.session_id());
		}
					
	}

	private function _check_access()
	{
		$this->permission = array('app/geo');
		
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
		else if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
		{
			$this->template->set_theme('app');
			return TRUE;
		}
		else if ($this->ion_auth->logged_in())
		{
			//CHECK PERMISSIONS!
			$this->template->set_theme('app');
			return TRUE;
		}

		return FALSE;
	}
		
}