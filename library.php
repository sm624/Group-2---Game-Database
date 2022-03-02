<?php
    function StripString($word){ //this strips a string of all whitespace 
        $wordSize = strlen($word); //and makes it uppercase
        $word = preg_replace('/\s+/', '', $word); //removes whitespace including tabs
        $word = strtoupper($word); //uppercase

        return $word;
    }
    
?>
    