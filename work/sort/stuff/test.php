<?php
/**
 * Error reporiting.
 */
error_reporting(E_ALL);

        /**
         * Turn on output buffering.
         */
        ob_start();
        
        $raw = file_get_contents('license.dat');
        
        $result = ob_get_contents();
        
        /**
         * Erase the output buffer and turn off output buffering.
         */
        ob_end_clean();
?>
