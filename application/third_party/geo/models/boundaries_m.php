<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Boundaries_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
				$this->load->library('color');
    }

		function get_color($index, $function)
		{
			$rgb = array('59','164','21');


			$hsv = $this->color->rgb2hsv($rgb);
			
			$factor = (float)$index/2;

			$h = $hsv[0] - $factor;

			$rgb = $this->color->hsv2rgb(array($h,$hsv[1],$hsv[2]));

			return implode(',',$rgb);
			
		}
		
		

		function get_values($id=0,$function)
		{
			
			$values = 0;
						
			if($function == 1 && $id!=0)
			{

					if($data = $this->db->get_where('coverage', array('zip_id' => $id))->row())
					{

						$values = $data->value;

					}

			}
			elseif($function == 2 && $id!=0)
			{
				if($data = $this->db->get_where('performance', array('zip_id' => $id))->row())
				{

					$values = $data->value;

				}
			}
			
			return $values;

		}
    
    function get_boundaries($zoom=3,$function=NULL)
    {
			
			$zipcodes = $this->db->get_where('geo_boundaries', array('zoom' => $zoom))->result();
			
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
				
				$value = $this->get_values($zipcode->id, $function);
				
				if($zoom == 2)
				{
					$value = 100;
					$function = 1;
				}
				
				$zip[] = array(
					'zip' => $zipcode->zip,
					'title'=> $zipcode->title,
					'correlation' => $this->get_color($value, $function),
					'vl' => $value,
					'coordinates' => $coord
				);
			
				$i++;
			}
			
			return $zip;
			
    }

}