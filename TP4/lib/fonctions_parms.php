<?php

// Question 2.2
function checkUnsignedInt(string $name,
                          ?int $defaultValue = NULL,
                          bool $mandatory = TRUE) {
    if (!isset($_GET[$name]) || $_GET[$name] == "") {
        if ($defaultValue == NULL) {
            if ($mandatory) {
                throw new ParmsException("$name absent");
            } else {
                return NULL;
            }
        } else {
            return $defaultValue;
        }

    } else {
        $val = $_GET[$name];
        if (! ctype_digit($val))
            throw new ParmsException("$name incorrect");
        return (int) $val;
    }
}

// Question 5 
function checkString(string $name,
                          ?int $defaultValue = NULL,
                          bool $mandatory = TRUE) {
        if (!isset($_GET[$name]) || $_GET[$name] == "") {
            if ($defaultValue == NULL) {
                if ($mandatory) {
                    throw new ParmsException("$name absent");
                } else {
                    return NULL;
                }
            } else {
                return $defaultValue;
            }
    
        } else {
            $val = $_GET[$name];
            if (! is_string($val))
                throw new ParmsException("$name incorrect");
            return (string) $val;
        }
    }

?>