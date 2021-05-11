<?php 
    if (!function_exists('limit_name')) {
        function limit_name($name) {
            $word_count = str_word_count($name);

            if ($word_count > 2) {
                $name_exp       = explode(' ', $name);
                $last_initial   = substr($name_exp[2], 0, 1);
                $full_name      = ucwords($name_exp[0].' '.$name_exp[1].' '.$last_initial.'.');
            } else {
                $full_name = $name;
            }

            return $full_name;
        }
    }

?>