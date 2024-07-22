<?php

$USE_RUST = false;
if (isset($argv[1])){
    $USE_RUST = true;
}

function getMicroTime(): float{
    return round(microtime(true) * 1000)/1000;
}

function php_process(int $a, int $b): int{
    $that = 1;
    for ($i = 1; $i<1000; $i++){
        for ($j = 1; $j<1000; $j++){
            for ($k = 1; $k<1000; $k++){
                $that *= ($i * $j / $k);
            }
        }
    }
    echo $that;
    return (($a + ($b * 770)) - $a) * $b;
}

function add(int $a, int $b): int{
    global $USE_RUST;

    if ($USE_RUST){
        echo ">> WITH RUST\n";
        return rs_process($a, $b);
    }
    echo ">> NO RUST\n";
    return php_process($a, $b);
}

$start = getMicroTime();
var_dump(add(5, 2));
echo "\ndone in ".(getMicroTime() - $start)."s";
