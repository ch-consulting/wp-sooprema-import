<?php
    namespace CHSOOPREMA;
    /**
     * CLASE PARA MODIFICACIONES PERSONALIZADAS
     * 
     * Se puede modificar los valores del plugin en las acciones de guerdar el postType y las imágenes
     * POR FAVOR NO MODIFICAR LOS DEMAS ARCHIVOS DEL PLUGIN. SÓLO MODIFICAR ESTE ARCHIVO.
     * @author Carlos Herrera
     * 
     */     
    class CustomThemeController
    {
    
        public function __construct()
        {
    
        }
        /**
         * before_save_property
         * Modificar los valores de los Argumentos antes de guardar en el postType
         * @author  Carlos Herrera
         * @param  array  $args el listado de valores para guardar en el postType
         * @param  object $inmueble['all'] Si viene de XML. Está todos los datos XML que viene de WITEI 
         * @param  array  $inmueble['all'] Si viene de JSON. está todos los datos JSON que viene de WITEI
         * 
         */
        public function before_save_property($args,$inmueble)
        {
            if($inmueble['all']['kind'])
            {
                // Viene de JSON
            }
            else
            {
                // Viene de XML

            }            
         /*   $args["meta_input"]["_listing_id"] = $inmueble['id_inmueble'];
            $args["meta_input"]["ch_superficie"]            = $inmueble['plot'];
            $args["meta_input"]["ch_superficie_util"]       = $inmueble['size'];
            $args["meta_input"]["ch_consumo_energetico"]    = $inmueble['energy'];
            $args["meta_input"]["ch_location"]              = ['lat'=>$inmueble['latitud'],'lng'=>$inmueble['longitud']]; 
            $args["meta_input"]["ch_mostrar_direccion"]     = 'aprox';
            */
            $args = apply_filters( 'before_save_property', $args ,$inmueble); 
            return $args;    
        }

        /**
         * after_save_property
         * Acciones a realizar después de guardar el inmueble en su postType
         * @author Carlos Herrera
         * @param $id_post La id del post guardado
         * @param  object $inmueble['all'] Si viene de XML. Está todos los datos XML que viene de WITEI 
         * @param  array  $inmueble['all'] Si viene de JSON. está todos los datos JSON que viene de WITEI
         */
        public function after_save_property($id_post,$inmueble,$args)
        {
            do_action( 'sooprema_after_save_property', $id_post,$inmueble,$args );
        }
        /** 
         * before_delete_taxonomies
         * Accciones a realizar antes de borrar las taxonomías. Se puede agregar más taxonomias en un array para borrarlas
         * @author Carlos Herrera
         * @param array $taxonomias el listado de taxonomias a borrar 
        */
        public function before_delete_taxonomies($taxonomias)
        {
            array_push($taxonomias,'estado');
            $taxonomias = apply_filters( 'sooprema_before_delete_taxonomies', $taxonomias); 
            return $taxonomias;
        }
         /** 
         * after_delete_taxonomies
         * Accciones a realizar despues de borrar las taxonomías. Aqui se asignan las taxonomías para agregar al postType
         * @author Carlos Herrera
         * @param int $id_post La id del post guardado
         * @param object $inmueble['all'] Si viene de XML. Está todos los datos XML que viene de WITEI 
         * @param array  $inmueble['all'] Si viene de JSON. está todos los datos JSON que viene de WITEI
        */
        public function after_delete_taxonomies($id_post,$inmueble)
        {
            do_action( 'sooprema_after_delete_taxonomies', $id_post,$inmueble );
        }
        /**
         * before_insert_photo
         * Acciones a realizar antes de importar una foto
         * @author Carlos Herrera
         * @param string $image_url La dirección externa de la imagen
         * @param int $post_id La id del post guardado
         * @param int $number posición en el array de las fotos
         * @param boolean $feature si la imagen es destacada o no.
         */
        public function before_insert_photo($image_url,$post_id, $number,$feature)
        {
            do_action( 'sooprema_before_insert_photo', $image_url,$post_id, $number,$feature );
        }
        /**
         * after_import_photo
         * Acciones a realizar despues de importar una foto
         * @author Carlos Herrera
         * @param string $image_url La dirección externa de la imagen
         * @param int $post_id La id del post guardado
         * @param int $id La id del la imagen guardada en WordPress
         * @param int $number posición en el array de las fotos
         * @param boolean $feature si la imagen es destacada o no.
         */
        public function after_import_photo($image_url,$post_id,$id,$number,$feature)
        {
           // die('llego');
            if($feature)
            {
                set_post_thumbnail( $post_id,$id ); 
            }
            do_action( 'sooprema_after_import_photo', $image_url,$post_id,$id,$number,$feature);
            /*   $gallery= get_post_meta($post_id,'ch_fotos',ARRAY_N);
            $image= wp_get_attachment_image_src($id,'full');
            if(is_array($gallery))
            {
                $gallery[$id]=$image[0];
            }
            else {
                $gallery=[];
                $gallery[$id]=$image[0];
            }
            update_post_meta($post_id,'ch_fotos',$gallery);
            */
           
        }
    }