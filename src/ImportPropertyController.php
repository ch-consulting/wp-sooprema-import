<?php

namespace CHSOOPREMA;

class ImportPropertyController
{
    public function __construct()
    {
        //echo "estoy en el constructor";
    }

    /**
     * Insertar fotos a un POST.
     *
     * Importa la imagen de internet y lo inserta a WP
     *
     * @author  Carlos Herrera
     *
     * @param string $image_url la URL del post
     * @param int    $post_id   la ID del post a relacionar
     * @param int    $number    El numero de orden que desees que aparezca
     * @param bool   $feature   Si la foto será la destacada del post o no (true | false)
     *
     * @return int la id del post_type asociado con la foto
     */
    public static function insertar_foto($image_url, $post_id, $number = 0, $feature = false)
    {
        global $wpdb;
        global $wp_rewrite;
        // Add Featured Image to Post
        $filename = 'image_'.$post_id.'_'.(string) $number.'.jpg';  // Create image file name
        $query = "SELECT ID FROM {$wpdb->prefix}posts WHERE post_title = '$filename' LIMIT 1";
        $attach_id = $wpdb->get_var($query);
        if (!$attach_id) {
            $upload_dir = wp_upload_dir(); // Set upload folder
            $value = 0;
            $intento = 1;
            while ($value <= 50 && $intento <= 3) {
                if (ini_get('allow_url_fopen') == true) {
                    $image_data = file_get_contents($image_url);
                } else {
                    $image_data = self::GetCurl($image_url);
                }

                $size = $image_data?strlen($image_data):0;
                if ($size == 0 || empty($size)) {
                    return false;
                }

                try {
                    $value = round($size / pow(1024, ($i = floor(log($size, 1024)))), 2);
                } catch (DivisionByZeroError $e) {
                    return false;
                }
                   
                ++$intento;
            }
            // Get image data
            // $filename   = 'image_'.$post_id.'_'.$number.'.jpg';  // Create image file name

            // Check folder permission and define file location
            if (wp_mkdir_p($upload_dir['path'])) {
                $file = $upload_dir['path'].'/'.$filename;
            } else {
                $file = $upload_dir['basedir'].'/'.$filename;
            }

            // Create the image  file on the server
            file_put_contents($file, $image_data);

            // Check image file type
            $wp_filetype = wp_check_filetype($filename, null);

            // Set attachment data
            $attachment = [
                'post_mime_type' => $wp_filetype['type'],
                'post_title' => sanitize_file_name($filename),
                'post_content' => '',
                'post_status' => 'inherit',
            ];

            // Create the attachment
            $attach_id = wp_insert_attachment($attachment, $file, $post_id);
            // Include image.php
            require_once ABSPATH.'wp-admin/includes/image.php';
            $attach_data = wp_generate_attachment_metadata($attach_id, $file);
            wp_update_attachment_metadata($attach_id, $attach_data);
            // Define attachment metadata

            // And finally assign featured image to post
            if ($feature) {
                set_post_thumbnail($post_id, $attach_id);
            }
            return $attach_id;
        } else {
            //compare files
            $path = get_attached_file($attach_id);
           
            if (ini_get('allow_url_fopen') == true) {
                
                $file = file_get_contents($path);
                $url = file_get_contents($image_url);

            } else {
               
                $file = self::GetCurl($path);
                $url = self::GetCurl($image_url);

            }
           
            if (base64_encode($file) != base64_encode($url)) {
                file_put_contents($path, $url);
                $new_metadata =wp_generate_attachment_metadata($attach_id, $path);
                wp_update_attachment_metadata($attach_id, $new_metadata);
            }
            return $attach_id;
        }
    }

    /**
     * Agregar Taxonomía.
     *
     * Agrega de forma distinta a WP la taxonomía que necesita
     *
     * @author Carlos Herrera
     *
     * @param int    $post      La id del post a agregar la taxonomía
     * @param string $taxonomia El nombre de la taxonomía a agregar
     * @param bool   $padre     Si es una taxonomía padre o no (true |false)
     * @param string $termino   El valor a insertar en esa taxonomía
     *
     * @return void
     */
    public function agregar_taxonomia($post, $taxonomia, $termino)
    {
        //die("post = $post, tax = $taxonomia, padre= $padre, termino = $termino");
        global $wpdb;
        $padre = false;
        $terms = $wpdb->prefix.'terms';
        $relationships = $wpdb->prefix.'term_relationships';
        $term_taxonomy = $wpdb->prefix.'term_taxonomy';
        $id_padre = 0;

        //buscamos padre si existe
        if ($padre || $padre != '') {
            $query_padre = "SELECT * FROM $terms WHERE name='$padre'";
            $existe_padre = $wpdb->get_row($query_padre);
            $id_padre = $existe_padre->term_id;
        }

        $query = "SELECT * FROM $terms WHERE name='$termino' ORDER by term_id DESC LIMIT 1";
        $existe = $wpdb->get_row($query);
        //die(print_r($existe));
        if ($existe->term_id) {
            //relaciona
            //buscamos el Term_taxonomy_id
            $term_taxonomy_id = $wpdb->get_var("SELECT term_taxonomy_id FROM $term_taxonomy WHERE term_id='{$existe->term_id}' LIMIT 1");
            $params = ['object_id' => $post, 'term_taxonomy_id' => $term_taxonomy_id, 'term_order' => 0];
            $wpdb->insert($relationships, $params);
            //$wpdb->update($term_taxonomy, array('taxonomy'=>$taxonomia), array('taxonomy'=>'property-zone'));
            $count = $wpdb->get_var("SELECT COUNT(*) FROM $relationships WHERE term_taxonomy_id='$term_taxonomy_id' ");
            $wpdb->update($term_taxonomy, ['count' => $count], ['term_id' => $term_taxonomy_id]);
            //$tax_params=['term_id'=>$existe->term_id, "taxonomy"=>$taxonomia, "parent"=> $id_padre, "count"=> $count];
            // $wpdb->insert($term_taxonomy,$tax_params);
        } else {
            //crea y relaciona
            $term_params = ['name' => $termino, 'slug' => $this->Slug($termino), 'term_group' => 0];
            $wpdb->insert($terms, $term_params);
            $new_term = $wpdb->get_var("SELECT term_id FROM $terms ORDER BY term_id DESC LIMIT 1 ");
            $tax_params = ['term_id' => $new_term, 'taxonomy' => $taxonomia, 'parent' => $id_padre, 'count' => 1];
            $wpdb->insert($term_taxonomy, $tax_params);
            $term_taxonomy_id = $wpdb->get_var("SELECT term_taxonomy_id FROM $term_taxonomy WHERE term_id='$new_term' LIMIT 1");
            $params = ['object_id' => $post, 'term_taxonomy_id' => $term_taxonomy_id, 'term_order' => 0];
            $rel = $wpdb->insert($relationships, $params);
        }
    }

    /**
     * Quitar Taxonomias.
     *
     * quita del post todas las taxonomias que vengan del array
     *
     * @author Carlos Herrera
     *
     * @param int   $post       La id del post
     * @param array $taxonomias el listado de taxonomias
     *
     * @return void
     */
    public function borrar_taxonomias($post, $taxonomias)
    {
        foreach ($taxonomias as $taxonomia) {
            $terms = get_the_terms($post, $taxonomia);
            if ($terms && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                    wp_remove_object_terms($post, $term->term_id, $taxonomia);
                }
            }
        }
    }

    /**
     * Importar Inmueble.
     *
     * Agrega de forma standard un inmueble a WP
     *
     * @author Carlos Herrera
     *
     * @param array  $args        Los valores a insertar en el post
     * @param string $post        El tipo de post type
     * @param string $ref         la referencia del inmueble en metadata (nombre)
     * @param string $id_inmueble el valor del metadata de referencia
     * @param array  $taxonomies  Valores para agregar en las taxonomías del post
     * @param array  $tags        Valores para las etiquetas del post-type
     *
     * @return int la id del post
     */
    public function importar($args, $post, $ref, $id_inmueble, $taxonomies, $tags)
    {
        global $wpdb;
        $post_type = $post;
        $referencia = $ref;
        $data_inmueble = $args;
        $search = $wpdb->get_var("SELECT post_id FROM  {$wpdb->prefix}postmeta WHERE meta_key = '$referencia'  AND meta_value = $id_inmueble ORDER BY post_id ASC LIMIT 1");
        
        if ($search) {
            $data_inmueble['ID'] = $search;
            wp_update_post($data_inmueble);
            $id_post = $search;
        } else {
            $id_post = wp_insert_post($data_inmueble);
        }

        if ($id_post) {
            if ($taxonomies && sizeof($taxonomies) > 0) {
                //var_dump($taxonomies);
                foreach ($taxonomies as $key => $value) {
                    // borro las taxomias antes de crearlas
                    wp_remove_object_terms($id_post, $value, $key);
                    //var_dump($value);
                    if (is_array($value)) {
                        foreach ($value as $val) {
                            // borro las taxomias antes de crearlas
                            wp_remove_object_terms($post, $val, $key);
                            wp_set_object_terms($id_post, $val, $key, true);
                        }
                    } else {
                        wp_set_object_terms($id_post, __($value, 'sooprema-import'), $key);
                    }
                    //$this->agregar_taxonomia($id_post,$tax['name'],$tax['padre'],$tax['value']);
                }
                //   die('fin de taxs');
            }
            if ($tags) {
                foreach ($tags as $key => $meta) {
                    //   $meta_values[$key]= $inmueble[$meta];
                }
            }

            return $id_post;
        } else {
            return false;
        }
    }

    /**
     *  Transformar texto a slug.
     *
     * @param string $string el texto a transformar
     *
     * @return string el texto transformado a SLUG (url amigable)
     */
    public function Slug($string)
    {
        return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
    }

    /**
     * Borrar inmuebles.
     *
     * Borra los inmuebles que no aparecen en la fuente
     *
     * @author Carlos Herrera
     *
     * @version 1.0
     *
     * @param array  $data_xml   el array de los inmuebles con los id de referencia
     * @param string $referencia la referencia del metatype: el valor que se relaciona la id de la fuente externa con la id del post
     * @param string $post_type  el tipo de PostType a buscar
     *
     * @return void
     */
    public static function DeleteProperties($data_xml, $referencia, $post_type)
    {
        if ($data_xml && $referencia && $post_type) {
            $args = [
                'post_type' => $post_type,
                'nopaging' => true,
                'posts_per_page' => -1,
                'meta_query' => [
                    [
                        'key' => $referencia,
                        'value' => $data_xml,
                        'compare' => 'NOT IN',
                    ],
                ],
            ];

            $query = new \WP_Query($args);
            $total = [];
            if ($query->have_posts()) {
                $posts = $query->get_posts();
                foreach($posts as $post) {
                    $verify = 1;
                    $verify = \apply_filters('before_delete_property', $verify, $query->post);
                    if($verify==1) {
                        $query->the_post();
                        self::BorrarMediaAntesDeBorrarInmueble($query->post->ID, $post_type);
                        $resultado = wp_delete_post($query->post->ID);
                        array_push($total, $resultado->ID);
                    }
                }
            }
            return ['count' => count($total), 'values' => $total];
        }

        return 0;
    }

    /**
     * Get data form curl method.
     *
     * @author Antonio Jenaro
     * @author Carlos Herrera
     *
     * @param string $url set the url to apply method
     *
     * @return object XML parsed
     *
     * @version 1.0
     */
    public function get_file_content_curl($url)
    {
        $result = self::GetCurl($url);

        return  simplexml_load_string($result);
    }

    /**
     * CURL replacement for file_get_contents.
     *
     *  @author Antonio Jenaro
     *  @author Carlos Herrera
     *  08/05/2019 - Antonio Jenaro
     *  Solucion a allow_url_fopen = 0, una medida de seguridad común que los hosting emplean para ayudar a evitar scripts PHP maliciosos
     *
     *  @param string $image_url The url to get the data image
     *
     *  @return string
     */
    public static function GetImageFromCurl($image_url)
    {
        return self::GetCurl($image_url);
    }

    /**
     * Get data by Curl.
     *
     * @author Antonio Jenaro
     * @author Carlos Herrera
     *
     * @version 1.0
     *
     * @param string $url The url for apply curl
     *
     * @return string
     */
    public static function GetCurl($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_URL, $url);
        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

    public static function BorrarMediaAntesDeBorrarInmueble($post_id, $custompt)
    {
        global $post_type;
        if ($post_type !== $custompt) {
            return;
        }

        global $wpdb;
        $datas = get_attached_media('', $post_id);
        foreach ($datas as $data) {
            wp_delete_attachment($data->ID, true);
            $query1 = "DELETE FROM {$wpdb->prefix}posts where ID = {$data->ID}";
            $query2 = "DELETE FROM {$wpdb->prefix}postmeta WHERE post_id = {$data->ID} ";
            $wpdb->query($query1);
            $wpdb->query($query2);
        }
    }
}
