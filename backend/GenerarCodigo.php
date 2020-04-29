<?php
class CodigoRandom{
    public function generarCodigoRandom($length = 10) //Esta función genera una cadena aleatoria de 10 caracteres de longitud.
    {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }
}