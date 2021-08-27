<?php

namespace Brain\Games\Calc;

function getDataCalc(): array
{
    $data['textQuestion'] = 'What is the result of the expression?';
    $numberOne = random_int(1, 100);
    $numberTwo = random_int(1, 100);
    $action = [$numberOne, $numberTwo];
    $operation = randMathOperation();
    $data['actionQuestion'] = $numberOne . $operation . $numberTwo;
    $data['trueAnswer'] = trueAnswer($action, $operation);

    return $data;
}

function randMathOperation(): string
{
    return ['+', '-', '*'][random_int(0, 2)];
}

function trueAnswer(array $action, ?string $operation): string
{
    return match ($operation) {
        '+' => $action[0] + $action[1],
        '-' => $action[0] - $action[1],
        default => $action[0] * $action[1],
    };
}
