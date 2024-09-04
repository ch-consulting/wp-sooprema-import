<?php
namespace CHSOOPREMA;
use CHSOOPREMA\Config;

class Widgets
{

    public function __construct()
    {
        
    }

    public static function index()
    {
        $config= Config::getInstance();
        $filter=$config->widgets;
        // add_shortcode('example', array('Shortcodes','example_function'));
        if (is_array($filter)&&count($filter)>0)
        {
            foreach($filter as $data)
            {
                \register_widget($data);
            }
        }


    }
}