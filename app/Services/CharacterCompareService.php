<?php

namespace App\Services;

class CharacterCompareService extends Service
{
    public function compare(string $character1, string $character2): array
    {
        $chars = str_split($character1);
        $chars2 = str_split($character2);

        $matchCount = 0;
        foreach ($chars as $index => $char) {
            $key = array_search($char, $chars2);
            if ($key !== false) {
                $matchCount++;
                unset($chars2[$key]);
            }
        }

        $percentage = count($chars) > 0 ? ($matchCount / count($chars)) * 100 : 0;

        return $this->finalResultSuccess([
            "character1" => $character1,
            "character2" => $character2,
            "percentage" => $percentage,
        ]);
    }

}
