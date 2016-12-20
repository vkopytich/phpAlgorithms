<?php

$graph = array(
	array(0, 13, 13, 0, 0, 0),
	array(0, 0, 10, 12, 0, 0),
	array(0, 4, 0, 0, 14, 0)
);

define('V', count($graph));

function bfs($graph, $s, $t, $parent) {
	$visited = [];
	for($i=0; $i < V; ++$i)
		$visited[$i] = false;

	$queue = [];
	array_push($queue, $s);
	$visited[$s] = true;
	$parent[$s] = -1;
	while(count($queue) != 0) {
		$u = array_shift($queue);
		for($v=0; $v < V; $v++) {
			if($visited[$v] == false && $graph[$u][$v] > 0) {
				array_push($queue, $v);
				$parent[$v] = true;
			}
		}
	}
	return ($visited[$t] == true);
}

function fordFulkerson($graph, $s, $t) {
	$rGraph = array();
	for($u=0; $u < V; $u++)
		for($v=0; $v < V; $v++)
			$rGraph[$u][$v] = $graph[$u][$v];

	$parent = [];
	$max_flow = 0;

	while(bfs($rGraph, $s, $t, $parent)) {
		$path_flow = PHP_INT_MAX;

		for($v=$t; $v != $s; $v = $parent[$v]) {
			$u = $parent[$v];
			$path_flow = min($path_flow, $rGraph[$u][$v]);
		}

		for($v=$t; $v != $s; $v = $parent[$v]) {
			$u = $parent[$v];
            $rGraph[$u][$v] -= $path_flow;
            $rGraph[$v][$u] += $path_flow;
		}
		$max_flow += $path_flow;
	}
	return $max_flow;
}

echo "Maximal possible flow is " . fordFulkerson($graph, 0, 5);