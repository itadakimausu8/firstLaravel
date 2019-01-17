<?php

$a = "abcd"."dddddd"; 
    function wrapCSV($str){  
      return strval('"'.str_replace('"', '""', $str).'"');
    }