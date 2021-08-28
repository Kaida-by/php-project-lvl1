<?php

namespace Brain\Engine;

use function Brain\Games\Calc\getDataCalc;
use function Brain\Games\Gcd\getDataGcd;
use function Brain\Games\Progression\getDataProgression;
use function Brain\Games\Even\getDataEven;
use function Brain\Games\Prime\getDataPrime;
use function cli\line;
use function cli\prompt;

function engine(string $nameGame): void
{
    $data = [];
    line('Welcome to the Brain Games!');
    $name = prompt('May I have your name?');
    line("Hello, %s!", $name);
    $i = 0;

    while ($i < 3) {
        if ($nameGame === 'even') {
            $data = getDataEven();
        } elseif ($nameGame === 'calc') {
            $data = getDataCalc();
        } elseif ($nameGame === 'gcd') {
            $data = getDataGcd();
        } elseif ($nameGame === 'progression') {
            $data = getDataProgression();
        } elseif ($nameGame === 'prime') {
            $data = getDataPrime();
        }

        if ($i === 0) {
            line($data['textQuestion']);
        }

        line('Question: ' . $data['actionQuestion']);
        $answer = prompt('Your answer: ');

        $data['falseAnswer'] = '\'' . $answer . '\' is wrong answer ;(. Correct answer was \'' .
            $data['trueAnswer'] . '\'. Let\'s try again, ' . $name . '!';

        if ($answer === $data['trueAnswer']) {
            line('Correct!');
        } else {
            line($data['falseAnswer']);
            break;
        }
        $i++;
    }

    if ($i === 3) {
        line('Congratulations, %s!', $name);
    }
}
