<?php

require_once 'Xorshift.php';

showRandomNumbers(10);

function showRandomNumbers($count)
{
    $seed = 987654321;
    echo 'seed=' . $seed . PHP_EOL;

    $rnd = new Xorshift($seed);

    echo 'All range rand.' . PHP_EOL;
    for ($i = 0; $i < $count; $i++)
    {
        echo $i . ': ' . $rnd->next() . PHP_EOL;
    }

    echo 'Range(1-101) rand.' . PHP_EOL;
    for ($i = 0; $i < $count; $i++)
    {
        echo $i . ': ' . $rnd->nextRange(1, 101) . PHP_EOL;
    }
}