<?php

// wt - массив положительных целых весов, val - массив положительных целых стоимостей
$wt = array(1=>4, 5, 3, 7, 6);
$val = array(1=>5, 7, 4, 9, 8);

// W - вместимость рюкзака, n - кол-во предметов
$W = 16;
$n = count($wt);


$V = array();

// Первый столбец и первую строку приравниваем к 0
for($i=1; $i <= $W; $i++)
	$V[0][$i] = 0;
for($i=1; $i <= $n; $i++)
	$V[$i][0] = 0;

// Сам алгоритм
for($k=1; $k <= $n; $k++) {
	for($s=0; $s <= $W; $s++) {
		if ($s >= $wt[$k]) {
			$V[$k][$s] = max($V[$k - 1][$s], $V[$k - 1][$s - $wt[$k]] + $val[$k]);
		} else {
			$V[$k][$s] = $V[$k - 1][$s];
		}
	}
}

// Вывод матрицы подсчетов
echo "Матрица подсчетов:<br/>";
foreach($V as $str) {
	foreach($str as $k => $item) {
		echo $item . " ";
	}
	echo "<br/>";
}
echo "<br/>";
echo "Максимальная стоимость рюкзака - " . $V[$n][$W];
echo "<br/>";

// Поиск предметов, входящих в рюкзак
$res = array();
while($n > 0 && $W > 0) {
	if($V[$n][$W] != $V[$n-1][$W]) {
		$res[] = $n;
		$W -= $wt[$n];
		$n--;
	} else {
		$n--;
	}
}

echo "В набор входят предметы под номерами - " . implode(', ', $res);
