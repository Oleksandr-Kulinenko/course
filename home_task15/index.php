<?php

    function createArray(): array
    {
        for ($i = 0; $i<11; $i++)
        {
            $arr[] = mt_rand(1,200);
        }
        return $arr;
    }

    function displayArr(array $array): string
    {
        $outString = '[' . implode(', ', $array) . ']';

        return $outString;
    }

    function sortArrByMethodQuickSort(array $arr_in): array
    {

        if(count($arr_in) <= 1){
            return $arr_in;
        }

        $select_element = $arr_in[0];

        $arr_left = array();
        $arr_right = array();

        for($i=1;$i<count($arr_in);$i++) {
            if($arr_in[$i]<$select_element) {
                $arr_left[]= $arr_in[$i];
            }
            else {
                $arr_right[]= $arr_in[$i];
            }
        }

        return array_merge(sortArrByMethodQuickSort($arr_left),array($select_element),sortArrByMethodQuickSort($arr_right));
    }

    //create array for sort
    $arr = createArray();

    //display arr before sort
    echo "Масив до сортування: ".displayArr($arr);

    echo "<br><br>";

    //display arr after sort
    echo "Масив після сортування: ".displayArr(sortArrByMethodQuickSort($arr));


