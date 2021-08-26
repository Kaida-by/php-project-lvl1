<?php

namespace Brain\Games\Even;

use function cli\line;
use function cli\prompt;

function even()
{
    line('Welcome to the Brain Game!');
    $name = prompt('May I have your name?');
    line("Hello, %s!", $name);
    line('Answer "yes" if the number is even, otherwise answer "no".');
    $i = 0;

    while ($i < 3) {
        $number = random_int(1, 100);
        line('Question: ' . $number);
        if (isEven($number)) {
            $answer = prompt('Your answer: ');
            if ($answer === 'yes') {
                line('Correct!');
            } else {
                line('\'no\' is wrong answer ;(. Correct answer was \'yes\'. Let\'s try again, %s!', $name);
                break;
            }
        } else {
            $answer = prompt('Your answer: ');
            if ($answer === 'no') {
                line('Correct!');
            } else {
                line('\'yes\' is wrong answer ;(. Correct answer was \'no\'. Let\'s try again, %s!', $name);
                break;
            }
        }
        $i++;
    }
    if ($i === 3) {
        line('Congratulations, %s!', $name);
    }
}

function isEven($number): bool
{
    return !($number & 1);
}
