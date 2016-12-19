<?php

class Graph
{
	protected $graph = array();
	protected $visited = array();
	protected $comp = array();

	public function __construct($graph)
	{
		$this->graph = $graph;
	}

	/**
	 * Функция поиска в глубину и нахождение цикла
	 */
	public function dfs($vertex)
	{
		$this->visited[$vertex] = true;
		array_push($this->comp, $vertex);
		for($i=0; $i < count($this->graph[$vertex]); ++$i) {
			$to = $this->graph[$vertex][$i];
			if($to == 0){
				if($this->dfs($to))
					return true;
			} else if($to == 1){
				$cycle_end = $vertex;
				$cycle_st = $to;
				return true;
			}
		}
		return false;
	}

	/**
	 * Функция поиска компонент связности
	 */
	public function find_comps()
	{
		for($i=0; $i < 10; ++$i)
			$this->visited[$i] = false;

		for($i=0; $i < 10; ++$i) {
			if(!$this->visited[$i]){
				$this->comp = array();
				$this->dfs($i);

				echo "Компонента связности #{$i}: ";
				for($j=0; $j < count($this->comp); ++$j)
					echo $this->comp[$j]." ";
				echo "<br>";
			}
		}
	}
}

$graph = array(
	'A' => array('B','E','C'),
	'B' => array('A','F','D'),
	'C' => array('A','K'),
	'D' => array('B','G'),
	'E' => array('A','I','J'),
	'F' => array('B','G'),
	'G' => array('F','D','I','K'),
	'I' => array('E','G'),
	'J' => array('E'),
	'K' => array('G','C'),
	'L' => array('M'),
	'M' => array('L')
);
$cycle_st = -1;

$g = new Graph($graph);
$g->dfs('A')->find_comps();

echo '\n';

if($cycle_st == -1){
	echo 'Ацикличный граф';
} else{
	echo 'Цикличный граф \n';
	$cycle = array();
	array_push($cycle, $cycle_st);
	for($v=$cycle_end; $v != $cycle_st; $v=$g->visited[$v])
		array_push($cycle, $v);
	array_push($cycle, $cycle_st);

	echo 'Циклы: \n';
	for($i=0; $i < count($cycle); $i++)
		echo $cycle[$i].'\n';
}

//
// Вывод: 
// 
// Проход по графу с помощью алгоритма DFS: A B F G K C D E I J L M 
// 
// Компонента связности #1: A B F G K C D E I J
// Компонента связности #2: L M
// 
// Цикличный граф
// Циклы:
// 	A B F G K C
// 	A B F G I E
// 	A C K G I E
// 	B F G D
// 