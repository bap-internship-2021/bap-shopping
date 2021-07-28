<?php

namespace App\Helpers;

class CustomID
{
    public static function IdGenerator($model, $trow, $length = 4, $prefix)
    {
        $data = $model::orderBy('id', 'desc')->first();
        if (!$data) {
            $og_lenght = $length;
            $last_number = '';
        } else {
            $code = substr($data->$trow, strlen($prefix) + 1);
            $actial_last_number = ($code / 1) * 1;
            $increment_last_number = $actial_last_number + 1;
            $last_number_lenght = strlen($increment_last_number);
            $og_lenght = $length - $last_number_lenght;
            $last_number = $increment_last_number;
        }
        $zeros = "";
        for ($i = 0; $i < $og_lenght; $i++) {
            $zeros .= "0";
        }
        return $prefix . '_' . $zeros.$last_number;

    }
}
