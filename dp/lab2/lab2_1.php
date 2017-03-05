<?php

function genereate_array($size) {
	$arr = array();
	
	for($i=0; $i <= $size; $i++)
		for($j=0; $j <= $i; $j++)
			$arr[$i][$j] = rand(0, 9);

	return $arr;
}

function print_arr($arr) {
	foreach ($arr as $str) {
		foreach ($str as $num)
			echo $num . ' ';

		echo "<br/>";
	}
	echo "<br/>";
}

function result_array($array) {
	$res = array();

	for($i=0; $i <= count($array); $i++)
		for($j=0; $j < count($array[$i]); $j++)
			$res[$i][$j] = ($i == 0) ? $array[$i][$j] : (($j == 0) ? $array[$i][$j] + $res[$i-1][$j] : (($j == count($res[$i]) - 1) ? $array[$i][$j] + $res[$i-1][$j-1] : max($array[$i][$j] + $res[$i-1][$j], $array[$i][$j] + $res[$i-1][$j-1])));
		
	return $res;
}

function find_max_sum($array) {
	return max(array_pop($array));
}

function restore_path($array, $res_arr, $max_elem) {
	echo "Путь, по которому прошлись - ";
	
	for($i=count($res_arr); $i > 0; $i--) {
		for($j=0; $j < count($res_arr[$i]); $j++) {
			if($res_arr[$i][$j] == $max_elem) {
				echo $array[$i][$j] . "(".($i+1).", ".($j+1).") <- ";
				$max_elem -= $array[$i][$j];
				break;
			}
		}
	}
	echo "{$array[0][0]}(1, 1) <br/>";
}

$array = genereate_array(5);
$after_sum = result_array($array);
$max_sum = find_max_sum($after_sum);

print_arr($array);
print_arr($after_sum);

echo "Максимальная сумма - $max_sum <br/>";

restore_path($array, $after_sum, $max_sum);

