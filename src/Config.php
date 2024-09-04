<?php

namespace CHSOOPREMA;

final class Config
{
    /**
     * @var Config
     */
    private static $instance;

    
    /**
     * gets the instance via lazy initialization (created on first usage)
     */
    public static function getInstance(): Config
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * is not allowed to call from outside to prevent from creating multiple instances,
     * to use the singleton, you have to obtain the instance from Config::getInstance() instead
     */
    private function __construct()
    {
        //
    }

    /**
     * prevent the instance from being cloned (which would create a second instance of it)
     */
    private function __clone()
    {
        //
    }

    /**
     * prevent from being unserialized (which would create a second instance of it)
     */
    public function __wakeup()
    {
        //
    }
    public $version='1.1.0';

    /*
    * Plugins option
    * storage in database the option value
    * Array ('option_name'=>'default value')
    * @example ["example_data" => 'foo',]
    * @return void
    */
    public $plugin_options=[
        'sooprema_post_type'           => '',
        'sooprema_user_publish'        => '',
        'sooprema_xml_url'             => '',
        'sooprema_referencia'          => 'sooprema_id',
        'sooprema_wpml'                => '',
        'sooprema_importar_fotos'      => '',
        'sooprema_reemplazar_fotos'    => '',
        'sooprema_activar_cron'        => '',
        'sooprema_notificar_email'     => '',
        'sooprema_cron_email'          => '',
        'sooprema_webhook_xml'         => '',
        'sooprema_key_api'             => '',
        'import_support_name'       => '',
        'status_venta'              => 'VENTA',
        'status_alquiler'           => 'ALQUILER',
        'sooprema_token'               => '',
        'ch_token'                  => '',
        'import_xml'                => '{}',
        'import_json'               => '{}',
        'inmo_tags'                 => [],
        'sooprema_status_import'       => ['available'],
        'sooprema_activar_borrado_masivo' => '',
        
    ];
    /**
    * Language Option
    * define a unique word for translate call
    */
    public $language_name='ch_sooprema';
    /**
    * Plugin text prefix
    * define a unique word for this plugin
    */
    public $plugin_prefix='ch_antonella';
    /**
    * POST data process
    * get the post data and execute the function
    * @example ['post_data'=>'CHSOOPREMA::function']
    */
    public $post=[
        'ch_sooprema_admin'=>__NAMESPACE__.'\Admin\PageAdmin::guardar'
    ];
    /**
    * GET data process
    * get the get data and execute the function
    * @example ['get_data'=>'CHSOOPREMA::function']
    */
    public $get=[
        'cron'  => __NAMESPACE__."\SoopremaController::ProgramarImportacion",
    ];
    /**
    * add_filter data functions
    * @input array
    * @example ['body_class','CHSOOPREMA::function',10,2]
    * @example ['body_class',['CHSOOPREMA','function'],10,2]
    */
    public $add_filter=[];
    /**
    * add_action data functions
    * @input array
    * @example ['body_class','CHSOOPREMA::function',10,2]
    * @example ['body_class',['CHSOOPREMA','function'],10,2]
    */
    public $add_action=[
        //['cron_job_callback',[__NAMESPACE__.'\Install::cron_job_callback'],10,0],
        ['init',__NAMESPACE__.'\SoopremaController::iniciador'],
        ['cron_job_callback',[__NAMESPACE__.'\Install', 'cron_job_callback'],10,2],
        ['my_scheduled_task', [__NAMESPACE__.'\Install', 'cronJobs'],10,0],
  //      ['save_post',[__NAMESPACE__.'\SoopremaController','parentAfterSavePost'],10,3],
  //      ['save_post',[__NAMESPACE__."\SoopremaController","ExportarWitei"],10,3],
        // AJAX
        ['wp_ajax_import_queue',__NAMESPACE__.'\SoopremaController::importar_queue'],
        ['wp_ajax_clean_queue',__NAMESPACE__.'\SoopremaController::clean_queue'],
        ['wp_ajax_nopriv_pqueue_cron',__NAMESPACE__.'\SoopremaController::programarQueue'],
        ['wp_ajax_import_sooprema',__NAMESPACE__.'\SoopremaController::importar_api'],
        ['wp_ajax_import_support',__NAMESPACE__.'\SoopremaController::ImportarConfiguracion'],
        ['wp_ajax_import_undo',__NAMESPACE__.'\SoopremaController::DeshacerConfiguracion'],
        ['wp_ajax_nopriv_import_undo',__NAMESPACE__.'\SoopremaController::DeshacerConfiguracion'],
        ['wp_ajax_nopriv_import_support',__NAMESPACE__.'\SoopremaController::ImportarConfiguracion'],
        ['wp_ajax_import_sooprema_foto',__NAMESPACE__.'\SoopremaController::parentInsertar_foto'],
        ['wp_ajax_nopriv_import_sooprema_foto',__NAMESPACE__.'\SoopremaController::parentInsertar_foto'],
        ['wp_ajax_borrar_excedentes',__NAMESPACE__.'\SoopremaController::parentDeleteProperties'],
        ['wp_ajax_nopriv_borrar_excedentes',__NAMESPACE__.'\SoopremaController::parentDeleteProperties'],
        ['wp_ajax_sooprema_test',__NAMESPACE__.'\SoopremaController::FindByID'],
        ['wp_ajax_nopriv_sooprema_test',__NAMESPACE__.'\SoopremaController::FindByID'],
        ['wp_ajax_nopriv_sooprema_cron',__NAMESPACE__."\SoopremaController::ProgramarImportacion"],
        ['wp_ajax_nopriv_sooprema',__NAMESPACE__."\SoopremaController::ImportWebhook"],
        ['wp_ajax_sooprema',__NAMESPACE__."\SoopremaController::ImportWebhook"],
        ['wp_ajax_send_feedback_email',__NAMESPACE__."\SoopremaController::sendFeedBackEmail"],
        ['wp_ajax_add_sooprema_data_import',__NAMESPACE__."\SoopremaController::addWiteiDataImport"],
        ['wp_ajax_sooprema_count',__NAMESPACE__."\SoopremaController::contarInmuebles"],
        ['before_delete_post',[__NAMESPACE__."\SoopremaController","WiteiBorrarMediaAntesDeBorrarInmueble"],10,2],
       
    ];
    
    /**
    * add custom shortcodes
    * @input array
    * @example [['example','CHSOOPREMA\ExampleController::example_shortcode']]
    */
    public $shortcodes=[
        ['sooprema',__NAMESPACE__."CHSOOPREMA\SoopremaController::Shortcode"]
    ];
    /**
    * Dashboard
    * @reference: https://codex.wordpress.org/Function_Reference/wp_add_dashboard_widget
    */
    public $dashboard=[
        [
        'slug'      => '',
        'name'      => '',
        'function'  => '',
        'callback'  => '',
        'args'      => '',
        ]

    ];
    /**
    * Files for use in Dashboard
    */
    public $files_dashboard=[];

    /*
    * Plugin menu
    * set your menu option here
    */
    public $plugin_menu=[
        [
            "path"      => ["subpage","tools.php"],
            "name"      => "SOOPREMA import",
            "function"  => __NAMESPACE__."\Admin\PageAdmin::index",
            "slug"      => "ch-sooprema-import"
        ]
        ];

    public $post_types =[
        [
            'singular'      => '',
            'plural'        => '',
            'slug'          => '',
            'translate'     => false,
            'position'      => 4,
            'taxonomy'      =>['category'],
            'image'         =>'',
        ],

    ];

    /**
     * Widget
     * For register a Widget please:
     * Console: php antonella Widget "NAME_OF_WIDGET"
     * @input array
     * @example public $widget = [__NAMESPACE__.'\YouClassWidget']  //only the class
     */
    public $widgets=[];
}
