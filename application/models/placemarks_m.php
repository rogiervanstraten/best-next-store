<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Placemarks_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function get_placemarks()
    {
			
			$this->load->library('googlegeocoding');
						
			$places = $this->db->get('places')->result();
			
			$placemarks = array();
			
			foreach ($places as $place) {
				
				if($place->lat != (float)0 && $place->long != (float)0)
				{
					
					$placemarks[] = array(
						'lat' => $place->lat,
						'lng' => $place->long,
						'title' => $place->title
					);
					
				}
				elseif($coords = $this->googlegeocoding->getLngLat($place->address))
				{
					//$coords = $this->getLatLong($place->address);
					
					$data = array(
						'lat' => $coords['lat'],
						'long' => $coords['lng']
					);
					
					$this->db->update('places', $data ,array('id' => $place->id));
					
					$placemarks[] = array(
						'lat' => $coords['lat'],
						'lng' => $coords['lng'],
						'title' => $place->title
					);
					
				}
			
			}
			
			return $placemarks;
			
		}

}