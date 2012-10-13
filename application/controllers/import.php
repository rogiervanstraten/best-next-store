<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Import extends CI_Controller {
	
	
	public function index()
	{
		
		
	}

	public function kml($filename=NULL)
	{
		$url = FCPATH.'uploads/import/'.$filename;
		
		if($filename!=NULL && file_exists($url))
		{
			
			$this->db->truncate('boundaries');
			
			$xml = new SimpleXMLElement($url, null, true);
			
			if(isset($xml->Document->Folder))
			{
				$folder = $xml->Document->Folder;
			}
			elseif(isset($xml->Document))
			{
				$folder = $xml->Document;
			}
			else
			{
				die('KML FILE NOT CORRECT CONFIGURED');
			}
			
		  foreach ($folder->Placemark as $placemark) {

		  	$name = $placemark->name;
				$lat = $placemark->LookAt->latitude;
				$lng = $placemark->LookAt->longitude;
				$coordinates = '';

				$data = array();

				if(isset($placemark->MultiGeometry->Polygon)){

					foreach ($placemark->MultiGeometry->Polygon as $polygon) {

						$coordinates = $polygon->outerBoundaryIs->LinearRing->coordinates;

						$data = array(
							'zip' => (string)$name,
							'lat' => (float)$lat,
							'lng' => (float)$lng,
							'alt' => '0',
							'title' => (string)$name
							);
						
						//SEPERATE EACH POLY COORDINATE
						
						//print_r($coordinates);
						//REPLACE WHITE SPACE AND EXPLODE IT
						$points = explode(" ", preg_replace('~[\r\n]+~', ' ', trim($coordinates)));						
						
						$new_coords = '';
						
						$i = 1;
						
						$point = $line = array();
						
						foreach ($points as $point) {

							$point = explode(",", $point);
							//print_r($point);
							$long = $point[0];
							$lat = $point[1];
							
							$line[] = $lat.' '.$long;
							
							$i++;
						}
						//print_r($line);					
						
						$coordinates = implode(", ", $line);
											
						$data['polygon'] = $coordinates;
												
						$this->db->insert('boundaries', $data);
						
					}

				}

				//$this->db->insert_batch('boundaries', $data);

		  }
			
		}
		
		echo 'KML FILE INSERTED';

	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */