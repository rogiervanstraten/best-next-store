<?php defined('BASEPATH') OR exit('No direct script access allowed');

class App extends Admin_Controller
{

	public function __construct()
	{
  		parent::__construct();
			$this->template->set_theme('app');
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
 	}

	/******
	*	Index
	*	Check if logged in
	******/
 	public function index()
	{
		
		if (!$this->ion_auth->logged_in())
		{
			redirect('app/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin())
		{
			redirect('app/geo/coverage', 'refresh');
		}
		else
		{
			redirect('app/dashboard', 'refresh');
		}
		
	}
	
	/******
	*	Log User out redirect to Login
	*	Logout
	******/
	public function logout()
	{
		$this->data['title'] = "Logout";
		$logout = $this->ion_auth->logout();
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('app/login', 'refresh');
	}
	
	/******
	*	Function Forgotten Password
	*	Password
	******/
	public function forgot_password()
	{
		$this->data['title'] = 'Forgot Password';
		
		$this->form_validation->set_rules('email', 'Email Address', 'required');
		if ($this->form_validation->run() == false)
		{
			//setup the input
			$this->data['email'] = array('name' => 'email',
				'id' => 'email',
			);

			//set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			
			$this->template
				->title('Best Next Store', $this->data['title'])
				->set_layout('frontend')
				->build('public/forgot_password', $this->data);
			
		}
		else
		{
			//run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($this->input->post('email'));

			if ($forgotten)
			{ 
				//if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("app/login", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("auth/forgot_password", 'refresh');
			}
		}

	}
	
	/******
	*	Function Login
	*	Redirect to Dashboard if succesfull
	******/
	public function login()
	{				
		$this->data['title'] = "Login";

		$this->form_validation->set_rules('identity', 'Identity', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->ion_auth->logged_in() && !$this->ion_auth->is_admin())
		{
			redirect('app/geo', 'refresh');
		}
		elseif($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
		{
			redirect('app/dashboard', 'refresh');
		}

		if ($this->form_validation->run() == true)
		{ 
			$remember = (bool) $this->input->post('remember');
						
			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
			{ 
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('/', 'refresh');
			}
			else
			{ 
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('app/login', 'refresh');
			}
			
		}
		else
		{  

			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['identity'] = array(
				'name' => 'identity',
				'id' => 'identity',
				'type' => 'text',
				'value' => $this->form_validation->set_value('identity'),
				'placeholder' => 'email',
				'autocomplete' => 'off'
				);
				
			$this->data['password'] = array(
				'name' => 'password',
				'id' => 'password',
				'type' => 'password',
				'placeholder' => 'password',
				'autocomplete' => 'off'
				);
			
			$this->template
				->title('Best Next Store', $this->data['title'])
				->set_layout('frontend')
				->build('public/login', $this->data);
		}
			
	}

}