<?php

function edit_distance($str1, $str2) {
    if($str1 === $str2) return 0;
    $count = 0;
    $res = array();
    $len1 = strlen($str1);
    $len2 = strlen($str2);

    for($i=0; $i <= $len1; $i++)
        $res[$i][0] = $i;
    
    for($i=0; $i <= $len2; $i++)
        $res[0][$i] = $i;

    for($i=1; $i <= $len1; $i++) {
        for($j=1; $j <= $len2; $j++) {
            $cost = $str1[$i-1] === $str2[$j-1] ? 0 && $count++ : 1;
            $res[$i][$j] = min($res[$i-1][$j] + 1, $res[$i][$j-1] + 1, $res[$i-1][$j-1] + $cost);
        }
    }

    return $res[$len1][$len2];
}


$str1 = 'Grvski';
$str2 = 'Alex Gurevskiy';
echo 'Растояние Левенштейна - '. edit_distance($str1, $str2).'<br/>';
echo 'Растояние Левенштейна с помощью втроенной функции в PHP - '. levenshtein($str1, $str2); // Встроенная в PHP