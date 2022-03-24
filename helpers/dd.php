<?php

if(!function_exists('dd')) {
    function dd($value) {
        echo '<pre><code>';

        if(is_array($value)) {
            foreach ($value as $item) {
                var_dump($item);
            }
        } else {
            var_dump($value);
        }
        echo '</code></pre>';

        die();
    }
}