<?php
class modServerstatusHelper{
	function trazi_izmedju_trimaj($limit1, $limit2, $string){
		$data = substr($string, 0, strpos($string, $limit2));
		$data = strstr($data, $limit1);
		$data = strip_tags($data);
		$temp_array = explode (":", $data, 2);
		return trim($temp_array[1]);
	}
	
	function trazi_izmedju($limit1, $limit2, $string){
		$data = substr($string, 0, strpos($string, $limit2));
		$data = strstr($data, $limit1);
		return $data;
	}
	
	function player_list($output){
		$data = modServerstatusHelper::trazi_izmedju($limit1 = "Players:", $limit2 = "Total:", $output);
		$data_array = explode ("<tr>", $data);
		foreach ($data_array as $key => $data){
			$data_array[$key] = explode ("<td", $data_array[$key]);
			$data_array[$key][1] = htmlentities(preg_replace('/.*\/playerstats\/cod4\/(.*)\/\">.*/s', '$1', $data_array[$key][1]));
			$data_array[$key][2] = preg_replace('/.*size=\"2\">(.*)<\/font>.*/s', '$1', $data_array[$key][2]);
			$data_array[$key][3] = preg_replace('/.*size=\"2\">(.*)<\/font>.*/s', '$1', $data_array[$key][3]);
		}
		foreach ($data_array as $key => $value) {
			if (is_null($value) || $value == "" || $value == " ") {
				unset($data_array[$key]);
			}
		} 
		return $data_array;
	}
}
?>