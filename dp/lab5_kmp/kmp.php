<?php

function kmp_search ($pat, $txt) {
	$M = strlen($pat);
	$N = strlen($txt);
	$lps = array();
	$found_pat = array();
	$i=0;
	$j=0;

	compute_lps($pat, $M, $lps);

	while ($i < $N) {
		if ($pat[$j] == $txt[$i]) {
			$i++;
			$j++;
		}

		if ($j == $M) {
			array_push($found_pat, $i - $j);
			$j = $lps[$j - 1];
		} elseif ($i < $N && $pat[$j] != $txt[$i]) {
			if ($j != 0)
				$j = $lps[$j - 1];
			else
				$i++;
		}
	}

	return $found_pat;
}

function compute_lps ($pat, $M, &$lps) {
	$len = 0;
	$lps[0] = 0;

	$i = 1;
	while ($i < $M) {
		if ($pat[$i] == $pat[$len]) {
			$len++;
			$lps[$i] = $len;
			$i++;
		} else {
			if ($len != 0) {
				$len = $lps[$len - 1];
			} else {
				$lps[$i] = 0;
				$i++;
			}
		}
	}
}


$text = "the quick brown the fox jumps over the lazy dog";
$pattern = "the";

$value = kmp_search($pattern, $text);

echo implode(', ', $value);



