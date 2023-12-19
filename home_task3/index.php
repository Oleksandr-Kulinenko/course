<?php

function create_arr_fibonacci($num){// second args for max num count arr fibonacci
    for($i=1;$i<$num;$i++) {
        if ($i == 1) {
            $arr = array(0);
        }

        $sum_arr = array_sum($arr);

        if ($sum_arr < 1 || $sum_arr == 1) {
            $next_elem = 1;
            array_push($arr, $next_elem);
        } else {
            $last_elem = end($arr);
            $prev_elem = prev($arr);

            $next_elem = $last_elem + $prev_elem;
            array_push($arr, $next_elem);
        }
    }

    // for check str fibonacci
    $str_fib_out = '';
    for($k=0;$k<count($arr);$k++){
        $str_fib_out .= $arr[$k].",";
    }
    $str_fib_final = substr($str_fib_out,0,-1);// in variable str fibonacci for check first part home task

    return $arr;
}

function sum_fibonacci($num,$max_num=34)
{
    if ($num <= $max_num) {
        if ($num >= 2) {
            echo "Сума ряду фібоначчі: " . array_sum(create_arr_fibonacci($num));//function create arr fibonacci can accept two args, second args for max num count arr fibonacci, default 34
        }elseif($num<1){
            echo "Для підрахунку суми ряду потрібно ввести число більше від 0";//error if count for sum
        }elseif($num==1){
            echo "Сума одного елемента дорівнює 0";//for
        }
    } else {
        echo "Перевищено максимальну довжину ряду фібоначчі, максимальна довжина складає 34 елементи";//error for input more max count arr fibonacci
    }
}
sum_fibonacci(35);
