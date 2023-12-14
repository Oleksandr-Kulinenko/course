<?php

function create_arr_fibonacci($num,$max_num=34){// second args for max num count arr fibonacci
    if($num<=$max_num){
        if($num>=2){
            $arr = array(0,1);
            for($i=0;$i<$num;$i++){
                if($i==0){
                    $res_arr = array(0,1);
                }
                if(count($res_arr)<$num){
                    $next_elem = array_sum($arr);
                    array_push($res_arr,$next_elem);
                    $last_elem = array_pop($arr);
                    $arr = array($last_elem,$next_elem);
                }
            }

            // for check str fibonacci
            $str_fib_out = '';
            for($k=0;$k<count($res_arr);$k++){
                $str_fib_out .= $res_arr[$k].",";
            }
            $str_fib_final = substr($str_fib_out,0,-1);// in variable str fibonacci for check first part home work

            return $res_arr;
        }else{
            return array(0);
        }
    }else{
        return array(0);
    }
}

function sum_fibonacci($num){
    echo "Сума ряду фібоначчі: ".array_sum(create_arr_fibonacci($num));//function create arr fibonacci can accept two args, second args for max num count arr fibonacci, default 34
}

sum_fibonacci(15);
