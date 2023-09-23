<?php

namespace Project\Functions;

class Exercise4 {
    public static function factorial(int $n): int {
        $result = 1;
        for ($i = 1; $i <= $n; $i++) {
            $result *= $i;
        }
        return $result;
    }
}