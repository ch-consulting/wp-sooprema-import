<?php
/**
* No modify this file !!!
*/
namespace CHSOOPREMA;

/*
* Class Start
* @package CHSOOPREMA\Start
*/
class Start
{
    /*
    * You can add start functions for start the plugin
    * @return void
    */
    public function __construct()
    {
        $language   = new Language();
        $hooks      = new Hooks();
        $request    = new Request();
    }
}
