<?php

function reverseArray(array &$nums): void {
    $left = 0;
    $right = (count($nums)-1);
    for ($i = 0; $i <$right/2 ;$i++){
        $change=$nums[$left];
        $nums[$left]=$nums[$right];
        $nums[$right]=$change;
        $left += 1;
        $right -= 1;
    }
}
function maxSubarraySum(array $nums, int $k): int {

}

$test=[2, 1, 5, 1, 3, 2];
reverseArray($test);
var_dump($test);