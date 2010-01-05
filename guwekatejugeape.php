<?php 
$number = $_GET["number"];
$real_number = $number;

function get_num_name ($num) {
	switch ($num){
	case 0:
		return "";
	case 1:
		return "satu";
	case 2:
		return "dua";
	case 3:
		return 'tiga';
	case 4:
		return 'empat';
	case 5:
		return 'lima';
	case 6:
		return 'enam';
	case 7:
		return 'tujuh';
	case 8:
		return 'delapan';
	case 9:
		return 'sembilan';
	}
}

$unit_name = array(
	1=> 'ribu',
	2=> 'juta',
	3=> 'milyar',
	4=> 'trilyun',
	5=> 'ribu trilyun',
	6=> 'juta trilyun',
	7=> 'milyar trilyun',
	8=> 'trilyun trilyun');//it's up to you

$words = "";

$number = strrev($number);
$packet = str_split($number, 3);

//print_r($packet);

foreach ($packet as $key=>$value){
	$added_words = "";
	
	$ratusan = substr($value, 2, 1);
	$puluhan = substr($value, 1, 1);
	$satuan = substr($value, 0, 1);
	
	if ($satuan == 1 && $puluhan == 0 && $ratusan == 0 && $key == 1){
		$words = "seribu $words";
		continue;
	}
	//ratusan
	if ($ratusan == 1){
		$added_words = "seratus ";
	}else if ($ratusan > 1){
		$added_words = get_num_name($ratusan)." ratus ";
	}
	//echo "<br />ratusan = $ratusan";

	//puluhan && satuan
	$puluhan = substr($value, 1, 1);
	if ($puluhan == 0){
		if ($satuan >=1 ){
			$added_words .= get_num_name($satuan);
		}
	} else if ($puluhan == 1){
		if ($satuan == 0){
			$added_words .= "sepuluh ";
		}else if ($satuan == 1) {
			$added_words .= "sebelas ";
		}else {
			$added_words .= get_num_name($satuan)." belas ";
		}
	}else {
		$added_words .= get_num_name($puluhan)." puluh ";
		if ($satuan != 0)
			$added_words .= get_num_name($satuan);
	}

	//echo "<br />puluhan dan satuan = $puluhan, $satuan<br />";
	//echo "added words $added_words<br />";
	//depend on $keys
	$words = (($added_words == '')?'':$added_words." ".$unit_name[$key])." ".$words." ";

}

$real_number = str_split(strrev($real_number), 3);
foreach ($real_number as $value)
	$real =strrev(".".$value).$real;
echo "$real in words = $words";
	
?>
