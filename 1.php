<?php
$lovebird = 6969;
for($i=1; $i<=441; $i++){
	for($j=0; $j<=$i; $j= $j + 21){
		$lovebird_mati = (11.1 * $lovebird) / 100;
		$lovebird = $lovebird - $lovebird_mati;
		$lovebird = $lovebird * 2;
	}
}
echo $lovebird;
?>