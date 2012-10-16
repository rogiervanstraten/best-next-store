<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

ini_set('memory_limit', '1024M');

class App extends Admin_Controller {
	
  function __construct()
  {
      parent::__construct();
			$this->load->model(array('boundaries_m', 'placemarks_m'));
  }

	/**
	*** COLORS TO INDEX
	***  
	**/


	public function index()
	{	
		$this->load->view('geo/app');
	}
	
	
	public function coverage()
	{
		$this->load->view('geo/app-cover');
		
	}
	
	public function performance()
	{
		$this->load->view('geo/app-perform');
		
	}
	
	
	
	
	
	public function fetch_bounds($zoom=3, $action=NULL)
	{
		$boundaries = $this->cache->model('boundaries_m', 'get_boundaries', array($zoom,$action), 120); // keep for 2 minutes

		$this->output->set_content_type('application/json')->set_output(json_encode($boundaries));
	
		//$this->cache->delete_all();
		
	}
	
	public function fetch_placemarks()
	{
			
		$placemarks = $this->cache->model('placemarks_m', 'get_placemarks', 1, 120); // keep for 2 minutes
		
		$this->output->set_content_type('application/json')->set_output(json_encode($placemarks));
		
	}
	
	
	
	
	
	
	public function gemeentes()
	{

		
		$zipcodes = $this->db->get('boundaries')->result();
		
		$i = 1;
		
		$zip = array();
		
		foreach ($zipcodes as $zipcode) {
			
			$coordinates = explode(', ', $zipcode->polygon);
			
			$coord = array();
			
			if(count($coordinates) > 0)
			{
				
				foreach($coordinates as $coordinate)
				{
					
					$coordinate = explode(' ', $coordinate);
					$coord[] = $coordinate;
										
				}
									
			}
			else
			{
				
				$coordinates = 0;
				
			}
			
			$zip[] = array(
				'zip' => $zipcode->zip,
				'title'=> $zipcode->title,
				'coordinates' => $coord
			);
						
			$i++;
		}		
		
		$this->output->set_content_type('application/json')->set_output(json_encode($zip));
		
	}
	
	public function json_report()
	{
		
		$zipcodes = $this->db->get('boundaries')->result();
				
		foreach ($zipcodes as $zipcode) {
			
			$jsonZip = array(
				'id' => $zipcode->id,
				'title' => $zipcode->title
				);
			
			$coordinates = explode(', ', $zipcode->polygon);
			
			$jsonZip['coordinates'] = array();
			
			if(count($coordinates) > 0)
			{
				foreach($coordinates as $point)
				{
					$coordinate = explode(' ', $point);
					$jsonZip['coordinates'][] = $coordinate;
				}
				
			}
			
		}
				
		$this->output->set_content_type('application/json')->set_output(json_encode($jsonZip));
		
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */