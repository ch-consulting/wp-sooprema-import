<?php

namespace CHSOOPREMA;

use CHSOOPREMA\Admin\PageAdmin;

class MenuController
{
    public function __construct()
    {
    }

    /**
     * Muestra la Pestaña General.
     *
     * @version 1.0
     *
     * @author Carlos Herrera (https://carlos-herrera.com)
     *
     * @return string HTML
     */
    public static function Tab_general()
    {
        $post_type_select = PageAdmin::get_post_type_list_select(get_option('sooprema_post_type'), 'sooprema_post_type');
        $author_select = PageAdmin::get_author_select(get_option('sooprema_author'), 'sooprema_author');
        $aditional_menu = false;
        $aditional_menu = apply_filters('sooprema_hook_aditional_options', $aditional_menu);
        $statuses = get_option('sooprema_status_import')!=''?json_decode(get_option('sooprema_status_import')):['available'];
        $html = '
        <h1>'.__('Initial settings', 'ch_sooprema').'</h1>
        <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="sooprema_public_key">'.__("Sooprema's Public Key", 'ch_sooprema').'</label>
                </th>
                <td>
                    <input type="text" name="sooprema_public_key"  value="'.get_option('sooprema_public_key').'" style="width:410px;">
                  <!-- <p>'.__('Public Key to import the properties You can see it, if you are logged in wn Witei, clicking on', 'ch_sooprema').' <a href="https://sooprema.com/pro/agencies/account_management/api/" target="_blank">https://sooprema.com/pro/agencies/account_management/api/</a></p> -->
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="sooprema_private_key">'.__("Sooprema's Private Key", 'ch_sooprema').'</label>
                </th>
                <td>
                    <input type="text" name="sooprema_private_key"  value="'.get_option('sooprema_private_key').'" style="width:410px;">
                   <!-- <p>'.__('Public Key to import the properties You can see it, if you are logged in wn Witei, clicking on', 'ch_sooprema').' <a href="https://sooprema.com/pro/agencies/account_management/api/" target="_blank">https://sooprema.com/pro/agencies/account_management/api/</a></p> -->
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="sooprema_agency_name">'.__("Sooprema's agency name", 'ch_sooprema').'</label>
                </th>
                <td>
                    <input type="text" name="sooprema_agency_name"  value="'.get_option('sooprema_agency_name').'" style="width:410px;">
                    <p>'.__('Set tne agency name', 'ch_sooprema').'
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="sooprema_xml_url">'.__("Plugin's Token", 'ch_sooprema').'</label>
                </th>
                <td>
                    <input type="text" name="ch_token"  value="'.get_option('ch_token').'" style="width:410px;">
                    <p>'.__('License to run the plugin. To purchase a license click <a href="http://tipeos.com/WFz" target="_blank"> here </a>', 'ch_sooprema').'</p>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="sooprema_post_type">'.__('Choose PostType', 'ch_sooprema').'</label>
                </th>
                <td>'.$post_type_select.'<p>'.__('Select the type of entry you want to import the properties', 'ch_sooprema').'</p>
                </td>
            </tr>
            <!--
            <tr>
                <th scope="row">¿Borrar inmuebles que no aparecen en el XML tras importarlos?</th>
                <td>
                    <select name="sooprema_borrar">
                        <option value="1" '.(get_option('sooprema_borrar') == '1' ? 'selected' : '').' >Si</option>
                        <option value="" '.(get_option('sooprema_borrar') == '' ? 'selected' : '').' >No</option>
                    </select>
                    <p>Selecciona si deseas que borre los inmuebles que no aparecen en el XML tras la importación</p>
                </td>
            </tr>
            -->
            <!--
            <tr>
                <th scope="row">'.__('Import property status', 'ch_sooprema').'</th>
                <td>
                    <label for="sooprema_status_import">
                        <input hidden name="sooprema_status_import[]"  value="available"/>
                        <input type="checkbox" name=""  value="available" disabled checked="checked"> 
                        '.__('available', 'ch_sooprema').'
                    </label>
                    <label for="sooprema_status_import">
                        <input type="checkbox" name="sooprema_status_import[]" value="sold" '.(in_array('sold', $statuses)?'checked="checked"':'').'> 
                        '.__('sold', 'ch_sooprema').'
                    </label>
                    <label for="sooprema_status_import">
                        <input type="checkbox" name="sooprema_status_import[]"  value="prospect" '.(in_array('prospect', $statuses)?'checked="checked"':'').'>
                        '.__('prospect', 'ch_sooprema').'
                    </label>
                    <label for="sooprema_status_import">
                        <input type="checkbox" name="sooprema_status_import[]" value="reserved" '.(in_array('reserved', $statuses)?'checked="checked"':'').'>
                        '.__('reserved', 'ch_sooprema').'
                    </label>
                    <label for="sooprema_status_import">
                        <input type="checkbox" name="sooprema_status_import[]"  value="rentend" '.(in_array('rentend', $statuses)?'checked="checked"':'').'>
                        '.__('rentend', 'ch_sooprema').'
                    </label>
                    <label for="sooprema_status_import">
                        <input type="checkbox" name="sooprema_status_import[]"  value="inactive" '.(in_array('inactive', $statuses)?'checked="checked"':'').'>
                        '.__('inactive', 'ch_sooprema').'
                    </label>
                </td>
            </tr>
            -->
            <!--
            <tr>
                <th scope="row">'.__('Import Photos', 'ch_sooprema').'</th>
                <td>
                    <select name="sooprema_importar_fotos">
                        <option value="1" '.(get_option('sooprema_importar_fotos') == '1' ? 'selected' : '').' >'.__('yes', 'ch_sooprema').'</option>
                        <option value="" '.(get_option('sooprema_importar_fotos') == '' ? 'selected' : '').' >'.__('no', 'ch_sooprema').'</option>
                    </select>
                    <p>'.__('Select if you want the photos to be imported', 'ch_sooprema').'</p>
                    <p>'.__('Photos are only imported the first time you import the property.', 'ch_sooprema').'</p>
                </td>
            </tr>
            -->
            <!--
            <tr>
                <th scope="row">'.__('Replace Photos', 'ch_sooprema').'</th>
                <td>
                    <select name="sooprema_reemplazar_fotos">
                        <option value="1" '.(get_option('sooprema_reemplazar_fotos') == '1' ? 'selected' : '').' >'.__('yes', 'ch_sooprema').'</option>
                        <option value="" '.(get_option('sooprema_reemplazar_fotos') == '' ? 'selected' : '').' >'.__('no', 'ch_sooprema').'</option>
                    </select>
                    <p>'.__('Select if you want replace photos after to be imported', 'ch_sooprema').'</p>
                </td>
            </tr>
            -->
            <!-- <tr>
                <th scope="row">Relacionar Agentes con usuarios</th>
                <td>
                    <select name="sooprema_agent_relation">
                        <option value="1" '.(get_option('sooprema_agent_relation') == '1' ? 'selected' : '').' >'.__('yes', 'ch_sooprema').'</option>
                        <option value="" '.(get_option('sooprema_agent_relation') == '' ? 'selected' : '').' >'.__('no', 'ch_sooprema').'</option>
                    </select>
                    <p>Selecciona si deseas que se relacione los agentes asignados al inmueble con los usuarios existentes en WordPress</p>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="sooprema_filtro_author">Asignar toda la Importación a un sólo agente</label>
                </th>
                <td>$author_all_import<p>Selecciona un agente si desea que todos los inmuebles sean asignados al mismo agente</p>
                </td>
            </tr>-->
            <tr>
                <th scope="row">
                    <label for="sooprema_author">'.__('Default auhtor', 'ch_sooprema').'</label>
                </th>
                <td>'.$author_select.'<p>'.__('Select the default author for the properties', 'ch_sooprema').'</p>
                </td>
            </tr>
            <!--<tr>
                <th scope="row">Importar sólo inmuebles de un agente</th>
                <td>
                    <select name="sooprema_agent_filtro">
                        <option value="1" '.(get_option('sooprema_agent_filtro') == '1' ? 'selected' : '').' >'.__('yes', 'ch_sooprema').'</option>
                        <option value="" '.(get_option('sooprema_agent_filtro') == '' ? 'selected' : '').' >'.__('no', 'ch_sooprema').'</option>
                    </select>
                    <p>Selecciona si deseas que se relacione los agentes asignados al inmueble con los usuarios existentes en WordPress</p>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="sooprema_filtro_author">Agente a filtrar</label>
                </th>
                <td>$author_select_filter<p>El autor en caso de no relacionar los agentes o no haya usuario WP relacionado con agente</p>
                </td>
            </tr>-->
            <tr>
                <th scope="row">'.__('Report problems by email', 'ch_sooprema').'</th>
                <td>
                    <select name="sooprema_notificar_email">
                        <option value="1" '.(get_option('sooprema_notificar_email') == '1' ? 'selected' : '').' >'.__('yes', 'ch_sooprema').'</option>
                        <option value="" '.(get_option('sooprema_notificar_email') == '' ? 'selected' : '').' >'.__('no', 'ch_sooprema').'</option>
                    </select>
                    <p>'.__('Select if you want the agents assigned to the property to be related to existing WordPress users', 'ch_sooprema').'</p>
                </td>
            </tr>
            '.$aditional_menu.'
        </table>';

        return $html;
    }

    /**
     * Muestra la Pestaña Relación de PostType.
     *
     * @version 1.0
     *
     * @author Carlos Herrera (https://carlos-herrera.com)
     *
     * @return string HTML
     */
    public static function Tab_relation()
    {
        $sooprema = new SoopremaController();
        //$sooprema->GetAPI();
        $tema = wp_get_theme()->get('Name');
        $plugins = get_option('active_plugins');
        $installed = get_option('import_config');
        //print_r($plugins);
        //echo($tema);
        $post_selected = get_option('sooprema_post_type');
        // $data_import = (array) json_decode(get_option('sooprema_inmo_tags'));
        $json = get_option('import_json', '{}');
        $data_import_json = json_decode($json);
        
        $data_static_values = (array) json_decode(get_option('static_values'));
        $data_static_taxonomies_json_values = (array) json_decode(get_option('taxonomies_json_static_values', '{}'));
        $terms = $post_selected != '' ? PageAdmin::get_post_meta_for_post_type($post_selected) : [];

        // $term_taxonomies = get_categories(['type' => $post_selected]);
        $taxonomy_objects = get_object_taxonomies($post_selected, 'objects');

        $data_term = $data_term = $terms ? "<table id='data_term'><tr><th>PostType Meta data</th><th>Valor en el JSON<br/><small>Los Valores que Vienen del Webhook</small></th></tr>" : 'No hay campos que mostrar en este tipo de entradas';
        $data_taxonomies = '<table><tr><th>Taxonomía</th><th>Valor en el JSON<br/><small>Los Valores que Vienen del Webhook</small></th></tr>';

        foreach ($taxonomy_objects as $taxonomy_object) {
            $select_fields_json = isset($data_static_taxonomies_json_values[$taxonomy_object->name]) ? $sooprema->get_fields('select', $data_static_taxonomies_json_values[$taxonomy_object->name], 'json') : $sooprema->get_fields('select', '', 'json');
            $value_json = isset($data_static_taxonomies_json_values[$taxonomy_object->name]) ? $data_static_taxonomies_json_values[$taxonomy_object->name] : '';
            $data_taxonomies .= '<tr>';
            $data_taxonomies .= '<td>';
            $data_taxonomies .= '<span>'.$taxonomy_object->name.' => </span>';
            $data_taxonomies .= '</td>';
            $data_taxonomies .= '<td id="'.$taxonomy_object->name.'_json">';
            $data_taxonomies .= '<input type="hidden" name="taxonomies_json_static_values['.$taxonomy_object->name.']" value="'.$value_json.'" />';
            $data_taxonomies .= $select_fields_json;
            $data_taxonomies .= '</td></tr>';
        }

        $data_taxonomies .= '</table>';

        //$select_set_id = $sooprema->get_select_refer_data($terms,$data_import);

        foreach ($terms as $term) {
            // die(print_r($data_import_xml));
            $term_json = isset($data_import_json->{$term['meta_key']}) ? $data_import_json->{$term['meta_key']} : '';
            $select_fields_json = $sooprema->get_fields('select', $term_json, 'json');
            $data_term .= '<tr>';
            $data_term .= '<td>';
            $data_term .= '<span>'.$term['meta_key'].' => </span>';
            $data_term .= '</td>';
            $visible = $data_static_values[$term['meta_key']] != '' ? 'style=display:block' : 'style=display:none';
            $data_term .= '<td id="'.$term['meta_key'].'_json">';
            $data_term .= '<input type="hidden" name="import_json['.$term['meta_key'].']" value="'.$term_json.'" />';
            $data_term .= $select_fields_json;
            $data_term .= '<br><input type="text" name="static_values['.$term['meta_key'].']" value="'.$data_static_values[$term['meta_key']].'" '.$visible.' placeholder="Nuevo Tipo">';
            $data_term .= '</td>';
            $data_term .= '</tr>';
        }
        // imprimo valores del array static_values
        foreach ($data_static_values as $key => $data_json) {
            if (!property_exists($data_import_json, $key)) {
                $data_term .= '<tr class="nueva_fila">';
                $data_term .= '<td>';
                $data_term .= '<span>'.$key.' => </span>';
                $data_term .= '</td>';
                $data_term .= '<td id="'.$key.'_json" style="display:flex;justify-content: space-between;">';
                $data_term .= '<input type="hidden" name="static_values['.$key.']" value="'.$data_json.'" />';
                $data_term .= $data_json;
                // $data_term .= '</td>';
                // $data_term .= '<td>';
                // $data_term .= $data_json;
                $data_term .= '<div><span class=\'dashicons dashicons-trash\'></span><a href=\'javascript:void(0)\' class=\'delete-row\'>Borrar</a></div>';
                $data_term .= '</td>';
                $data_term .= '</tr>';
            }
        }

        $data_term .= '</table>';

        $html = '
        <style>
        @media screen and (min-width : 480px) {input[name="ch_sooprema_admin"]{position:fixed;     bottom: 50px;
            left: 180px;}}
        </style>
        <h1>Relación de la importación</h1>';
        if ($installed) {
            $html .= '<div class="notice-success notice is-dismissible"><p>Se ha instalado la configuración del '.$installed['tipo'].' '.$installed['nombre'].' <button class="button button-primary button-small button-undo">Deshacer</button></p></div>';
        } else {
            if (self::ComprobarTema($tema)) {
                $html .= '<div class="notice-warning notice is-dismissible"><p>Hemos detectado que usas el Tema '.$tema.'. <b>¿Deseas importar los datos de configuración para este tema?</b> <small> ( Se borrara la configuración previa ) </small> <button class="button button-primary button-small button-support" supporttype="theme" supportname="'.$tema.'" >Importar Configuración</button> <img src="'.plugins_url('/assets/img/loader7.gif', dirname(__FILE__)).'" class="loader" style="display:none" /></p></div>';
            }
            $plugins_compatibles = self::ComprobarPlugins($plugins);
            if ($plugins_compatibles) {
                foreach ($plugins_compatibles as $plugin) {
                    $html .= '<div class="notice-warning notice is-dismissible"><p> Hemos detectado que usas el Plugin '.$plugin.'. <b>¿Deseas importar los datos de configuración para este plugin?</b> <small> ( Se borrara la configuración previa ) </small> <button class="button button-primary button-small button-support" supporttype="plugin" supportname="'.$plugin.'">Importar Configuración</button> <img src="'.plugins_url('/assets/img/loader7.gif', dirname(__FILE__)).'" class="loader" style="display:none" /></p></div>';
                }
            }
        }

        if ($post_selected && $post_selected != __('Selecciona', 'ch_nella_sooprema')) {
            $html .= '
            <table class="form-table">
             <!--   <tr>
                    <th scope="row">
                    <label for="referencia">La Id principal para los inmuebles será</label>
                    </th>
                    <td>$select_set_id<p>Será el indentificador (metadata) único para poder vincular los inmuebles con el PostType</p></td>
                </tr> -->
                <tr>
                    <th scope="row">
                        <p>Nombre del Estado del Inmueble (status):<p>
                       
                    </th>
                    <td class="column_status"> 
                    <p>Venta = <span>'.get_option('status_venta', 'VENTA').'</span><input type="text" name="status_venta" class="hidden" value="'.get_option('status_venta', 'VENTA').'" /></p>
                    <p>Alquiler = <span> '.get_option('status_alquiler', 'ALQUILER').'</span><input type="text" name="status_alquiler" class="hidden" value="'.get_option('status_alquiler', 'ALQUILER').'" /></p>
                    <p><input type="button" class="button button-primary button-large" id="cambiar_status" value="Cambiar"></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        Añadir Campo Estático
                    </th>
                    <td>
                        <input type="text" id="name_xml" placeholder="PostType Meta data">
                        <input type="text" id="value_xml" placeholder="Valor Meta">
                        <input type="button" class="button button-primary button-large" id="add-row" value="Agregar">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                    Listado de Taxonomías
                    </th>
                    <td>
                        '.$data_taxonomies.'
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                    Listado de Relaciones
                    <input type="submit" value="Actualizar" name="ch_sooprema_admin" class="button button-primary button-large button-sooprema">
                    </th>
                    <td>
                        '.$data_term.'
                    </td>
                </tr>
            </table>';

            $html .= ' <script>
            
            jQuery( document ).ready(function() {

                jQuery("select").change(function() {

                    var newVal = jQuery(this).val();
                    var parent = jQuery(this).parent().attr("id");
                    var parent_json = parent.replace("xml", "json");

                    jQuery("#"+parent+" > input[type=\'hidden\'").val(newVal);
                
                    if(jQuery( "option:selected",this ).text() == "otro") {
                        jQuery("#"+parent+" > input[type=\'text\'").show();
                        // para mostrar el input en el json
                        jQuery("#"+parent_json+" > input[type=\'text\'").show();
                    } else {
                        jQuery("#"+parent+" > input[type=\'text\'").val(\'\').hide();
                        // para ocultar el input en el json
                        jQuery("#"+parent_json+" > input[type=\'text\'").val(\'\').hide();
                    }
                    //console.log("nuevo valor= "+newVal+" y su id es ="+parent);
                });
                jQuery("#cambiar_status").click(function(){
                    jQuery(".column_status span").hide();
                    jQuery("input[name=\'status_venta\']").show();
                    jQuery("input[name=\'status_alquiler\']").show();
                    jQuery(this).hide();
                });
                jQuery("#add-row").click(function() {
                    var name_xml = jQuery("#name_xml").val();
                    var value_xml = jQuery("#value_xml").val();
                    // Compruebo campos vacíos
                    if(name_xml == "") {
                        alert("El campo Tipo de Clave no puede estar vacío");
                        jQuery("#name_xml").focus();
                        return false;
                    }
                    if(value_xml == "") {
                        alert("El campo Valor no puede estar vacío");
                        jQuery("#value_xml").focus();
                        return false;
                    }
                    var data_term = "";
                    data_term += "<tr class=\'nueva_fila\'>";
                    data_term += "<td><span>" + name_xml + " =></span></td>";
                    data_term += "<td id=\'" + name_xml + "_xml\'>";
                    data_term += "<input type=\'hidden\' name=\'static_values[" + name_xml + "]\' value=\'" + value_xml + "\'>";
                    data_term += value_xml;
                    data_term += "</td>";
                    data_term += "<td>" + value_xml + " <span class=\'dashicons dashicons-trash\'></span><a href=\'javascript:void(0)\' class=\'delete-row\'>Borrar</a></td>";
                    data_term += "</tr>";
                    jQuery("table#data_term tbody").append(data_term);
                    
                    // proceso el formulario disparando el vento click sobre el boton actualizar
                    jQuery("[name=\'ch_sooprema_admin\']").trigger("click");
                });

                // evento para eliminar fila de static values
                jQuery(document).on(\'click\', \'.delete-row\', function() {
                    if(confirm("¿Estas seguro/a?")) {
                        //console.log(jQuery(this).parents("tr.nueva_fila"));
                        jQuery(this).parents("tr.nueva_fila").remove();
                        // proceso el formulario disparando el vento click sobre el boton actualizar
                        jQuery("[name=\'ch_sooprema_admin\']").trigger("click");
                    }
                });
                jQuery(document).on("click",".button-undo", function(){
                    jQuery.ajax({
                        type: "POST",
                        url: "'.site_url().'/wp-admin/admin-ajax.php", 
                        data: {"action":"import_undo"},
                        success:function(msg){
                              jQuery(".button-undo").parent().find(".loader").hide();
                              location.reload();
                        }
                    });

                });
                jQuery(document).on("click",".button-support", function(){
                    var type= jQuery(this).attr("supporttype");
                    var name = jQuery(this).attr("supportname");
                    jQuery(this).hide();
                    jQuery(this).parent().find(".loader").show();
                    jQuery.ajax({
                        type: "POST",
                        url: "'.site_url().'/wp-admin/admin-ajax.php", 
                        data: {"action":"import_support","type":type,"name":name},
                        success:function(msg){
                              jQuery(".button-support").parent().find(".loader").hide();
                              location.reload();
                        }
                    });
                });
            });
            </script> ';
        } else {
            $html .= '<style>.submit{ display:none}</style><p>Primero debes seleccionar el PostType en Opciones Generales</p>';
        }

        return $html;
    }

    public static function Tab_cronjobs()
    {
        $time = ini_get('max_execution_time');
        $url = get_site_url().'/wp-admin/admin-ajax.php/?action=sooprema_cron';
        $url_queue = get_site_url().'/wp-admin/admin-ajax.php/?action=pqueue_cron';
        $url_borrar = get_site_url().'/wp-admin/admin-ajax.php/?action=borrar_excedentes';
        $warning = $time <= 120 ? '<div class="notice-success notice is-dismissible"><p>El tiempo de ejecución de PHP del servidor es de '.$time.' segundos. Es posible que tenga problemas con la Importación Masiva. En caso suceda esto aumentar el tiempo de ejecución de PHP a un tiempo mayor.</p></div>' : '';
        $html = '
        <h1>Tarea programada</h1>
        '.$warning.'
        <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="sooprema_activar_cron">Activar Tareas Automatizadas</label>
                </th>
                <td>
                    <select name="sooprema_activar_cron">
                        <option value="1" '.(get_option('sooprema_activar_cron') == '1' ? 'selected' : '').' >Si</option>
                        <option value="" '.(get_option('sooprema_activar_cron') == '' ? 'selected' : '').' >No</option>
                    </select>
                    <p>Selecciona si deseas que se active las tareas automatizadas. </p>
                    <p><span style="color:red">Atención:</span> Su hosting debe tener activado las tareas programadas. Debes crear las tareas programadas dependiendo del tiempo que quieras actualizarlo. </p>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="sooprema_activar_borrado_masivo">Activar Borrado Masivo</label>
                </th>
                <td>
                    <select name="sooprema_activar_borrado_masivo">
                        <option value="1" '.(get_option('sooprema_activar_borrado_masivo') == '1' ? 'selected' : '').' >Si</option>
                        <option value="" '.(get_option('sooprema_activar_borrado_masivo') == '' ? 'selected' : '').' >No</option>
                    </select>
                    <p>Selecciona si deseas que se active el borrado masivo luego de la importación. </p>
                </td>
            </tr>
            <!--  <tr>
                <th scope="row">
                    <label for="sooprema_frecuencia">Frecuencia</label>
                </th>
                <td>
                    <select name="sooprema_frecuencia">
                        <option value="hourly" '.(get_option('sooprema_frecuencia') == 'hourly' ? 'selected' : '').' >Cada Hora</option>
                        <option value="daily" '.(get_option('sooprema_frecuencia') == 'daily' ? 'selected' : '').' >Diario</option>
                        <option value="twicedaily" '.(get_option('sooprema_frecuencia') == 'twicedaily' ? 'selected' : '').' >Interdiario</option>  
                    </select>
                    <p>Selecciona la frecuencia: <b>OJO: Si cambia este apartado debe desactivar y volver a activar el plugin en la sección de <a href="/wp-admin/plugins.php">Plugins</a></b></p>
                </td>
            </tr>-->
            <tr>
                <th scope="row">
                    <label for="sooprema_frecuencia">Notificar Cron</label>
                </th>
                <td>
                    <input type="text" class="regular-text" value="'.get_option('sooprema_cron_email').'" name="sooprema_cron_email" />
                    <p>Escribe un email donde se notificara la ejecución del cronjob. En caso esté vacío se enviará a administrador del sitio.</p>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label>Url Para activar el Cron Job de importación masiva</label>
                </th>
                <td>
                    <b>'.$url.'</b><p>Esta URL debes activarlo en las tareas programadas de tu servidor.</p>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label>Url Para activar el Cron Job de procesamiento de colas</label>
                </th>
                <td>
                    <b>'.$url_queue.'</b><p>Esta URL debes activarlo en las tareas programadas de tu servidor.</p>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label>Url Para activar el Cron Job de borrado masivo</label>
                </th>
                <td>
                    <b>'.$url_borrar.'</b><p>Esta URL debes activarlo en las tareas programadas de tu servidor.</p>
                </td>
            </tr>
        </table>';

        return $html;
    }

    /**
     * Muestra la Pestaña de Importación masiva.
     *
     * @version 1.0
     *
     * @author Carlos Herrera (https://carlos-herrera.com)
     *
     * @return string HTML
     */
    public static function Tab_import()
    {
        $sooprema = new SoopremaController();
        $xml = ''; //$sooprema->GetXML();
        $ftp = 0; //$xml?count($xml)-1:0;
        $post_selected = get_option('sooprema_post_type');
        $html = '';
        //print_r($xml);
        if ($post_selected && $post_selected != __('Selecciona', 'ch_nella_sooprema')) {
            $html = '
            <style>.submit{ display:none}</style>
            <h1>Importación</h1>
           
            <div class="notice-success notice"><div id="count_loading"><p>'.__('Calculating Properties:', 'ch_sooprema').'</p> <img src="'.plugins_url('assets/img/loader.gif', dirname(__FILE__)).'" /></div><div id="count_result" style="display:none "><span style="font-size: 20px; font-weight: bold; line-height: 21px;"></span> '.__('Properties to import.', 'ch_sooprema').'    <button id="reloadProperties" class="button button-primary button-small"><small>Recargar Propiedades</small></button></div></div>

            <p class="importar">
                
            </p>
            
            <table class="form-table mb-3" >
                <tr>
                    <th>
                        <label>Importar muestra</label>
                    </th>
                    <td>
                        <select name="select_importar_muestra" id="select_importar_muestra">
                            <option value="position">Por posición</option>
                            <option value="id_sooprema">Por Id de Sooprema</option>
                            <option value="from">Desde la posición</option>
                            <option value="to">Hasta la posición</option>
                        </select>
                    </td>
                    <td id="td_import_value">
                        <input type="number" name="import_value" id="import_value" value="" />
                    </td>
                    <td><input type="button" value="Importar muestra" name="ch_ideal_import_ajax" class="button button-primary button-large button-import-muestra"></td>
                </tr>
                <tr>
                    <th>
                        Importar todos
                    </th>
                    <td style="display:flex; align-items:center;gap:30px;position:relative;">
                        <input type="button" value="Importar Todos" name="ch_ideal_import_ajax" class="button button-primary button-large button-import-ajax">
                        <div style="position:absolute;left:150px;align-items:center;">
                            <input type="checkbox" name="ch_ideal_check_delete" id="ch_ideal_check_delete">
                            <label for="ch_ideal_check_delete">Activar borrado masivo</label>
                        </div>
                    </td>
                </tr>
            </table>
            <h3>Borrar Inmuebles no listados en Witei</h3>
            <p>
                <input type="button" value="Borrado masivo" name="ch_ideal_import_ajax" class="button button-secondary button-large button-delete-ajax">
            </p>
            <p class="pendientes hidden">
                <span></span><input type="button" value="Importar Pendientes" name="ch_ideal_import_ajax" class="button button-primary button-large button-import-pending-ajax">
            </p>
            <div id="mensaje_borrado" class="hidden">
                <p>Borrando... <img src="'.plugins_url('assets/img/loader.gif', dirname(__FILE__)).'" /></p>
                <p></p>
            </div>
            <div id="loader" class="hidden">
                <p style="display:flex;align-items:center;"><img src="'.plugins_url('assets/img/loader.gif', dirname(__FILE__)).'" />
                Cargando inmuebles, por favor espere...</p>
            </div>
            <div><ul id="resultado" inmuebles="">';
            $html .= '
            </ul></div>
            <script type="text/javascript">
            var pendientes  = [];
            var contador    = 1;
            var counterFrom   = 1;
            var counterTo     = parseInt(jQuery("#resultado").attr("inmuebles"));
            
            jQuery( document ).ready(function() {
                jQuery(".button-import-ajax").prop("disabled", true);
                jQuery(".button-import-muestra").prop("disabled", true);
                jQuery(".button-delete-ajax").prop("disabled", true);
                contador_inmuebles("");

                jQuery(document).on("click",".button-import-muestra",function(){

                    var seleccion = jQuery("#select_importar_muestra").val();
                    var import_value = parseInt(jQuery("#import_value").val());
                    var inmuebles = parseInt(jQuery("#resultado").attr("inmuebles"));

                    switch(seleccion)
                    {
                        case "position":
                            jQuery("#loader").show();
                            importar_uno(import_value);
                            break;
                        case "id_sooprema":
                            jQuery("#loader").show();
                            buscar_posicion_por_id(import_value);
                            break;
                        case "from":
                            if(isNaN(import_value) || import_value == "" || import_value == 0 || import_value > inmuebles)
                            {
                                alert("Debes ingresar un rango de inmuebles a importar valido");
                                jQuery("#import_value").focus();
                                break;
                            }
                            jQuery("#loader").show();
                            counterFrom = import_value;
                            counterTo = inmuebles;
                            importar_uno(import_value, "muestra");
                            break;
                        case "to":
                            if(isNaN(import_value) || import_value == "" || import_value == 0 || import_value > inmuebles)
                            {
                                alert("Debes ingresar un rango de inmuebles a importar valido");
                                jQuery("#import_value").focus();
                                break;
                            }
                            jQuery("#loader").show();
                            counterFrom = 1;
                            counterTo = import_value;
                            importar_uno(1, "muestra");
                            break;
                         
                        default:
                            alert("Selecciona una opción");
                            break;
                    }
                    
                    
                    
                });
                jQuery(document).on("click","#reloadProperties",function(){
                    jQuery("#count_loading").show();
                    jQuery("#count_result").hide();
                    contador_inmuebles("refresh");
                });
                
                jQuery(document).on("click",".button-import-ajax",function(){
                    jQuery("#ch_ideal_check_delete").prop("disabled", true);
                    jQuery("#loader").show(); // add loading
                    var inmuebles= jQuery("#resultado").attr("inmuebles");
                    //console.log("imuebles = "+inmuebles);
                    var result=[];
                    importar_uno(1,"masivo");
                });
                jQuery(document).on("click",".button-import-pending-ajax", function(){
                    importar_pendientes();
                });
                jQuery(document).on("click",".button-delete-ajax",function(){
                    borrar_excedentes();
                });
            });
            function contador_inmuebles(refresh)
            {
                jQuery.ajax({
                    type: "POST",
                    url: "'.site_url().'/wp-admin/admin-ajax.php",
                    async: true,
                    data: {"action":"sooprema_count","refresh":refresh},
                    success: function(msg){
                        jQuery("#count_loading").hide()
                        jQuery("#count_result > span").text(msg.count);
                        jQuery("#count_result").show();
                        for (var i = 0; i < msg.count; i++) {
                            jQuery("#resultado").attr("inmuebles",msg.count);
                            jQuery("#resultado").append("<li><div></div></li>");
                        }
                        jQuery(".button-import-ajax").prop("disabled", false);
                        jQuery(".button-import-muestra").prop("disabled", false);
                        jQuery(".button-delete-ajax").prop("disabled", false);
                    }
                });
            }
            function buscar_posicion_por_id(id_idealista)
            {
                jQuery.ajax({
                    type: "POST",
                    url: "'.site_url().'/wp-admin/admin-ajax.php",
                    async: true, 
                    data: {"action":"sooprema_test","id_idealista":id_idealista},
                    success: function(msg){
                        console.log(msg.position);
                        importar_uno(msg.position);
                    }
                });
            }
            function mostrar_pendientes(n)
            {
                jQuery(".pendientes span").html("Han quedado pendientes de importar "+n+" inmuebles " );
                jQuery("p.pendientes").show();
                alert("hay "+n.result.count+" pendientes");
            }
            function borrar_excedentes()
            {
                jQuery.ajax({
                    type: "POST",
                    url: "'.site_url().'/wp-admin/admin-ajax.php", 
                    data: {"action":"borrar_excedentes"},
                    beforeSend:function(){
                        jQuery("#mensaje_borrado").show();
                        jQuery("#mensaje_borrado").find("p").eq(0).show();
                    },
                    success: function(msg){
                        jQuery("#mensaje_borrado").find("p").eq(0).hide();
                        jQuery("#mensaje_borrado").find("p").eq(1).show().html("Se ha borrado "+msg.count+" inmuebles que no aparecían en Witei");
                    },
                    error: function(msg){
                        jQuery("#mensaje_borrado").hide();
                        jQuery("#mensaje_borrado").find("p").eq(0).show();
                        jQuery("#mensaje_borrado").find("p").eq(0).hide();
                        alert("error: "+msg)
                    }
                });
            }
            function importar_uno(i,s,from,to)
            {
                var borrar="'.get_option('sooprema_borrar').'";
                var total=jQuery("#resultado").attr("inmuebles");
                jQuery.ajax({
                    type: "POST",
                    url: "'.site_url().'/wp-admin/admin-ajax.php", 
                    data: {"action":"import_sooprema","id":i},
                    async: true,
                    beforeSend:function(){
                        jQuery("#resultado > li").eq(i-1).find("div").addClass("notice").removeClass("notice-success").removeClass("notice-error").addClass("notice-warning")
                        jQuery("#resultado > li").eq(i-1).find("div").html("Importando Inmueble # "+i+"");
                    },
                    success: function(msg){
                        jQuery("#loader").hide();
                        var res = msg;
                        
                        jQuery("#resultado > li").eq(i-1).find("div").find("img").hide();
                        if(res.result=="ok")
                        {
                            jQuery("#resultado > li").eq(i-1).find("div").removeClass("notice-warning").addClass("notice-success"); 
                            jQuery("#resultado > li").eq(i-1).find("div").append("<span> Realizado: <b>"+res.title+"</b></span>");
                        }
                        else
                        {
                            jQuery("#resultado > li").eq(i-1).find("div").removeClass("notice-warning").addClass("notice-error"); 
                            jQuery("#resultado > li").eq(i-1).find("div").append("<span> Noticia: <b>"+res.details+"</b></span>");
                        }
                        
                        if(jQuery("#resultado > li").eq(i).length)
                        {
                            jQuery("html, body").animate({
                                scrollTop: jQuery("#resultado > li").eq(i).offset().top
                            }, 2000);
                        }
                        
                        if (res.foto !== null&&res.result=="ok")
                        {
                            if(res.foto.length)
                            {
                                
                                jQuery("#resultado > li").eq(i-1).find("div").append("<span> Importando "+res.foto.length+" fotos</span>");
                                jQuery("#resultado > li").eq(i-1).find("div").append("<ul></ul>");
                                
                                importar_fotos_async(res.foto.length,i,res);
                            }
                        }
                        if(s=="masivo"&&contador<=total)
                        {
                            contador++;
                            importar_uno(contador,"masivo")

                        }
                        if(s=="muestra"&&counterFrom<counterTo)
                        {
                            counterFrom++;
                            importar_uno(counterFrom,"muestra")
                        }
                        if((total==i)&&(pendientes.length>0))
                        {
                            mostrar_pendientes(pendientes.length);
                        }
                        return true;
                    },
                    error: function(msg){
                        jQuery("#loader").hide();
                        jQuery("#resultado > li").eq(i-1).find("div").find("img").hide();
                        jQuery("#resultado > li").eq(i-1).find("div").removeClass("notice-warning").addClass("notice-error");
                        jQuery("#resultado > li").eq(i-1).find("div").append("<span> Error</span>");
                        pendientes.push(i);
                        console.log(pendientes);
                        if(s=="masivo"&&contador<=total)
                        {
                            contador++;
                            importar_uno(contador,"masivo")
                        }
                        if(s=="muestra"&&counterFrom<counterTo)
                        {
                            counterFrom++;
                            importar_uno(counterFrom,"muestra")
                        }
                        if((total==i)&&(pendientes.length>0))
                        {
                            mostrar_pendientes(pendientes.length);
                        }
                        return false;
                    }
                    });
                if(s=="masivo"&&total==i)
                {
                    jQuery("#ch_ideal_check_delete").prop("disabled", false);
                }
                if(jQuery("#ch_ideal_check_delete").is(":checked")&&s=="masivo"&&i==total)
                {
                    borrar_excedentes();
                }
            }

            async function importar_fotos_async(length,i,res){
                var p;
                for(p=1; p<= length; ++p )
                {
                    jQuery("#resultado > li").eq(i-1).find("ul").append("<li><div class=\'notice-warning notice is-dismissible\'>Importando foto "+res.foto[p-1]+" <img src=\'"+res.foto[p-1]+"\' width=\'40px\' /></div></li>");
                    await importar_foto(i-1, p-1, res.id, res.foto[p-1]);
                }
            }

            async function importar_foto(i, p, id, file) {
                return new Promise(function(resolve, reject) {
                  jQuery.ajax({
                    type: "POST",
                    url: "'.site_url().'/wp-admin/admin-ajax.php",
                    data: { "action": "import_sooprema_foto", "id": id, "file": file, "position": p },
                    async: true,
                    success: function(msg) {
                      //var res = JSON.parse(msg);
                      var res = msg;
                      if (res.result == "ok") {
                        jQuery("#resultado > li").eq(i).find("div").find("ul").find("li").eq(p).find("div").removeClass("notice-warning").addClass("notice-success");
                      } else {
                        jQuery("#resultado > li").eq(i).find("div").find("ul").find("li").eq(p).find("div").removeClass("notice-warning").addClass("notice-error");
                      }
                      resolve(res);
                    },
                    error: function(msg) {
                      jQuery("#resultado > li").eq(i).find("div").find("ul").find("li").eq(p).find("div").removeClass("notice-warning").addClass("notice-error");
                      var error = { result: "error", message: msg };
                      reject(error);
                    }
                  });
                });
            }

            function importar_pendientes()
            {
                var lista=pendientes;
                var result=[];
                pendientes=[];
                
                for (i = 0; i < lista.length; ++i) {
                    result.push(importar_uno(lista[i]));
                }
                jQuery.when.apply(this, result).done(function () {
                    console.log("done");
                });
            }

            </script> 

            ';
        } else {
            $html .= '<style>.submit{ display:none}</style><p>Primero debes seleccionar el PostType en Opciones Generales</p>';
        }

        return $html;
    }

    /**
     * Muetsra pestaña del Webhook.
     *
     * @version 1.0
     *
     * @author Carlos Herrera
     *
     * @return string HTML
     */
    public static function Tab_Webhook()
    {
        $url = admin_url('admin-ajax.php').'/?action=sooprema';
        $img = plugins_url('/assets/img/webhook.png', dirname(__FILE__));
        $img2 = plugins_url('/assets/img/webhook2.png', dirname(__FILE__));
        $sooprema_task_queue = get_option('sooprema_task_queue');
        $count = is_array($sooprema_task_queue) ? (empty(trim(json_encode($sooprema_task_queue), '{}')) ? 0 : count(explode("},{", trim(json_encode($sooprema_task_queue), '{}')))) : (empty(trim($sooprema_task_queue, '{}')) ? 0 : count(explode("},{", trim($sooprema_task_queue, '{}'))));
        $result = '<h1>WebHook URL</h1>
        <table class="form-table">
            <tr>
                <th scope="row">URL para el Webhook Witei</th>
                <td>'.$url.'</td>
            </tr>
            <tr>
                <th scope="row">¿Insertar sólo los inmuebles del XML?</th>
                <td>
                    <select name="sooprema_webhook_xml">
                        <option value="1" '.(get_option('sooprema_webhook_xml') == '1' ? 'selected' : '').' >Si</option>
                        <option value="" '.(get_option('sooprema_webhook_xml') == '' ? 'selected' : '').' >No</option>  
                    </select>
                    <p>Con esta opción aunque sooprema notifique la creación de un nuevo inmueble no lo aceptará hasta que este en el listado de XML a exportar</p>
                </td>
            </tr>
            <tr>
                <th>Url del xml de Witei a comparar</th>
                <td>
                    <input type="text" name="sooprema_xml_url" value="'.get_option('sooprema_xml_url').'" />
                </td>
            </tr>
            <tr>
                <td colspan="2"><img src="'.$img.'" /></td>
            </tr>
            <tr>
                <td colspan="2"><img src="'.$img2.'" /></td>
            </tr>
        </table>
        <h1>WebHook Queue CronJob</h1>
        <table  class="form-table">
            <tr>
                <th>Nombre de cron en web</th>
                <td>
                    <input type="text" name="count_sooprema_task_queue" value="'.wp_get_schedule('cron_job_callback').'" />
                    <p>Si el cuadro se encuentra vacío, es indicación que el proceso a sido interrumpido en la web. </p>
                    <p>Si el proceso es interrumpido continuamente, se recomienda activar en su servidor el cronjob de colas indicado en la pestaña "Cron job". </p>
                </td>
            </tr>
			<tr>
                <th>Elementos en Cola</th>
                <td>
                    <input type="text" name="count_sooprema_task_queue" id="queue_count" value="'.(empty(trim(get_option('sooprema_task_queue'), '{}')) ? 0 : count(explode("},{", trim(get_option('sooprema_task_queue'), '{}')))).'" />
                </td>
            </tr>
			<tr>
                <th>
                    Procesar Cola
                    </th>
                    <td>
                        <input type="button" value="Procesar Cola" name="ch_ideal_import_ajax" class="button button-primary button-large button-import-queue">
                    </td>
                </tr>
            <tr>
            <tr>
                <th>
                    Limpiar Cola
                    </th>
                    <td>
                        <input type="button" value="Limpiar Cola" name="ch_ideal_clean_ajax" class="button button-primary button-large button-clean-queue">
                    </td>
                </tr>
            <tr>
        </table>
		<script type="text/javascript">
            var pendientes  = [];
            var contador    = 1;
            
            jQuery( document ).ready(function() {
                jQuery(document).on("click",".button-import-queue",function(){
                    var inmuebles= jQuery("#resultado").attr("inmuebles");
                    var result=[];
                    importar_queue(1,"masivo");
                });
                jQuery(document).on("click",".button-clean-queue",function(){
                    var inmuebles= jQuery("#resultado").attr("inmuebles");
                    var result=[];
                    if (confirm("¿Está seguro de que desea limpiar la cola?")) {
                        clean_queue(1, "masivo");
                    }
                });
            });

            function importar_queue(i,s)
            {
                var borrar="'.get_option('sooprema_borrar').'";
                var total='.count(explode("},{", trim(get_option('sooprema_task_queue'), '{}'))).';
                jQuery.ajax({
                    type: "POST",
                    url: "'.site_url().'/wp-admin/admin-ajax.php", 
                    data: {"action":"import_queue","id":i},
                    async: true,
                    success: function(msg){
                        var res = msg;
                        if(s=="masivo"&&contador<=total)
                        {
                            contador++;
                            importar_queue(contador,"masivo")
                        }
                        return true;
                    },
                    error: function(msg){
                        if(s=="masivo"&&contador<=total)
                        {
                            contador++;
                            importar_queue(contador,"masivo")
                        }
                        return false;
                    }
                    });
            }

            function clean_queue(i,s){
                jQuery.ajax({
                    type: "POST",
                    url: "'.site_url().'/wp-admin/admin-ajax.php", 
                    data: {"action":"clean_queue","id":i},
                    async: true,
                    success: function(msg){
                        var res = msg;
                        var queueCount = 0;
                        jQuery("#queue_count").val(queueCount);
                        return true;
                    },
                    error: function(msg){
                        return false;
                    }
                    });
            }
        </script> 
        ';

        return $result;
    }

    /**
     * Muetsra pestaña del FeedBack.
     *
     * @version 1.0
     *
     * @author Antonio Jenaro
     *
     * @return string HTML
     */
    public static function Tab_FeedBack()
    {
        $result = '<h1>FeedBack</h1>
        <table class="form-table">
            <tr>
                <th scope="row">'.__("Feedback type", "ch_sooprema").'</th>
                <td>
                    <select name="sooprema_feedback_sugerencia" id="sooprema_feedback_sugerencia">
                        <option value="">'.__("Select", "ch_sooprema").'Selecciona</option>
                        <option value="error">'.__("Plugin error", "ch_sooprema").'</option>
                        <option value="sugerencia">'.__("Suggestion", "ch_sooprema").'</option>  
                    </select>
                </td>
            </tr>
            <tr style="display: none;" id="fila_error">
                <th scope="row">Tipo de Error</th>
                <td>
                    <select name="sooprema_feedback_error" id="sooprema_feedback_error">
                        <option value="">'.__("Select", "ch_sooprema").'</option>
                        <option value="imagenes">No carga imágenes</option>
                        <option value="no funciona">No funciona</option>  
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row">Comentario</th>
                <td>
                    <textarea rows="5" cols="80" id="sooprema_feedback_texto" name="sooprema_feedback_texto"></textarea>
                </td>
            </tr>
            <tr>
                <th scope="row"></th>
                <td>
                    <input type="button" value="Enviar" id="sooprema_feedback_button" class="button button-primary button-large">
                </td>
            </tr>
        </table>
        <script>
            jQuery(document).on("change","#sooprema_feedback_sugerencia",function() {
                // muestro información adicional en caso de error del plugin
                var asunto = jQuery("#sooprema_feedback_sugerencia").val();
                if(asunto == "error") {
                    // muestro la fila inferior
                    jQuery("#fila_error").show();
                } else {
                    jQuery("#fila_error").hide();
                }
            });
            jQuery(document).on("click","#sooprema_feedback_button",function() {
                // compruebo campos
                var sugerencia = jQuery("#sooprema_feedback_sugerencia").val();
                var error = jQuery("#sooprema_feedback_error").val();
                var msg = jQuery("#sooprema_feedback_texto").val();

                if(sugerencia == "") {
                    alert("El campo Tipo de Sugerencia no puede estar vacío");
                    jQuery("#sooprema_feedback_sugerencia").focus();
                    return false;
                }
                if(sugerencia == "error" && error == "") {
                    alert("El campo Tipo de Error no puede estar vacío");
                    jQuery("#sooprema_feedback_error").focus();
                    return false;
                }
                if(msg == "") {
                    alert("El campo Comentario no puede estar vacío");
                    jQuery("#sooprema_feedback_texto").focus();
                    return false;
                }

                var data = { "action" : "send_feedback_email", "sugerencia" : sugerencia, "msg" : msg, "error" : error };
                jQuery.post("'.site_url().'/wp-admin/admin-ajax.php", data, function(response) {
                    if(response.result) {
                        // reseto campos
                        jQuery("#sooprema_feedback_sugerencia").val("");
                        jQuery("#sooprema_feedback_error").val("");
                        jQuery("#sooprema_feedback_texto").val("");
                        // oculto la fila
                        jQuery("#fila_error").hide();
                        alert("Mensaje Enviado Correctamente");
                    } else {
                        alert("ERROR: No se pudo enviar el mensaje");
                    }
                });
            });
        </script>
        ';

        return $result;
    }

    /**
     * Muetra pestaña de Valores Importación.
     *
     * @version 1.0
     *
     * @author Antonio Jenaro
     *
     * @return string HTML
     */
    public static function Tab_Valores()
    {
        $result = '<h1>Valores Importación</h1>
        <table class="form-table">
            <tr>
                <th scope="row">Tipo de Dato</th>
                <td>
                    <select name="sooprema_data_type" id="sooprema_data_type">
                        <option value="">Selecciona</option>
                        <option value="sooprema_xml_">XML</option>
                        <option value="sooprema_json_">JSON</option>  
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row">Valor</th>
                <td>
                    <input type="text" name="sooprema_data_value" id="sooprema_data_value" placeholder="Valor">
                </td>
            </tr>
            <tr>
                <th scope="row">Valores</th>
                <td>
                    
                    
                </td>
            </tr>
            <tr>
                <th scope="row"></th>
                <td>
                    <input type="button" value="Enviar" id="insert_data_button" class="button button-primary button-large">
                </td>
            </tr>
        </table>
        <script>
            jQuery(document).on("click","#insert_data_button",function() {
                // compruebo campos
                var tipo = jQuery("#sooprema_data_type").val();
                var opcion = jQuery("#sooprema_data_option").val();
                var valor = jQuery("#sooprema_data_value").val();

                if(tipo == "") {
                    alert("El campo Tipo no puede estar vacío");
                    jQuery("#sooprema_data_type").focus();
                    return false;
                }
                
                if(valor == "") {
                    alert("El campo Valor no puede estar vacío");
                    jQuery("#sooprema_data_value").focus();
                    return false;
                }
                
                var data = { "action" : "add_sooprema_data_import", "tipo" : tipo, "valor" : valor };
                jQuery.post("'.site_url().'/wp-admin/admin-ajax.php", data, function(response) {
                    if(response.result) {
                        // reset fields
                        jQuery("#sooprema_data_type").val("");
                        jQuery("#sooprema_data_value").val("");
                        alert("Valor agregado correctamente");
                    } else {
                        alert("ERROR: No se pudo grabar el registro");
                    }
                });
            });
        </script>
        ';

        return $result;
    }

    private static function ComprobarTema($tema)
    {
        $import = new ImportPropertyController();
        $temas_disponibles = json_decode($import->GetCurl('https://apisooprema.carlos-herrera.es/api/v1/compatible/theme'));

        if ($temas_disponibles != '' && in_array(strtolower($tema), $temas_disponibles)) {
            return true;
        } else {
            return false;
        }
    }

    private static function ComprobarPlugins($plugins)
    {
        $import = new ImportPropertyController();
        $resultado = [];
        $plugins_disponibles = json_decode($import->GetCurl('https://apisooprema.carlos-herrera.es/api/v1/compatible/plugin'));
        if ($plugins_disponibles != '') {
            foreach ($plugins as $plugin) {
                $plugin = explode('/', $plugin);
                if (in_array($plugin[0], $plugins_disponibles)) {
                    $resultado[] = $plugin[0];
                }
            }
        }

        if (!empty($resultado) && count($resultado) < 0) {
            return $resultado;
        } else {
            return false;
        }
    }
}
