<?php

namespace CHSOOPREMA;
use CHSOOPREMA\SoopremaController;

class Install
{
    /*
    * Construct
    * @return void
    */
    public function __construct()
    {
    }
    /*
    * initial function. you can call your functions here
    * @return void
    */
    public static function index()
    {
        $config = Config::getInstance();
        $install= new Install;
        $install->cronJobs();
        $install->plugin_options($config->plugin_options);
    }

    public static function cron_job_callback() {
        $sooprema = new SoopremaController;
        $sooprema-> processQueue();
    }

    public function cronJobs()
    {
        if (! wp_next_scheduled('cron_job_callback')) {
            wp_schedule_event(time(), 'every_minute', 'cron_job_callback');
            error_log("Se ha programado la tarea cron.");
        }
        $event_schedule = wp_get_schedule( 'cron_job_callback' );
        error_log("La tarea cron ya está programada para ejecutarse en {$event_schedule}.");
    }

    public static function custom_cron_schedules($schedules)
    {
        $schedules['every_minute'] = array(
          'interval' => 120, 
          'display' => __('Every minute')
        );
        
        return $schedules; 
    }
    /*
    * Table Updates
    * @ver 1.0
    * se genera una nueva columna en las tablas de WP
    *
    * @return void
    */
    public function table_updates($tablename, $params)
    {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        global $wpdb;
        $table = $wpdb->prefix.$tablename;
        foreach ($params as $param) {
            $update=" ALTER TABLE `$table` ADD `{$param['name']}` {$param['attr']};";
            $wpdb->query($update);
        }
    }

    /*
    * Table Create
    * @ver 1.0
    * @return null
    */
    public function table_create($options)
    {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        global $wpdb;
        foreach ($options as $sql) {
            if ($wpdb->get_var("SHOW TABLES LIKE '{$sql['table']}'") != $sql['table']) {
                $query="CREATE TABLE IF NOT EXISTS {$sql['table']} ( {$sql['query']} ) ENGINE=InnoDB DEFAULT CHSOOPREMAARSET=latin1 AUTO_INCREMENT=1 ;";
                $wpdb->query($sql['query']);
            }
        }
    }

    /*
    * Plugin's Options on first install
    * @ver 1.0
    * @description: no modify
    * @return void
    */
    public function plugin_options($options)
    {
        foreach ($options as $key => $option) {
            add_option($key, $option);
        }
    }
}
