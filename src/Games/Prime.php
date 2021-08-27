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
    return gmp_prob_prime($action[0]) === 2 ? 'yes' : 'no';
}
