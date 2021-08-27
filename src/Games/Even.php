<?php

namespace Brain\Games\Even;

function getDataEven(): array
{
    $data['textQuestion'] = 'Answer "yes" if the number is even, otherwise answer "no".';
    $action = [random_int(1, 100)];
    $data['actionQuestion'] = $action[0];
    $data['trueAnswer'] = trueAnswer($action);

    return $data;
}

function trueAnswer(array $action): string
{
    return !($action[0] & 1) ? 'yes' : 'no';
}
