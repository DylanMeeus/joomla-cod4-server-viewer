<?php
/**
 * CoD 4 Server Status Module Entry Point
 * 
 * @license        GNU/GPL, see LICENSE.php
 * mod_cod4_serverstatus is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once (dirname(__FILE__).DS.'helper.php');
// get vars defined in module administration
$server_ip = $params->get( 'server_ip' );
$server_port = $params->get( 'server_port' );
$defined_server_name = $params->get( 'server_name' );
$defined_server_name_link = $params->get( 'server_name_link' );
$defined_server_ip_link = $params->get( 'server_ip_link' );
$player_stats_link = $params->get( 'player_stats_link' );
$server_banner = $params->get('gametracker_server_banner');

//connect to server data on battletracker
$tuCurl = curl_init("http://battletracker.com/webspec/cod4/index.php?addr=".$server_ip.":".$server_port."");
curl_setopt($tuCurl, CURLOPT_HEADER, 0);
curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec($tuCurl); 

curl_close($tuCurl);

// Select the variables from the $output array

if ($defined_server_name == ""){
	$server_name = modServerstatusHelper::trazi_izmedju_trimaj($limit1 = "Servername:", $limit2 = "IP Address / Port:", $output);
}
else {
	$server_name = $defined_server_name;
}
if ($defined_server_name_link != ""){
	$server_name = '<a href="http://'.$defined_server_name_link.'">'.$server_name.'</a>';
}
$defined_server_name_link = str_replace("http://", "", $defined_server_name_link);
$defined_server_ip_link = str_replace("http://", "", $defined_server_ip_link);
$server_ip = modServerstatusHelper::trazi_izmedju_trimaj($limit1 = "IP Address / Port:", $limit2 = "Mapname:", $output);
$server_ip_no_port_array = explode (":", $server_ip);
$server_ip_no_port = $server_ip_no_port_array[0];
$map_name = modServerstatusHelper::trazi_izmedju_trimaj($limit1 = "Mapname:", $limit2 = "Game Type:", $output);
$game_type = modServerstatusHelper::trazi_izmedju_trimaj($limit1 = "Game Type:", $limit2 = "Server Version:", $output);
if ($game_type == "war") $game_type = TDM;
$player_number = modServerstatusHelper::trazi_izmedju_trimaj($limit1 = "Players (current/max.):", $limit2 = "Players:", $output);
$player_list_array = modServerstatusHelper::player_list($output);
 
require JModuleHelper::getLayoutPath('mod_cod4_serverstatus', $params->get('layout', 'default'));
?>