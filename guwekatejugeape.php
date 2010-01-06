<?php

$number = $_GET["number"];
if (($number) === "NaN"){
	exit("Simon said... number");
}

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
	8=> 'trilyun trilyun');//whatever

$words = "";

$number = strrev($number);
$packet = str_split($number, 3);

//print_r($packet);

foreach ($packet as $unit=>$value){
	$added_words = "";
	
	$hundreds = substr($value, 2, 1);
	$tens = substr($value, 1, 1);
	$ones = substr($value, 0, 1);

	//special cases
	if ($ones == 1 && $tens == 0 && $hundreds == 0 && $unit == 1){
		$words = "seribu $words ";
		continue;
	}else if ($ones == 0 && $tens == 0 && $hundreds == 0){
		continue;
	}
	//ratusan
	if ($hundreds == 1){
		$added_words = "seratus ";
	}else if ($hundreds > 1){
		$added_words = get_num_name($hundreds)." ratus ";
	}
	//echo "<br />ratusan = $ratusan";

	//puluhan && satuan
	if ($tens == 0){
		$added_words .= get_num_name($ones);
	} else if ($tens == 1){
		if ($ones == 0){
			$added_words .= "sepuluh";
		}else if ($ones == 1) {
			$added_words .= "sebelas";
		}else {
			$added_words .= get_num_name($ones)." belas";
		}
	}else {
		$added_words .= get_num_name($tens)." puluh ";
		if ($ones != 0)
			$added_words .= get_num_name($ones);
	}

	//depend on $unit
	$words = $added_words." ".$unit_name[$unit]." ".$words." ";

}

$number = str_split($number, 3);
foreach ($number as $unit=>$value){
	$real_number = strrev($value).$real_number;
	if (!empty($number[$unit+1]))
		$real_number = ".".$real_number;
}
echo "$real_number : <strong>$words</strong>";

?>
