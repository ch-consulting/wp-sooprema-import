<?php
if (!function_exists('__t')) {
    /**
     * Make your Helper
     * not use exist helpers
     * for call this function globally:
     * __t();
     */
    function __t($text){
        $config = CHSOOPREMA\Config::getInstance();
        return __($text,$config->language_name);
    }
}
?>