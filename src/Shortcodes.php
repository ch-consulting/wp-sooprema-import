<?php
namespace CHSOOPREMA;
use CHSOOPREMA\Config;

class Shortcodes
{

    public function __construct()
    {
        
    }

    public static function index()
    {
        $config= Config::getInstance();
        $filter=$config->shortcodes;
        // add_shortcode('example', array('Shortcodes','example_function'));
        if ($filter)
        {
            foreach($filter as $data)
            {
                call_user_func_array('add_shortcode',array_values([$data[0],$data[1]]));
            }
        }


    }
    /*
    * shortcode example
    * @info: https://codex.wordpress.org/Shortcode
    * @return string
    */
    public function example_function($atts)
    {
        extract(shortcode_atts(array(
         'data1' => 1,
             'data2'   =>1
         ), $atts));
        return ("<div>$content</div>");
    }
}
