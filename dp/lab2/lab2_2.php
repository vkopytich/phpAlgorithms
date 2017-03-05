<?php

function find_number($sum, $size) {
	$res = 0;

	if($sum < 0) return 0;

	if($size == 1) {
		if($sum > 9) return 0;
		else return 1;
	} else {
		for($i=0; $i < 10; $i++)
			$res += find_number($sum-$i, $size-1);
	}
	return $res;
}

$size = 7;
$sum = 13;

echo find_number($sum, $size);