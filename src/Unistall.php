<?php
namespace CHSOOPREMA;

class Unistall
{
    public function __construct()
    {


    }

    public static function index()
    {

        $config = Config::getInstance();
        $unistall= new Unistall;
        $unistall->delete_options($config->plugin_options);

    }

    public function delete_options($options)
    {
        foreach($options as $key => $option)
        {
            if ( get_option( $key ) != false )
            delete_option( $key );
        }
    }
}
