<?php

namespace CHSOOPREMA\Admin;

use CHSOOPREMA\Config;
use CHSOOPREMA\SoopremaController;
use CHSOOPREMA\MenuController;
use CHSOOPREMA\Users;

class PageAdmin extends Admin
{

    public static function index()
    {
        
        $data_tabs=[
            [
                "source"    => "ch-sooprema-import",
                "name"      => __("General", 'ch_sooprema'),
                "slug"      => "general",
                'page'      => "tools.php",
            ],
            /*
            [
                "source"    => "ch-sooprema-import",
                "name"      => __("Post Types Relations", 'ch_sooprema'),
                "slug"      => "relation",
                'page'      => "tools.php",
            ],
            */
            [
                "source"    => "ch-sooprema-import",
                "name"      => __("Bulk Import", 'ch_sooprema'),
                "slug"      => "import",
                'page'      => "tools.php",
            ],
            [
                "source"    => "ch-sooprema-import",
                "name"      => __("Cron job", 'ch_sooprema'),
                "slug"      => "cronjob",
                'page'      => "tools.php",
            ],
            /*
            [
                "source"    => "ch-sooprema-import",
                "name"      => __("WebHook", "ch_sooprema"),
                "slug"      => "webhook",
                'page'      => "tools.php",
            ],
            */
            [
                "source"    => "ch-sooprema-import",
                "name"      => __("FeedBack", "ch_sooprema"),
                "slug"      => "feedback",
                'page'      => "tools.php",
            ],
         /*   [
                "source"    => "ch-sooprema-import",
                "name"      => "Valores Importación",
                "slug"      => "valores-importacion",
                'page'      => "tools.php",
            ]
            */
        ];

        if (has_filter('sooprema_tabs')) {
            $data_tabs = apply_filters('sooprema_tabs', $data_tabs);
        }

        $tabs= PageAdmin::generate_tabs($data_tabs);
        $showSubmitButton = true;
        $html='';
        if(isset($_GET['tab'])) {
            switch($_GET['tab']) {
                case 'general':
                    $html= MenuController::Tab_general();
                    break;
                case 'relation':
                    $html= MenuController::Tab_relation();
                    $showSubmitButton = false;
                    break;
                case 'import':
                    $html= MenuController::Tab_import();
                    break;
                case 'cronjob':
                    $html= MenuController::Tab_cronjobs();
                    break;
                case 'webhook':
                    $html= MenuController::Tab_WebHook();
                    break;
                case 'feedback':
                    $html= MenuController::Tab_FeedBack();
                    $showSubmitButton = false;
                    break;
                case 'valores-importacion':
                    $html= MenuController::Tab_Valores();
                    $showSubmitButton = false;
                    break;
                default:
                    if (has_filter('sooprema_tabs_content')) {
                        $html = apply_filters('sooprema_tabs_content', $html, $showSubmitButton);
                    }
                    // $html= MenuController::Tab_general();
                    break;
    
            }
        } else {
          
            $html= MenuController::Tab_general();
        }
       
        $config= Config::getInstance();
        $data='
        <div class="wrap ch_sooprema">
            <h1>'.__('Sooprema Import', 'ch_sooprema').'</h1>
            <small><b>Ver '.$config->version.'</b> Make by <a href="https://carlos-herrera.com">Carlos Herrera Consulting</a> and Powered by <a href="https://antonellaframework.com">Antonella Framework</a></small>';
        $data .= $tabs;
        $data .= '<form method="POST">';
        $data .= isset($html)?$html:'';
        $data .= $showSubmitButton ? '<p class="submit"><input type="submit" value="'.__("Update", "ch_sooprema").'" name="ch_sooprema_admin" class="button button-primary button-large button-sooprema"></p>' : '';
        $data .= '</form>';
        $data .= '</div>';
        
        echo $data;

    }

    /**
     * Selector de auhtor
     *
     * Modificado Antonio Jenaro 02/07/2019
     * https://codex.wordpress.org/Function_Reference/get_users
     *
     * @return string html
     */
    public static function get_author_select($user_selected, $name)
    {
        //$users= new Users();
        //$lists_users=$users->show_users();
        $lists_users = get_users(array( 'fields' => array( 'ID', 'user_nicename' ) ));
        
        $result ='<select name="'.$name.'">';
        $result .= '<option value="">--'.__('Choose', 'ch_sooprema').'--</option>';

        foreach($lists_users as $user) {
            $user_select = $user->ID==$user_selected?' selected="selected" ':'';
            $result .= '<option value="'.$user->ID.'" '.$user_select.'>'.$user->user_nicename.'</option>';
        }

        $result .='</select>';
        return $result;

    }

    /**
     * Guarda los valores que vienen del admin
     * @return void
     */
    public static function guardar()
    {
        //die(print_r($_POST));
        foreach($_POST as $key=>$data) {
            if($key=='import_xml'||$key=='inmo_tags'||$key=='import_json'||$key=='static_values'||$key=='taxonomies_xml_static_values'||$key=='taxonomies_json_static_values'||$key=='sooprema_status_import') {
                update_option($key, json_encode($data));
            } else {
                update_option($key, strip_tags($data));
            }
        }
    }

    /**
     * Obtener el Post Type
     * @version 1.0
     * @param string $post_type_stored el post type selecionado
     *
     * @return string html
     */
    public static function get_post_type_list_select($post_type_stored, $name)
    {
        $post_selected=$post_type_stored;
        $result='<select name="'.$name.'"><option value="">--'.__('Choose', 'ch_sooprema').'--</option>';
        if(get_post_types('', 'objects')) {
            foreach (get_post_types('', 'objects') as $post_type) {
                $selected=$post_selected==$post_type->name?' selected="selected" ':'';
                $result.='<option value="'.$post_type->name.'" '.$selected.'>' . $post_type->label . '</option>';
            }
        }
        

        $result.='</select>';

        return $result;
    }

    public static function get_post_meta_for_post_type($post_type)
    {
        global $wpdb;

        if($post_type) {
            $consulta="SELECT DISTINCT meta_key FROM {$wpdb->prefix}postmeta WHERE post_id IN (SELECT ID FROM {$wpdb->prefix}posts WHERE post_type = '$post_type')";
            $results = $wpdb->get_results($consulta, ARRAY_A);
            return $results;
        }
    }

    public function get_terms_for_custom_post_type()
    {
        $taxonomies = get_terms();
        //$taxonomies = get_object_taxonomies($post_type);
        foreach ($taxonomies as $taxonomy) {
            echo $taxonomy->name . "<br>";
        }
        //return $taxonomies;
    }

    public function get_fields($source, $output=false, $selected=false)
    {
        $fields= $source;
        if($output=='select') {
            $data='<select name="inmo_fields_'.$source.'">';
            $data.='<option value=""> --- seleciona ---</option>';
            foreach ($fields as $field) {
                $check=$selected==$field?' selected="selected" ':'';
                $data.='<option value="'.$field.'" '.$check.'>'.$field.'</option>';
                
            }
            $data.='</select>';
            return $data;
        }
        return $fields;
    }

    /**
     * Generate Tabs in Page Admin
     * @version 1.0
     * @param array $tabs listado de tabs a insertar y sus funciones
     * @return string HTML
     */
    public static function generate_tabs($tabs)
    {
        $config= Config::getInstance();
        $tab_active=isset($_GET['tab'])?$_GET['tab']:false;
        $output='<nav class="nav-tab-wrapper '.$config->plugin_prefix.'-nav-tab-wrapper">';
        $count=1;
        foreach($tabs as $tab) {
            $active=$tab_active==$tab['slug']||$tab_active==''&&$count==1?'nav-tab-active':'';
            $output.='<a href="'.admin_url($tab['page'].'?page='.$tab['source'].'&amp;tab='.$tab['slug']).'" class="nav-tab '.$active.'">'.$tab['name'].'</a>';
            $count++;
        }
        $output.='</nav>';

        return $output;

    }
}
