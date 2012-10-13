<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Boundaries_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

		function get_values($id=0)
		{
			$values = 0;

			if($id!=0)
			{

				if($data = $this->db->get_where('data', array('zip_id' => $id))->row())
				{

					$values = $data->value;

				}

			}

			return $values;

		}
    
    function get_boundaries()
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
					'correlation' => $this->get_values($zipcode->id),
					'coordinates' => $coord
				);
			
				$i++;
			}
			
			return $zip;
			
    }

}