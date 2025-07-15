<?php

namespace App\Helpers;

class ArrayHelper
{
    /**
     * Hapus semua elemen bernilai null atau array kosong (rekursif).
     *
     * @param array $array
     * @return array
     */
    public static function filterRecursive(array $array): array
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $array[$key] = self::filterRecursive($value);
            }

            if ($array[$key] === null || (is_array($array[$key]) && empty($array[$key]))) {
                unset($array[$key]);
            }
        }

        return $array;
    }
}
