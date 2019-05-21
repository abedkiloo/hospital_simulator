<?php
if (!function_exists('convert_phone_to_kenyan_format')) {
    function convert_phone_to_kenyan_format($phone_no)
    {
        //format phone
        if (substr($phone_no, 0, 2) === "07")//if phone starts with 07
        {
            $phone = substr_replace($phone_no, "254", 0, 1);
        } elseif (substr($phone_no, 0, 1) === "7")//if starts with 7
        {
            $phone = substr_replace($phone, "254", 0, 0);
        } elseif (substr($phone, 0, 4) === "+254") {
            $phone = substr_replace($phone, "", 0, 1);
        }
        return $phone;
    }
}
