<?php
namespace CHSOOPREMA;

class Language
{
    public function __construct()
    {
        $config= Config::getInstance();
        load_plugin_textdomain($config->language_name, false, dirname( plugin_basename( __DIR__ ) ).'/languages/' );
    }
}
