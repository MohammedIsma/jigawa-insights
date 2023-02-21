<?php

function getAccClass($cl){
    if($cl<25){
        return "danger";
    }elseif($cl<50){
        return "warning";
    }elseif($cl<75){
        return "info";
    }else{
        return "success";
    }
}
