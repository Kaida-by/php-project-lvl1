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
            $trueAnswer = (string) trueAnswer($action, $nameGame, $operation);
        } elseif ($nameGame === 'gcd') {
            $textQuestion = 'Find the greatest common divisor of given numbers.';
            $numberOne = random_int(1, 50);
            $numberTwo = random_int(50, 100);
            $action = [$numberOne, $numberTwo];
            $actionQuestion = $numberOne . ' ' . $numberTwo;
            $trueAnswer = (string) trueAnswer($action, $nameGame);
        } elseif ($nameGame === 'progression') {
            $textQuestion = 'What number is missing in the progression?';
            $currentArray = getProgression();
            $randIndex = random_int(0, count($currentArray));
            $trueAnswer = (string) $currentArray[$randIndex];
            $currentArray[$randIndex] = '..';
            $result = implode(' ', $currentArray);
            $actionQuestion = $result;
        } elseif ($nameGame === 'prime') {
            $textQuestion = 'Answer "yes" if given number is prime. Otherwise answer "no".';
            $action = [random_int(1, 100)];
            $actionQuestion = $action[0];
            $trueAnswer = trueAnswer($action, $nameGame);
            $falseAnswer = '\'no\' is wrong answer ;(. Correct answer was \'yes\'. Let\'s try again, ' . $name . '!';
        }

        if ($i === 0) {
            line($textQuestion);
        }

        line('Question: ' . $actionQuestion);
        $answer = prompt('Your answer: ');

        if ($nameGame === 'calc' || $nameGame === 'gcd' || $nameGame === 'progression') {
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

function getProgression(): array
{
    $result = [];
    $i = 0;
    $current = 0;
    $randStep = random_int(1, 10);
    $randLength = random_int(5, 10);

    while ($i < $randLength) {
        $result[] = $current += $randStep;
        $i++;
    }

    return $result;
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

    if ($nameGame === 'gcd') {
        return gmp_gcd($action[0], $action[1]);
    }

    if ($nameGame === 'prime') {
        return gmp_prob_prime($action[0]) === 2 ? 'yes' : 'no';
    }

    return match ($operation) {
        '+' => $action[0] + $action[1],
        '-' => $action[0] - $action[1],
        default => $action[0] * $action[1],
    };
}
