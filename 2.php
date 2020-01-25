<?php
$data = ['h', 'g', 'a', 'b', 'd', 'f'];
// echo "<pre>";
// print_r($data);
$jumlah = sizeof($data);
for($i=0; $i<$jumlah-1; $i++){
	$j = $i + 1;
	if($data[$i] >= $data[$j]){
		$j = $data[$j];
	}else{
		$temp = $data[$j];
		if($data[$j] >= $temp){
			$maksimal = $data[$j];
		}else{
			$maksimal = $temp;
		}
	}
}
echo "<pre>";
print_r($maksimal);
?>