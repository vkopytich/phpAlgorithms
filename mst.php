<?php

$graph = array(
	0 => array(0, 4, 0, 0, 0, 0, 0, 0),
 	1 => array(4, 0, 8, 0, 0, 0, 0, 0),
 	2 => array(0, 8, 0, 7, 0, 4, 2, 0),
    3 => array(0, 0, 7, 0, 9, 14, 0, 0),
    4 => array(0, 0, 0, 9, 0, 10, 0, 0),
    5 => array(0, 0, 4, 14, 10, 0, 0, 2),
 	6 => array(0, 0, 2, 0, 0, 0, 0, 6),
 	7 => array(0, 0, 0, 0, 0, 2, 6, 0)
);

function prim(&$graph, $start) {
	$q = array();
	$p = array();

	foreach(array_keys($graph) as $k)
		$q[$k] = INF;

	$q[$start] = 0;
	$p[$start] = null;

	asort($q);

	while($q) {
		$keys = array_keys($q);
		$u = $keys[0];

		foreach($graph[$u] as $v => $weight) {
			if($weight > 0 && in_array($v, $keys) && $weight < $q[$v]) {
				$p[$v] = $u;
				$q[$v] = $weight;
			}
		}

		unset($q[$u]);
		asort($q);
	}
	return $p;
}

$mst = prim($graph, 1);
foreach ($mst as $v)
    echo $v . PHP_EOL;
echo "<br/>";

// Вывод: 1 1 2 2 2 5 3 
 
function Kruskal(&$graph) {
    $len = count($graph);
    $T = array();
 
    $S = array();
    foreach (array_keys($graph) as $k)
        $S[$k] = array($k);
 
    $weights = array();
    for ($i = 0; $i < $len; $i++) {
        for ($j = 0; $j < $i; $j++) {
            if (!$graph[$i][$j]) continue;
 
            $weights[$i . ' ' . $j] = $graph[$i][$j];
        }
    }
    asort($weights);
 
    foreach ($weights as $k => $w) {
        list($i, $j) = explode(' ', $k);
 
        $iSet = find_set($S, $i);
        $jSet = find_set($S, $j);
        if ($iSet != $jSet) {
            $T[] = "Ребро: ($i, $j)<br/>";
            union_sets($S, $iSet, $jSet);
        }
    }
 
    return $T;
}
 
function find_set(&$set, $index) {
    foreach ($set as $k => $v)
        if (in_array($index, $v)) 
            return $k;
 
    return false;
}
 
function union_sets(&$set, $i, $j) {
    $a = $set[$i];
    $b = $set[$j];
    unset($set[$i], $set[$j]);
    $set[] = array_merge($a, $b);
}
 
$mst = Kruskal($graph);

foreach ($mst as $v)
    echo $v . PHP_EOL;

// Вывод:
// 
// Ребро: (6, 2)
// Ребро: (7, 5)
// Ребро: (1, 0)
// Ребро: (5, 2)
// Ребро: (3, 2)
// Ребро: (2, 1)
// Ребро: (4, 3)
