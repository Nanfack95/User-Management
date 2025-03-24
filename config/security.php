<?php

    function cleanInput($data) {
        return htmlspecialchars(strip_tags(trim($data)));
    }
    
?>
