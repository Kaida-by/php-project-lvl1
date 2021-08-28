<?php

namespace Brain\Games\Progression;

function getDataProgression(): array
{
    $data = [];
    $data['textQuestion'] = 'What number is missing in the progression?';
    $currentArray = getProgression();
    $randIndex = random_int(0, count($currentArray) - 1);
    $data['trueAnswer'] = (string) $currentArray[$randIndex];
    $currentArray[$randIndex] = '..';
    $result = implode(' ', $currentArray);
    $data['actionQuestion'] = $result;

    return $data;
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
