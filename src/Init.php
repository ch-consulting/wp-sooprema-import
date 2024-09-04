<?php
namespace CHSOOPREMA;

class Init
{
    public function __construct()
    {

    }

    public static function index()
    {
        self::run_updater();
    }

    /*
    * Begins execution of plugin.
    *
    * @return void
    */
    private static function run_updater() {
        /*
        if ( is_admin() ) {
            
            include_once plugin_dir_path( __FILE__ ) . '/PluginUpdater.php';
            $config  = array(
                'github_uri' => 'https://api.github.com/repos/ch-consulting/wp-sooprema-import/releases',
                'token'      => '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',
            );

            $rootPath = realpath(dirname(__FILE__) . '/..') . '/antonella-framework.php';
            $updater = new PluginUpdater( $config, $rootPath );
            $updater->fgr_check_update();
            
        }
            */
    }
}
