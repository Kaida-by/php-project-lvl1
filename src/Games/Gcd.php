<?php

namespace Brain\Games\Gcd;

function getDataGcd(): array
{
    $data['textQuestion'] = 'Find the greatest common divisor of given numbers.';
    $numberOne = random_int(1, 50);
    $numberTwo = random_int(50, 100);
    $action = [$numberOne, $numberTwo];
    $data['actionQuestion'] = $numberOne . ' ' . $numberTwo;
    $data['trueAnswer'] = trueAnswer($action);

    return $data;
}

function trueAnswer(array $action): string
{
    return gmp_gcd($action[0], $action[1]);
}
