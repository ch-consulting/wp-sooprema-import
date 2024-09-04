<?php
/**
* No modify this file !!!
*/
namespace CHSOOPREMA;

use CHSOOPREMA\Config;

class Request
{
    public $post_data=array();
    public $get_data=array();

    public function __construct()
    {
        $config     = Config::getInstance();
        $this->process($config->post,'post');
        $this->process($config->get,'get');
    }

    
    public function  process($datas,$from)
    {
       foreach ($datas as $key => $data)
       {
           if (isset($_REQUEST[$key]))
           {
            call_user_func_array($data,array_values($_REQUEST));
           }
           else
           {
            continue;
           }
       }
    }


}
