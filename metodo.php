<?php
function cifrarCesar($mensaje, $clave)
{
    $resultado = '';
    $longitud = mb_strlen($mensaje, 'UTF-8');
    $alfabeto = 'ABCDEFGHIJKLMNÑOPQRSTUVWXYZ';
    for ($i = 0; $i < $longitud; $i++) {
        $caracter = mb_substr($mensaje, $i, 1, 'UTF-8');
        $caracter = mb_strtoupper($caracter, 'UTF-8');
        $posicion = mb_strpos($alfabeto, $caracter, 0, 'UTF-8');
        if ($posicion === false) {
            $resultado .= $caracter;
            continue;
        }
        $nueva_posicion = ($posicion + $clave) % 27;
        if ($nueva_posicion < 0) {
            $nueva_posicion += 27;
        }
        $nuevo_caracter = mb_substr($alfabeto, $nueva_posicion, 1, 'UTF-8');
        $resultado .= $nuevo_caracter;
    }
    return $resultado;
}

function descifrarCesar($mensaje_encriptado, $clave)
{
    $resultado = '';
    $longitud = mb_strlen($mensaje_encriptado, 'UTF-8');
    $alfabeto = 'ABCDEFGHIJKLMNÑOPQRSTUVWXYZ';
    for ($i = 0; $i < $longitud; $i++) {
        $caracter = mb_substr($mensaje_encriptado, $i, 1, 'UTF-8');
        $caracter = mb_strtoupper($caracter, 'UTF-8');
        $posicion = mb_strpos($alfabeto, $caracter, 0, 'UTF-8');
        if ($posicion === false) {
            $resultado .= $caracter;
            continue;
        }
        $nueva_posicion = $posicion - $clave;
        $nueva_posicion = ($nueva_posicion + 27) % 27;
        $nuevo_caracter = mb_substr($alfabeto, $nueva_posicion, 1, 'UTF-8');
        $resultado .= $nuevo_caracter;
    }
    return $resultado;
}


?>