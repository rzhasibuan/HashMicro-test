<?php

namespace App\Services;

class CharacterCompareService extends Service
{
    public function compare(string $character1, string $character2): array
    {
        $character1 = strtoupper($character1);
        $character2 = strtoupper($character2);

        $chars1 = str_split($character1);
        $chars2 = str_split($character2);

        $matchCount = 0;

        for ($i = 0; $i < count($chars1); $i++) {

            for ($j = 0; $j < count($chars2); $j++) {

                if ($chars1[$i] === $chars2[$j]) {
                    $matchCount++;
                    unset($chars2[$j]);
                    $chars2 = array_values($chars2);
                    break;
                }

            }

        }

        $percentage = count($chars1) > 0 ? ($matchCount / count($chars1)) * 100 : 0;
        return $this->finalResultSuccess([
            "character1" => $character1,
            "character2" => $character2,
            "percentage" => $percentage,
        ]);
    }


}
