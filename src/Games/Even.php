<?php

namespace Brain\Games\Even;

function getDataEven(): array
{
    $data = [];
    $data['textQuestion'] = 'Answer "yes" if the number is even, otherwise answer "no".';
    $action = [random_int(1, 100)];
    $data['actionQuestion'] = $action[0];
    $data['trueAnswer'] = trueAnswer($action) ? 'yes' : 'no';

    return $data;
}

function trueAnswer(array $action): bool
{
    return !($action[0] & 1);
}
