<?php
include('/var/www/agdash/include/class-json.php');
$data = file_get_contents('http://www.cnn.com/interactive/2010/10/world/counter.chilean.miners/data/config.json');

$json = new Services_JSON();
$value = $json->decode($data);
echo "<center>Chilean miner's Rescued / Underground<br>";
echo $value->RESCUED . ' / ' . $value->UNDERGROUND . '</center>';
?>
