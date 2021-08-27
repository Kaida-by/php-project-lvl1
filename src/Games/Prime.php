<?php

namespace Brain\Games\Prime;

function getDataPrime(): array
{
    $data['textQuestion'] = 'Answer "yes" if given number is prime. Otherwise answer "no".';
    $action = [random_int(1, 100)];
    $data['actionQuestion'] = $action[0];
    $data['trueAnswer'] = trueAnswer($action);

    return $data;
}

function trueAnswer(array $action): string
{
    $highestIntegralSquareRoot = floor(sqrt($action[0]));

    for ($i = 2; $i <= $highestIntegralSquareRoot; $i++) {
        if ($action[0] % $i === 0) {
            return 'no';
        }
    }

    return 'yes';
}
