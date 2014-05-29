<?php
/**
 * @version   $Id: default.php 22355 2011-11-07 05:11:58Z github_bot $
 * @package   Joomla.Site
 * @subpackage  mod_breadcrumbs
 * @copyright Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

$doc =& JFactory::getDocument();
$doc->addStyleSheet ( 'modules/mod_cod4_serverstatus/css/adaptive.css' ); //dodati drgi stylesheet za vertical i horizontal
?>
<div class="cod4serverstatus_holder">
  <div class="cod4serverstatus_left">
    <? echo '<img src="'.$baseurl.'images/serverstats/mp_'.$map_name.'.jpg" alt="'.$map_name.'" />'; ?>
    <p><?=$server_name?></p>
    <p> IP: <? if ($defined_server_ip_link =="") echo '<b>'.$server_ip.'</b>'; else echo '<a href="http://'.$defined_server_ip_link.'" target="_blank"><b>'.$server_ip.'</b></a>'; ?></p>
    <p>Current map: <?=$map_name?></p>
    <p>Game type: <?=$game_type?></p>
    <p>Number of players: <?=$player_number?></p>
  </div>

  <div class="cod4serverstatus_right">
    <div class="cod4serverstatus_player">Player:</div>
    <div class="cod4serverstatus_ping">Ping</div>
    <div class="cod4serverstatus_score">Score</div>
    <?
      $number_of_players = count($player_list_array) -1;
      for ($i=1;$i<$number_of_players;$i++){
        echo '<div class="cod4serverstatus_player">';
        if ($player_stats_link == 1) echo '<a href="http://battletracker.com/playerstats/cod4/'.$player_list_array[$i][1].'/" target="_blank">';
        echo $player_list_array[$i][1];
        if ($player_stats_link == 1) echo '</a>';
        echo '</div><div class="cod4serverstatus_ping">'.$player_list_array[$i][3].'</div><div class="cod4serverstatus_score">'.$player_list_array[$i][2].'</div>';
      }
    ?>
  </div>
    
  <?php if($server_banner == 1){ ?>
  <div class="cod4serverstatus_banner">
    <a href="http://www.gametracker.com/server_info/<?php echo $server_ip; ?>:<?php echo $server_port; ?>/" target="_blank">
      <img src="http://cache.www.gametracker.com/server_info/<?php echo $server_ip; ?>:<?php echo $server_port; ?>/b_560_95_1.png" border="0" width="100%" alt=""/>
    </a>
  </div>
  <?php } ?>
</div>