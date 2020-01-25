<?php
$string = "DUMBWAYS";
//mengambil salah satu string seperti operator array []
//menghitung jumlah string atau karakter yang terdapat pada suatu variabel menggunakan fungsi strlen()
$jumlah_string = strlen($string);
echo $jumlah_string;
for($i=0; $i<=$jumlah_string ;$i++){
	echo $string[$i];
	// for($j=4; $j>=$i; $j--){
	// 	echo " ";
	// }
	// for($k=$i; $k>=1; $k--){
	// 	echo "$array[$i] ";
	// }
	// echo "<br>";
}
?>