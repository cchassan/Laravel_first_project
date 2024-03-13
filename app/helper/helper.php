<?php

function setActive(array $route){
    if(is_array($route)){
        foreach($route as $r){
            if(request()->routeIs($r)){
                return 'active';
            }
        }
    }
}

function p($value)
{
    echo '<pre>';
    print_r($value);
    echo '<pre>';
    die;
}
