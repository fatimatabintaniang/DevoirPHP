<?php

function dd(){
    echo "<pre>";
    print_r(func_get_args());
    echo "</pre>";
    exit;
}

function jsonToArray(string $key=null): mixed {
    $json = file_get_contents("../bd/bd.json");
    $datas = json_decode($json, true);
    return $key==null ?$datas:$datas[$key];
}