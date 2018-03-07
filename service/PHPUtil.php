<?php

function isset_request($param){
    if (isset($_REQUEST[$param])) {
        return $_REQUEST[$param];
    }  
    return "";
};

function isset_object($obj, $field){
    if (isset($obj['field'])) {
        return $obj['field'];
    }  
    return "";
};