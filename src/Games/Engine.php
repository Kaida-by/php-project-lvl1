<?php

namespace Brain\Games\Engine;

use function cli\line;
use function cli\prompt;

function engine(string $nameGame)
{
    line('Welcome to the Brain Games!');
    $name = prompt('May I have your name?');
    line("Hello, %s!", $name);

    $i = 0;

    while ($i < 3) {
        if ($nameGame === 'even') {
            $textQuestion = 'Answer "yes" if the number is even, otherwise answer "no".';
            $action = [random_int(1, 100)];
            $actionQuestion = $action[0];
            $trueAnswer = trueAnswer($action, $nameGame);
            $falseAnswer = '\'no\' is wrong answer ;(. Correct answer was \'yes\'. Let\'s try again, ' . $name . '!';
        } elseif ($nameGame === 'calc') {
            $textQuestion = 'What is the result of the expression?';
            $numberOne = random_int(1, 100);
            $numberTwo = random_int(1, 100);
            $action = [$numberOne, $numberTwo];
            $operation = randMathOperation();
            $actionQuestion = $numberOne . $operation . $numberTwo;
            $trueAnswer = (string)trueAnswer($action, $nameGame, $operation);
        } else {
            line('3');
        }

        if ($i === 0) {
            line($textQuestion);
        }

        line('Question: ' . $actionQuestion);
        $answer = prompt('Your answer: ');

        if ($nameGame === 'calc') {
            $falseAnswer = '\'' . $answer . '\' is wrong answer ;(. Correct answer was \'' . $trueAnswer .
                '\'. Let\'s try again, ' . $name . '!';
        }

        if ($answer === $trueAnswer) {
            line('Correct!');
        } else {
            line($falseAnswer);
            break;
        }
        $i++;
    }
    if ($i === 3) {
        line('Congratulations, %s!', $name);
    }
}

function randMathOperation(): string
{
    return ['+', '-', '*'][random_int(0, 2)];
}

function trueAnswer(array $action, string $nameGame, $operation = null)
{
    if ($nameGame === 'even') {
        return !($action[0] & 1) ? 'yes' : 'no';
    }

    return match ($operation) {
        '+' => $action[0] + $action[1],
        '-' => $action[0] - $action[1],
        default => $action[0] * $action[1],
    };
}
