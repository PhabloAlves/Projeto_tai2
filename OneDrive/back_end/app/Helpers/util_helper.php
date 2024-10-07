<?php

class Util
{
    public static function remove_mascara_cep($cep_pagador)
    {
        $cep = preg_replace('/[^0-9]/', '', $cep_pagador);

        if (preg_match('/^\d{8}$/', $cep)) {
            return $cep;
        }

        return false; 
    }
}
