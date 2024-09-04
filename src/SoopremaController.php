<?php

namespace CHSOOPREMA;

use CHSOOPREMA\CustomThemeController as Theme;

class SoopremaController extends ImportPropertyController
{
    public $inmbueble_data_xml = [
        'id',
        'date',
        'ref',
        'price',
        'currency',
        'price_freq',
        'type',
        'town',
        'province',
        'country',
        'location->latitude',
        'location->longitude',
        'location_detail',
        'beds',
        'baths',
        'surface_area->built',
        'surface_area->plot',
        'energy_rating->emissions',
        'energy_rating->consumption',
        'desc->es',
        'desc->en',
        'desc->ca',
        'desc->fr',
        'desc->ru',
        'desc->nl',
        'desc->nb',
        'desc->fi',
        'desc->de',
        'desc->sv',
        'features',
        'images',
        'title',
        'video_url',
        'url',
        'district',
        'zone',
        'wi_data',
        'virtual_tour_url',
        'virtual_visits',
        'status',
    ];

    public $inmueble_data_json = [
        'id',
        'identifier', //identificador
        'created',
        'updated',
        'creator->id',
        'creator->name',
        'creator->username',
        'deposit',
        'town', // ciudad
        'province', //provincia
        'district',
        'neighborhood', //barrio
        'urbanization',
        'street', //calle
        'street_number', // numero de calle
        'door',
        'doorway',
        'public_address',
        'geo_lat', // latitud
        'geo_lng', // longitud
        'renting', // alquiler true false
        'selling', // venta true false
        'renting_cost', // precio de alquiler
        'renting_period',  // periodo de alquiler
        'renting_period_display',
        'selling_cost', // precio de venta
        'kind', //tipo de inmueble
        'floor', //piso
        'floor_display',
        'bedrooms',
        'bathrooms',
        'building_expenses',
        'block',
        'area',
        'area_util',
        'area_plot',
        'area_terrace',
        'pictures',
        'description',
        'agency->name',
        'agency->address',
        'agency->town',
        'agency->zip_code',
        'agency->phone_number_1',
        'agency->phone_number_2',
        'agency->logo',
        'agency->currency',
        'agency->currency_symbol',
        'agreement_valid_from',
        'agreement_valid_until',
        'status',
        'is_reserved', //true o false
        'key_reference',
        'keys',
        'zip_code',
        'show_cost', //true o false
        'floor_display',
        'energy_certificate_display',
        'updated',
        'kind_value',
        'land_value_tax',
        'renting_period_display',
        'tags',
        'tags_es',
        'notes',
        'virtual_visit',
        'video_url',
        'description_es',
        'description_en',
        'description_ca',
        'description_fr',
        'description_ru',
        'description_nl',
        'description_nb',
        'description_fi',
        'description_de',
        'description_sv',
        'year_built',
        'is_exclusive',
        'title',
        'published_web',
        'energy_consumption',
        'energy_emission',
        'energy_emission_certificate_display',
        'owner->phone',
        'owner->email',
        'owner->id',
        'owner->name',
        'second_owner',
        'commercial',
        'contact->phone',
        'contact->name',
        'contact->email',
        'price_reference_index',
        'status',
        'raw_status',
        'readonly_url',
        'transfer',
        'transfer_cost',
        'sooprema_object_type',
        'sooprema_event_type', //updated // created or deleted
    ];
    public $inmueble_tags = ['adosado', 'a estrenar', 'aire acondicionado', 'alarma', 'almacén', 'alto standing', 'amueblado', 'animales', 'antena TV', 'apartamento', 'a reformar', 'armarios empotrados', 'ascensor', 'aseo', 'ático', 'azotea', 'balcón', 'barbacoa', 'bodega', 'bohemio', 'bungalow', 'calefacción central', 'calefacción eléctrica', 'calefacción gasoil', 'calefacción individual', 'cámara de seguridad', 'casa baja', 'casa de pueblo', 'céntrico', 'chimenea', 'cocina americana', 'cocina amueblada', 'cocina equipada', 'condominio', 'conserje', 'detector de humos', 'diáfano', 'dormitorio de servicio', 'dúplex', 'edificable', 'edificio emblemático', 'edificio protegido', 'entrada desde calle', 'escaleras', 'esquina', 'estructura de hormigón', 'estructura de madera', 'estructura metálica', 'estudio', 'exterior', 'extintor', 'extractor de humos', 'finca rústica', 'garaje', 'gas butano', 'gas natural', 'gimnasio', 'histórico', 'hostelería', 'hotel', 'independiente', 'interior', 'internet', 'jardín', 'jardín comunitario', 'lavadero', 'lavavajillas', 'loft', 'luminoso', 'maletero', 'mansión', 'masía', 'montacargas', 'no amueblado', 'obra nueva', 'orientación este', 'orientación norte', 'orientación oeste', 'orientación sur', 'pareado', 'parking', 'patio de luces', 'patio de manzana', 'patio de uso', 'patio interior', 'pintura gotelé', 'pintura lisa', 'piscina', 'piscina comunitaria', 'pista de pádel', 'pista de squash', 'pista de tenis', 'plaza garaje incluida', 'porche', 'portero', 'puerta automática', 'puerta blindada', 'puerta de seguridad', 'reformado', 'salida de emergencia', 'salida de humos', 'sauna', 'seguro', 'singular', 'solar', 'solárium', 'soleado', 'sótano', 'suelo gres', 'suelo mármol', 'suelo parquet', 'suelo radiante', 'suelo tarima', 'suelo técnico', 'suelo terrazo', 'techo falso', 'tendedero', 'terraza', 'traspaso', 'trastero', 'trastero incluido', 'triplex', 'turístico', 'urbanizacion privada', 'vado permanente', 'ventanas aluminio', 'ventanas climalit', 'ventanas de madera', 'videoportero', 'vigilancia 24h', 'vistas al golf', 'vistas al mar', 'vistas al monte', 'wifi', 'zona industrial', 'zona infantil', 'zona verde'];
    public $post_type;
    public $referencia;
    public $autor;
    public $importar_foto;
    public $email;
    public $apiurl = 'https://apiwitei.carlos-herrera.es/api/v1/sooprema/';

    public function __construct()
    {
        //echo "estoy en el constructor<br>";
        //    $this->conta ++;
        $this->post_type = get_option('sooprema_post_type');
        $this->referencia = get_option('sooprema_referencia');
        $this->autor = get_option('sooprema_author');
        $this->importar_foto = get_option('sooprema_importar_fotos');
        $this->email = get_option('sooprema_cron_email') != '' ? get_option('sooprema_cron_email') : get_bloginfo('admin_email');
    }

    /**
     * Importacion del XML de Witei.
     *
     * {@inheritdoc} 08/05/2019 - Antonio Jenaro
     * wrapper that helps you loading an XML file. It uses simplexml_load_file if allow_url_fopen is enabled.
     * If this feature is disabled it employs simplexml_load_string and cURL.
     * If none of this works we’ll throw an exception because we weren’t able to load the data
     *
     * @version 2.0
     *
     * @author Antonio Jenaro
     *
     * @return object XML
     */
    public function GetXML()
    {
        $url = get_option('sooprema_xml_url');
        if ($url != '') {
            if (ini_get('allow_url_fopen') == true) {
                $xml = simplexml_load_file($url);
            } elseif (function_exists('curl_init')) {
                $xml = parent::get_file_content_curl($url);
            } else {
                // Enable 'allow_url_fopen' or install cURL.
                throw new Exception("Can't load data... Enable allow_url_fopen or install cURL");
            }

            return $xml;
        } else {
            return false;
        }
    }

    /**
     * Importar mediante API
     * {@inheritdoc} 08/01/2019 - Carlos Herrera
     * Genera la solicitud de los inmuebles mediante api para
     * ejecutar la importación.
     *
     * @version 1.0
     *
     * @author Carlos Herrera
     *
     * @return array JSON
     */
    public function GetAPI()
    {
        $origin = 'sooprema';
        $apikey = get_option('sooprema_key_api');
        $ch = curl_init();
        $url = $this->apiurl.'properties/';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        //print_r(json_decode($response)->results[0]);
        //  die();
    }
    /**
     * WebHook.
     *
     * Método para actualizar los datos de sooprema a través del webhook de sooprema
     */
    public static function ImportWebhook()
    {
        if (!function_exists('wp_get_current_user')) {
            include ABSPATH.'wp-includes/pluggable.php';
        }
        $sooprema = new \CHSOOPREMA\SoopremaController();
        $importar_foto = get_option('sooprema_importar_fotos');
        $json = file_get_contents('php://input');
        $action = json_decode($json, true);
        $queue = get_option('sooprema_task_queue', []);
        global $wpdb;
        $table_name = $wpdb->prefix . 'options';
        if($queue===false) {
            return;
        }if(!empty($queue) && $queue != "") {
            $queue = $wpdb->get_var("SELECT option_value FROM {$table_name} WHERE option_name = 'sooprema_task_queue'");
        } else {
            add_option('sooprema_task_queue', $queue);
        }
        
        if ($action['id'] != '') {
            $new_data = json_encode(array($action['id'] => $action));
            if ($queue) {
                $data = $queue . "," . $new_data;
            } else {
                $data = $new_data;
            }

            $sql = $wpdb->prepare(
                "UPDATE {$table_name} SET option_value = %s WHERE option_name = %s",
                $data,
                'sooprema_task_queue'
            );
            $wpdb->query($sql);
            
            $data = ['status'=>'ok', 'add queue' => 'true'];
            header('Status: 200');
            wp_send_json($data);
        } else {
            die('error: no sooprema data in post or is a inactive property');
        }
    }

    public static function iniciador()
    {
        get_option('sooprema_task_queue');
    }

    public function processQueue()
    {
        $sooprema = new \CHSOOPREMA\SoopremaController();
        
        //error_log("Funciona al minuto");
        //$importar_foto = get_option('sooprema_importar_fotos');
        global $wpdb;
        $option_name = 'sooprema_task_queue';
        $table_name = $wpdb->prefix . "options";
        $sql = $wpdb->prepare(
            "SELECT option_value FROM $table_name WHERE option_name = %s",
            $option_name
        );
        $queue = $wpdb->get_var($sql);
        
        if ($queue) {
            $data = json_decode("[$queue]", true);
            if ($data === null) {
                //error_log('Error parsing JSON data: ' . json_last_error_msg());
                return;
            }

            if (empty($data)) {
                return;
            }

            $action = null;
            foreach ($data as $item) {
                $key = array_key_first($item);
                if ($key !== null) {
                    $action = $item[$key];
                    unset($data[0]);
                    break;
                }
            }
           
            $data_string = '';
            foreach ($data as $item) {
                $data_string .= json_encode($item) . ',';
            }

            $json_data = rtrim($data_string, ',');

            $sql = $wpdb->prepare(
                "UPDATE {$table_name} SET option_value = %s WHERE option_name = %s",
                $json_data,
                'sooprema_task_queue'
            );
            $wpdb->query($sql);

            $the_data = json_decode($sooprema->importar_json($action));
            //   die(print_r($the_data->foto));
            
            if (isset($the_data->foto) && count($the_data->foto) > 0) {
                $p = 0;
                foreach ($the_data->foto as $key => $foto) {
                    $sooprema->parentInsertar_foto($foto, $the_data->id, $p);
                    ++$p;
                }
            }
            
        } else {
            return;
        }
        return;
    }

    /**
     * Buscar data a importar por ID de Witei
     * Encuentra en que posicion se encucentra la id buscada en el xml de idealista.
     * Sirve para la importación.
     *
     * @author Carlos Herrera
     *
     * @return string en forma e json
     */
    public static function FindByID($id_sooprema = false)
    {
        if (\session_status() == PHP_SESSION_NONE) {
            ini_set('session.use_strict_mode', 1);
            \session_start();
        }
        $sooprema = new SoopremaController();
        $find = [];
        $id = $_REQUEST['id_idealista'] != '' ? $_REQUEST['id_idealista'] : $id_sooprema;
        $inmuebles = $sooprema->obtenerInmueblesAPI();
        foreach ($inmuebles as $data) {
            $find[] = $data->id;
        }
        $position = array_search($id, $find);
        if ($position !== false) {
            if ($id_sooprema) {
                return $position;
            } else {
                wp_send_json(['status' => 'ok', 'position' => $position + 1]);
            }
        }
        if ($id_sooprema) {
            return false;
        } else {
            wp_send_json(['status' => 'ko']);
        }
    }

    public static function importar_api($i = false)
    {
        if (\session_status() == PHP_SESSION_NONE) {
            ini_set('session.use_strict_mode', 1);
            \session_start();
        }
        
        $pos = $_REQUEST['id'] ? $_REQUEST['id'] : $i;
        if ($pos) {
            $sooprema = new SoopremaController();
            if(!isset($_SESSION['sooprema_properties'])) {
                $sooprema->obtenerInmueblesAPI();
            }
            $inmuebles = $_SESSION['sooprema_properties'];
            wp_send_json(json_decode($sooprema->importar_json((array) $inmuebles[$pos - 1])));
        }
    }

    public function importar_xml($i = false)
    {
        //die(print_r($_REQUEST));
        $pos = $_REQUEST['id'] ? $_REQUEST['id'] : $i;
        if ($pos) {
            $sooprema = new \CHSOOPREMA\SoopremaController();
            $inmuebles = $sooprema->GetXML();
            $inmueble = $inmuebles->property[$pos - 1];
            $venta = get_option('status_venta', 'VENTA');
            $alquiler = get_option('status_alquiler', 'ALQUILER');
            // Taxonomies
            $taxonomies = json_decode(get_option('taxonomies_xml_static_values'), true); // relación de taxonomías desde el plugin
            //die(print_r($inmueble));
            unset($inmuebles);
            $data = [];
            $data['c_meta_values'] = json_decode(get_option('import_xml'), true);
            $data['tags'] = isset($inmueble->features) ? (get_object_vars($inmueble->features)['feature'] ? get_object_vars($inmueble->features)['feature'] : '') : '';
            $data['id_inmueble'] = (string) $inmueble->id; //['ref'];
            $data['ref'] = (string) $inmueble->ref;
            $data['tipo'] = (string) $inmueble->type;
            $data['tipo'] = $sooprema->CurarTexto($data['tipo']);
            $data['precio'] = (string) $inmueble->price;
            $data['description'] = (string) $inmueble->desc->es;
            $data['description_en'] = (string) $inmueble->desc->en;
            $data['description_ca'] = (string) $inmueble->desc->ca;
            $data['description_fr'] = (string) $inmueble->desc->fr;
            $data['description_ru'] = (string) $inmueble->desc->ru;
            $data['updated'] = (string) $inmueble->date;
            $data['fotos'] = get_object_vars($inmueble->images)['image'];
            $data['provincia'] = (string) $inmueble->province;
            $data['ciudad'] = (string) $inmueble->town;
            $data['zona'] = (string) $inmueble->zone;
            $data['distrito'] = (string) $inmueble->district;
            $data['estado'] = (string) $inmueble->price_freq == 'sale' ? $venta : $alquiler;
            $data['latitud'] = (string) $inmueble->location->latitude;
            $data['longitud'] = (string) $inmueble->location->longitude;
            $data['video'] = isset($inmueble->video_url) ? (string) $inmueble->video_url : '';
            $data['size'] = isset($inmueble->surface_area->built) ? (string) $inmueble->surface_area->built : '';
            $data['plot'] = isset($inmueble->surface_area->plot) ? (string) $inmueble->surface_area->plot : '';
            $data['energy'] = isset($inmueble->energy_rating->consumption) ? (string) $inmueble->energy_rating->consumption : 'X';
            $data['title'] = isset($inmueble->title) ? (string) $inmueble->title.' REF:'.$inmueble->ref : (string) (ucwords($inmueble->type).' '.__('en').' '.$inmueble->town.'de '.$data['size'].' m2 REF:'.$data['ref']);
            $data['habitaciones'] = (string) $inmueble->beds;
            $data['banos'] = (string) $inmueble->baths;
            $data['all'] = $inmueble;

            $data['taxonomies'];
            foreach ($taxonomies as $key => $value) {
                if (!empty($value) && $value != 'status') {
                    $data['taxonomies'][$key] = $value == 'features' ? (array) $inmueble->$value->feature : $sooprema->CurarTexto((string) $inmueble->$value);
                } else {
                    if ($value == 'status') {
                        $data['taxonomies'][$key] = $data['estado'];
                    }
                }
            }
            //die(print_r($data['taxonomies']));
            $output = $sooprema->ImportarSooprema($data);
        }

        if (!$i) {
            wp_send_json($output);
        } else {
            return json_encode($output);
        }
    }

    public function importar_json($inmueble)
    {
       
        $sooprema = new SoopremaController();
        $venta = get_option('status_venta', 'VENTA');
        $alquiler = get_option('status_alquiler', 'ALQUILER');
        // Taxonomies
        $taxonomies = json_decode(get_option('taxonomies_json_static_values'), true); // relación de taxonomías desde el plugin

        $data = [];
        $json_data = get_option('import_json');
        $data['c_meta_values'] = !is_array($json_data) ? json_decode($json_data) : '{}';
        $data['tags'] = $sooprema->processTags(json_decode($inmueble['features']));
        $data['id_inmueble'] = $inmueble['id'];
        $data['ref'] = $inmueble['salesReference'];
        $data['tipo'] = $inmueble['typeName'];
        $data['description'] = $inmueble['salesDescription'];
        $data['description_es'] = $inmueble['salesContentEs'];
        $data['description_en'] = $inmueble['salesContentEn'];
        $data['description_de'] = $inmueble['salesContentDe'];
        $data['description_nl'] = $inmueble['salesContentNl'];
        $data['description_pt'] = $inmueble['salesContentPt'];
        $data['description_pl'] = $inmueble['salesContentPl'];
        $data['description_ca'] = $inmueble['salesContentCa'];
        $data['description_fr'] = $inmueble['salesContentFr'];
        $data['description_ru'] = $inmueble['salesContentRu'];
        $data['description_it'] = $inmueble['salesContentIt'];
        $data['description_no'] = $inmueble['salesContentNo'];
        $data['description_sv'] = $inmueble['salesContentSv'];
        $data['updated'] = $inmueble['modified'];
        $data['fotos'] = $sooprema->processPhotos($inmueble['images']);
        $data['precio'] = $inmueble['rentalsPrice'] == '' ? $inmueble['salesPrice'] : $inmueble['rentalsPrice'];
        $data['provincia'] = $inmueble['provinceName'];
        $data['ciudad'] = $inmueble['cityName'];
        $data['zona'] = $inmueble['areaName'];
        $data['distrito'] = ''; //none :(
        $data['estado'] = $inmueble['rentalsPrice'] =='' ? $venta : $alquiler;
        $data['latitud'] = $sooprema->processLating($inmueble['latlng'],'lat');
        $data['longitud'] = $sooprema->processLating($inmueble['latlng'],'lng');
        $data['build'] = $inmueble['buildYear'];
       
        $data['size'] = $inmueble['buildSize'] != '' ? $inmueble['buildSize'] : $inmueble['usefulSize'];
        $data['plot'] = $inmueble['plotSize'];
        $data['area'] = $inmueble['usefulSize'];
        $data['planta'] = $inmueble['floorNumber'];
        $data['energy'] = $inmueble['energyCertificate'];
        $data['habitaciones'] = $inmueble['bedrooms'];
        $data['banos'] = $inmueble['bathrooms'];
        $data['title'] = $inmueble['salesTitleEs'] != '' ? $inmueble['salesTitleEs'].' REF:'.$data['ref'] : ucwords($data['tipo']).' '.__('en', 'ch_nella_afilia').' '.strtolower($data['estado']).' '.__('en', 'ch_nella_afilia').' '.$data['ciudad'].' '.__('de', 'ch_nella_afilia').' '.$data['size'].'m2 REF:'.$data['ref'];
       
        $data['taxonomies'] = [];
        if (is_array($taxonomies)) {
            foreach ($taxonomies as $key => $value) {
                if (!empty($value) && $value != 'status') {
                    $data['taxonomies'][$key] = $inmueble[$value];
                } else {
                    if ($value == 'status') {
                        $data['taxonomies'][$key] = $data['estado'];
                    }
                }
            }
        }

        $data['all'] = $inmueble;
        $output = $sooprema->ImportarSooprema($data);
        /*
        die(print_r([$data]));
        $importar_xml = get_option('sooprema_webhook_xml');
        $array_access_status=json_decode(get_option('sooprema_status_import', json_encode(['available'])));
        $sooprema_event_type = $data['all']['raw_status'];
        if ($data['id_inmueble'] != '' && in_array($sooprema_event_type, $array_access_status)) {
            if ($importar_xml == '1' && ($inmueble['published_web'] == true || $sooprema->foundInXML($inmueble['id']) == 1)) {
                //die('llego a xml');
                $output = $sooprema->ImportarSooprema($data);
            } else {
                if ($importar_xml == 0 || $importar_xml == '') {
                    //    die('llego normal');
                    $output = $sooprema->ImportarSooprema($data);
                } else {
                    //   die('llego a no guardar porque no esta en xml');
                    $output = ['result' => 'ko', 'details' => 'Activated Import only from XML: Este inmueble no se encuentra en el XML'];
                    //    return json_encode($output);
                    // wp_send_json($output);
                }
            }
            // die('llego a pasar todas las condicionantes');
            // $output = $sooprema->ImportarSooprema($data);
            if (get_option('sooprema_notificar_email') == '1') {
                $to = $sooprema->email;
                $asunto = 'Importación de inmueble '.$data['title'];
                $cuerpo = '<p>Se ha actualizado el inmueble:</p><p>'.$data['title'].'</p><p>Hora de actualización: '.$data['updated'].'</p>';
                $headers = ['Content-Type: text/html; charset=UTF-8'];
                wp_mail($to, $asunto, $cuerpo, $headers);
            }

            // return json_encode($output);
        } elseif ($data['all']['sooprema_event_type'] == 'deleted' || $sooprema_event_type == 'delete') {
            //die('llego a borrar por status deleted');
            $sooprema->borrar_inmueble($inmueble);
            $output = ['result' => 'ok', 'details' => 'Propertie deleted'];
        } else {
            // die('llego a borrar por otro status:'.$sooprema_event_type);
            $message = !in_array($sooprema_event_type, $array_access_status) ? "Raw status: {$sooprema_event_type}" : 'no Witei data in Request';
            $sooprema->borrar_inmueble($inmueble);
            $output = ['result' => 'ko', 'details' => $message];
        }
            */
        return json_encode($output);
        //wp_send_json($output);
    }

    private function processTags($tags):array{
        $result=[];
        foreach ($tags as $key => $value) {
            if($value==1){
                $result[]=$key;
            }
        }
        return $result;
    }

    private function processPhotos($photos):array{
        $result=[];
        foreach ($photos as $value) {
            $result[]=$value->source->url;
        }
        return $result;

    }
    private function processLating($lating,$order):string{
        $lating=explode(',',$lating);
        return $order=='lat'?$lating[0]:$lating[1];
    }
    

    public function ImportarSooprema($inmueble)
    {
        if ($inmueble['id_inmueble'] != '') {
            $sooprema = new \CHSOOPREMA\SoopremaController();
            $theme = new Theme();
            $ref = 'sooprema_id'; //get_option('sooprema_referencia','sooprema_id');
            $post = get_option('sooprema_post_type');
            //  $replace_image = get_option('sooprema_reemplazar_fotos', 0);
            $meta_values = [];
            if (is_array($inmueble['c_meta_values'])) {
                foreach ($inmueble['c_meta_values'] as $key => $meta) {
                    $output = explode('->', $meta);
                    if (isset($inmueble['all']->{$output[0]})) {
                        if ($output[1]) {
                            $meta_values[$key] = (string) $inmueble['all']->{$output[0]}->{$output[1]};
                        } else {
                            $meta_values[$key] = (string) $inmueble['all']->{$output[0]};
                        }
                    } else {
                        if ($output[1]) {
                            $meta_values[$key] = (string) $inmueble['all'][$output[0]][$output[1]];
                        } else {
                            $meta_values[$key] = (string) $inmueble['all'][$output[0]];
                        }
                    }
                }
            }

            $meta_values[$ref] = $inmueble['id_inmueble'];
            $external_web_url = isset($inmueble['all']['external_web_url'])?$inmueble['all']['external_web_url']:'';
            $sooprema_event_type = isset($inmueble['all']['sooprema_event_type'])?$inmueble['all']['sooprema_event_type']:'';
            $static_data = json_decode(get_option('static_values'), true);
            if (is_array($static_data)) {
                foreach ($static_data as $key => $value) {
                    if (!empty($value)) {
                        $meta_values[$key] = $value;
                    }
                }
            }

            $taxonomies = $inmueble['taxonomies'];

            $args = [
                'post_type' => $sooprema->post_type,
                'post_author' => $sooprema->autor,
                'post_status' => 'publish',
                'post_title' => $inmueble['title'],
                'post_modified' => $inmueble['updated'],
                'post_content' => $inmueble['description'],
                'meta_input' => $meta_values,
            ];

            $args = $theme->before_save_property($args, $inmueble);
            if(isset($args['status'])){
                return json_encode($args);
            }
            $id_post = parent::importar($args, $post, $ref, $inmueble['id_inmueble'], $taxonomies, []);
            if (isset($id_post['status']) && $id_post['status'] = 'ko') {
                return json_encode($id_post);
            }
           
            $sooprema->exportUrl($id_post,$inmueble['all']['readonly_url']);
            $theme->after_save_property($id_post, $inmueble, $args);


            $taxonomias = [];
            $taxonomias = $theme->before_delete_taxonomies($taxonomias);
            parent::borrar_taxonomias($id_post, $taxonomias);
            $theme->after_delete_taxonomies($id_post, $inmueble);
            $fotos_array = [];
            $fotos = $inmueble['fotos'];

            if (is_array($fotos)) {
                foreach ($fotos as $foto) {
                    $photo = isset($foto->url) ? (string) $foto->url : (string) $foto;
                    array_push($fotos_array, $photo);
                }
            }

            $output = ['result' => 'ok', 'id' => $id_post, 'foto' => $fotos_array, 'title' => $args['post_title'].' REF:'.$inmueble['id_inmueble']];
        } else {
            $output = ['result' => 'ko', 'message' => 'no sooprema id found'];
        }

        return $output;
    }

    public static function ProgramarImportacion()
    {
        //ini_set("allow_url_fopen", 1);
        //ini_set('max_execution_time', 0);
        //ini_set('display_errors', 1);
        //ini_set('display_startup_errors', 1);
        //error_reporting(E_ALL);
        require_once $_SERVER['DOCUMENT_ROOT'].'/wp-load.php';
        require_once $_SERVER['DOCUMENT_ROOT'].'/wp-includes/pluggable.php';
        $activar = get_option('sooprema_activar_cron');

        if ($activar == 1) {
            if (get_option('sooprema_notificar_email') == '1') {
                $email = get_option('sooprema_cron_email') != '' ? get_option('sooprema_cron_email') : get_bloginfo('admin_email');
                $to = $email;
                $subject_ini = 'Iniciando importacion';
                $subject_fin = 'Finalizado importacion';
                $body_ini = 'Se ha iniciado la importacion el  '.date('Y-m-d H:i:s');
                $body_fin = 'Se ha terminado la importacion el  '.date('Y-m-d H:i:s');
                $headers = ['Content-Type: text/html; charset=UTF-8'];
                wp_mail($to, $subject_ini, $body_ini, $headers);
            }
            $sooprema = new SoopremaController();
            $inmuebles = $sooprema->obtenerInmueblesAPI();
            $count = count($inmuebles);
            //unset($api);
            foreach ($inmuebles as $inmueble) {
                $importar_foto = get_option('sooprema_importar_fotos');
                $data = $sooprema->importar_json((array) $inmueble);
                if (isset($data['foto ']) && count($data['foto']) > 0 && $importar_foto == 1) {
                    $p = 0;
                    foreach ($data['foto'] as $key => $foto) {
                        $sooprema->parentInsertar_foto($foto, $data['id'], $p);
                        ++$p;
                    }
                }
            }

            if(get_option('sooprema_activar_borrado_masivo') == '1') {
                SoopremaController::parentDeleteProperties();
            }
            if (get_option('chideal_notificar_email') == '1') {
                wp_mail($to, $subject_fin, $body_fin, $headers);
            }
            wp_mail($to, $subject_fin, $body_fin, $headers);
        }
    }

    /**
     * Get Fields.
     *
     * Obtenemos los datos que viene las xml o json de sooprema
     *
     * @version 1.0
     *
     * @author Carlos Herrera (https://carlos-herrera.com)
     *
     * @param string $output   Tipo de salida del dato (de momento solo es select)
     * @param bool   $selected Si el valor esta seleccionado
     * @param array  $source   los datos que viene de forma externa
     *
     * @return string html
     */
    public function get_fields($output = false, $selected = false, $source = 'xml')
    {
        $sooprema = new SoopremaController();
        $fields = $source == 'xml' ? $sooprema->inmbueble_data_xml : $sooprema->inmueble_data_json;
        if ($output == 'select') {
            $data = '<select name="inmo_fields_'.$source.'">';
            $data .= '<option value=""> --- seleciona ---</option>';
            foreach ($fields as $field) {
                $check = $selected == $field ? ' selected="selected" ' : '';
                $data .= '<option value="'.$field.'" '.$check.'>'.$field.'</option>';
            }
            $data .= '<option value="">otro</option>';
            $data .= '</select>';

            return $data;
        }

        return $fields;
    }

    /**
     * Tag Fields.
     *
     * Muestra el listado de caracteristicas del inmueble desde la fuente externa
     *
     * @version 1.0
     *
     * @author Carlos Herrera (https://carlos-herrera.com)
     *
     * @param string $output
     *
     * @return string html
     */
    public function tags_fields($output = false)
    {
        $sooprema = new CHSOOPREMA\SoopremaController();
        $fields = $sooprema->imbueble_data;
        $data = '';
        if ($output == 'checkbox') {
            foreach ($fields as $field) {
                $value = json_decode(get_option('inmo_tags'))->$field;
                $check = $value == 'si' ? 'checked' : '';
                $data .= $field.'<input type="checkbox" name="inmo_tags['.$field.']" value="si" '.$check.' >';
            }
        }

        return $data;
    }

    public function get_select_refer_data($terms, $data_import)
    {
        $sooprema = new SoopremaController();
        $select_set_id = '<select name="sooprema_referencia">';
        foreach ($terms as $term) {
            $select_set_id_selected = get_option('sooprema_referencia') == $term['meta_key'] ? ' selected="selected" ' : '';
            $select_set_id .= '<option   value="'.$term['meta_key'].'" $select_set_id_selected '.$select_set_id_selected.' >'.$term['meta_key'].'</option>';
        }

        $select_set_id .= '</select>';

        return $select_set_id;
    }

    /**
     * Insertar Foto
     * Prepara todo para ejecutar función padre.
     */
    public static function parentInsertar_foto($url = false, $post = false, $pos = false)
    {
        $theme = new Theme();
        $data = $_REQUEST;
        $image_url = isset($data['file']) ? $data['file'] : $url;
        $number = isset($data['position']) ? $data['position'] : $pos;
        $post_id = isset($data['id']) ? $data['id'] : $post;
        $feature = $number == 0 ? true : false;
        $before = $theme->before_insert_photo($image_url, $post_id, $number, $feature);
        if (isset($before['result'])&&$before['result']=='ko') {
            if (!$url) {
                return wp_send_json($before);
            } else {
                return json_encode($before);
            }
        }
        $id = parent::insertar_foto($image_url, $post_id, $number, $feature);
        $after = $theme->after_import_photo($image_url, $post_id, $id, $number, $feature);

        if (!$url) {
            wp_send_json(['result' => 'ok', 'id' => $id, 'feature' => $feature]);
        } else {
            return json_encode(['result' => 'ok', 'id' => $id, 'feature' => $feature]);
        }
    }

    /**
     * Borrar Duplicados
     * Prepara todo para ejecutar función padre.
     */
    public static function parentDeleteProperties()
    {
        $sooprema = new SoopremaController();
        $array_xml = [];
        $importar_xml = get_option('sooprema_webhook_xml');
        $inmuebles = $importar_xml == 1 ? $sooprema->GetXML()->property : $sooprema->obtenerInmueblesAPI();
        $count = count($inmuebles);
        $post_type = get_option('sooprema_post_type');
        $referencia = 'sooprema_id'; // get_option('sooprema_referencia');
        if ($count > 2) { //control para no borrar todos
            foreach ($inmuebles as $inmueble) {
                array_push($array_xml, (int) $inmueble->id);
            }
        }
        //wp_send_json([$array_xml]);
        if (count($array_xml) > 0) {
            $resultado = parent::DeleteProperties($array_xml, $referencia, $post_type);
            $valores = ['result' => 'ok', 'count' => $resultado['count'], 'values' => $resultado['values']];
        } else {
            $valores = ['result' => 'ok', 'count' => 0, 'message' => 'ningun inmueble borrado'];
        }
        wp_send_json($valores);
    }

    /***
     * Enviar Email desde el formulario de FeedBack
     */
    public function sendFeedBackEmail()
    {
        $user = wp_get_current_user();
        $error = $_POST['error'] != '' ? sanitize_text_field($_POST['error']) : '';
        $to = 'cehojac@gmail.com';
        $subject = 'Mensaje enviado desde el plugin de Witei: ('.get_bloginfo().')';

        $message = 'Usuario: '.$user->user_login."\n";
        $message .= 'Versión Wordpress: '.get_bloginfo('version')."\n";
        $message .= 'Tipo de consulta: '.sanitize_text_field($_POST['sugerencia'])."\n";
        $message .= $error != '' ? 'Error: '.$error : '';
        $message .= "\n".sanitize_textarea_field($_POST['msg']);

        $result = wp_mail($to, $subject, $message);

        if ($result) {
            wp_send_json(['result' => true]);
        } else {
            wp_send_json(['result' => false]);
        }
    }

    /***
     * Agregar un valor en el xml/json para la importación masiva
     */
    public function addWiteiDataImport()
    {
        global $wpdb;
        $table_name = $wpdb->prefix.'options';

        $tipo = $_POST['tipo'];
        $value = $_POST['valor'];

        $query = "SELECT max(option_id) FROM {$table_name}";
        $optionId = (int) ($wpdb->get_var($query) + 1);
        $result = add_option($tipo.$optionId, $value, '', 'yes');

        if ($result) {
            wp_send_json(['result' => true]);
        } else {
            wp_send_json(['result' => false]);
        }
    }

    /**
     * borrar_inmueble
     * Borra un inmueble proveniente de Webhook si está inactivo.
     *
     * @param array $data Info del inmueble
     *
     * @return void
     */
    public function borrar_inmueble($data)
    {
        global $wpdb;
        $post_type = get_option('sooprema_post_type');
        $referencia = 'sooprema_id';
        $post_id = $wpdb->get_var("select post_id from $wpdb->postmeta where meta_key ='$referencia' AND  meta_value = '{$data['id']}'");
        if ($post_id != '') {
            $this->borrarImagenes($post_id);
            return wp_delete_post($post_id);
        } else {
            return '0';
        }
    }

    public static function WiteiBorrarMediaAntesDeBorrarInmueble($post_id)
    {
        $post_type = get_option('sooprema_post_type');
        parent::BorrarMediaAntesDeBorrarInmueble($post_id, $post_type);
    }

    public static function Shortcode()
    {
    }

    public static function ImportarConfiguracion()
    {
        $import_json = get_option('import_json');
        $import_xml = get_option('import_xml');
        $static_values = get_option('static_values');
        $taxonomies_json_static_values = get_option('taxonomies_json_static_values');
        $taxonomies_xml_static_values = get_option('taxonomies_xml_static_values');
        add_option('import_json_undo', $import_json);
        add_option('import_xml_undo', $import_xml);
        add_option('static_values_undo', $static_values);
        add_option('taxonomies_json_static_values_undo', $taxonomies_json_static_values);
        add_option('taxonomies_xml_static_values_undo', $taxonomies_xml_static_values);
        $tipo = $_REQUEST['type'] == 'theme' ? 'tema' : $_REQUEST['type'];
        $nombre = $_REQUEST['name'];
        $url = get_option('sooprema_api_url')."/compatible/import/$tipo/$nombre";
        $data = parent::GetCurl($url);
        $result = json_decode($data);
        update_option('import_json', $result->import_json);
        update_option('import_xml', $result->import_xml);
        update_option('static_values', $result->static_values);
        update_option('taxonomies_json_static_values', $result->taxonomies_json_static_values);
        update_option('taxonomies_xml_static_values', $result->taxonomies_xml_static_values);
        add_option('import_config', ['tipo' => $tipo, 'nombre' => $nombre]);
        wp_send_json($result);
    }

    public static function DeshacerConfiguracion()
    {
        $import_json = get_option('import_json_undo');
        $import_xml = get_option('import_xml_undo');
        $static_values = get_option('static_values_undo');
        $taxonomies_json_static_values = get_option('taxonomies_json_static_values_undo');
        $taxonomies_xml_static_values = get_option('taxonomies_xml_static_values_undo');
        update_option('import_json', $import_json);
        update_option('import_xml', $import_xml);
        update_option('static_values', $static_values);
        update_option('taxonomies_json_static_values', $taxonomies_json_static_values);
        update_option('taxonomies_xml_static_values', $taxonomies_xml_static_values);
        delete_option('import_config');
        wp_send_json(['ok']);
    }

    /**
     * ExportarWitei function
     * cuando se guarda el post envia a sooprema el permalink al inmueble
     * @return void
     * @author cehojac <cehojac@gmail.com>
     *
     */
    //public static function ExportarWitei($post_id, $post, $update)
    public function exportUrl($post_id,$readonly_url)
    {
        $verificacion = \get_post_meta($post_id, 'sooprema_verificacion', true);
        $permalink = \get_permalink($post_id);
        $permalink = \apply_filters( 'sooprema_set_permalink', $permalink ,$post_id);
        //comprobamos si existe esta meta y si no existe se crea con valor cero
        if (!isset($verificacion)|| $verificacion == null || $verificacion !=1) {
            \add_post_meta($post_id, 'sooprema_verificacion', 0, true);
            $verificacion = 0;
        }
        if($permalink != $readonly_url){
            $verificacion = 0;
        }
        //verificamos ahora si
        if ($verificacion==0 || $verificacion =='') {
            $sooprema_id = \get_post_meta($post_id, 'sooprema_id', true);
            $api_key = \get_option('sooprema_token');
           
            $apissooprema=[];
            if (has_filter('sooprema_apis')) {
                $apissooprema = apply_filters('sooprema_apis', $apissooprema);
                //error_log(json_encode($apissooprema));
            } else {
                $apissooprema = [$api_key];
            }
            foreach($apissooprema as $key) {
                $update = $this->updateUrl($sooprema_id, $key, $permalink);
                if($update) {
                    \update_post_meta($post_id, 'sooprema_verificacion', 1, $verificacion);
                    break;
                }
              
            }
           
        }
    }

    public function updateUrl($sooprema_id, $api_key, $permalink)
    {
        $data = [
            'external_web_url' => $permalink,
            'readonly_url' => $permalink,
        ];
        
        $update = '/api/v1/houses/'.$sooprema_id.'/';
        $url = 'https://sooprema.com'.$update;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        "Authorization: Bearer $api_key",
        ]);
        $response = curl_exec($ch);
        $info = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $info==200?true:false;

    }
    /**
     * comprobarIgualdad function
     * @deprecated version 5
     */
    public function comprobarIgualdad($post_id, $sooprema_id)
    {
        $position = self::FindByID($sooprema_id);
        $propiedades = $this->obtenerInmueblesAPI();
        $permalink = \get_permalink($post_id);
        if ($position && isset($propiedades[$position]->readonly_url)) {
            return $propiedades[$position]->readonly_url == $permalink ? true : false;
        } else {
            return true;
        }
    }

    public function CurarTexto($tipo)
    {
        switch (strtolower($tipo)) {
            case 'flat':
                $tipo = 'Piso';
                break;
            case 'villa':
                $tipo = 'Casa Chalet';
                break;
            case 'chalet':
                $tipo = 'Casa Chalet';
                break;
            case 'country house':
                $tipo = 'Casa Rústica';
                break;
            case 'room':
                $tipo = 'Estancia';
                break;
            case 'parking':
                //$tipo   = 'Plaza de Parking';
                $tipo = 'Garaje';
                break;
            case 'shop':
                $tipo = 'Local';
                break;
            case 'industrial':
                $tipo = 'Nave industrial';
                break;
            case 'office':
                $tipo = 'Oficina';
                break;
            case 'land':
                $tipo = 'Terreno';
                break;
            case 'storage':
                $tipo = 'Trastero';
                break;
            case 'building':
                $tipo = 'Edificio';
                break;
            case 'penthouse':
                $tipo = 'Ático';
                break;
        }

        return $tipo;
    }

    public static function parentAfterSavePost($post_id, $post, $update)
    {
        if (get_post_meta($post_id, 'sooprema_id', true) == '' && get_post_type($post_id) == get_option('sooprema_post_type')) {
            update_post_meta($post_id, 'sooprema_id', 0);
        }
    }

    /**
     * obtenerInmueblesAPI function
     * Obtiene los datos de la API y los guarda en una variable de session.
     *
     * @return void
     */
    protected function obtenerInmueblesAPI()
    {
        if (session_status() == PHP_SESSION_NONE) {
            ini_set('session.use_strict_mode', 1);
            session_start();
        }
      //  unset($_SESSION['sooprema_properties']);
      
        if (isset($_SESSION['sooprema_properties']) && !isset($_REQUEST['refresh'])) {
            return $_SESSION['sooprema_properties'];
        } else {
         
            unset($_SESSION['sooprema_properties']);
            $apissooprema = [
                [
                    "public_key" => get_option('sooprema_public_key'),
                    "secret_key" => get_option('sooprema_private_key'),
                    "agency" => get_option('sooprema_agency_name')
                ]];
            if (has_filter('sooprema_apis')) {
                    $apissooprema = apply_filters('sooprema_apis', $apissooprema);
            }
            $response=[];
            $array_status=json_decode(get_option('sooprema_status_import', json_encode(['available'])));
            $text_status = implode(',', $array_status);
            foreach($apissooprema as $apisooprema) {
                $apich = get_option('ch_token');
                $url = $this->apiurl."properties?api_key=$apich&public_key={$apisooprema['public_key']}&secret_key={$apisooprema['secret_key']}&agency={$apisooprema['agency']}&status=$text_status&count=false";

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, false);
                $result = curl_exec($ch);
                curl_close($ch);
            }
          //  die(print_r(json_decode($result)[0]));
            $_SESSION['sooprema_properties'] = json_decode($result);
            return (json_decode($result));
        }
    }

    /**
     * getNumberProperties function
     * Devuelve el numero de inmuebles a importar de la API.
     *
     * @version 1.0
     *
     * @return
     */
    protected function getNumberProperties()
    {
        $apissooprema = [
            [
                "public_key" => get_option('sooprema_public_key'),
                "secret_key" => get_option('sooprema_private_key'),
                "agency" => get_option('sooprema_agency_name')
            ]];
        if (has_filter('sooprema_apis')) {
                $apissooprema = apply_filters('sooprema_apis', $apissooprema);
        }
        $response=[];
        $array_status=json_decode(get_option('sooprema_status_import', json_encode(['available'])));
        $text_status = implode(',', $array_status);
        foreach($apissooprema as $apisooprema) {
            $apich = get_option('ch_token');
            $url = $this->apiurl."properties?api_key=$apich&public_key={$apisooprema['public_key']}&secret_key={$apisooprema['secret_key']}&agency={$apisooprema['agency']}&status=$text_status&count=true";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            $result = json_decode(curl_exec($ch));
            array_splice($response, 0, 0, $result);
            curl_close($ch);
        }

        return $response;
    }

    /**
     * contarInmuebles
     * Devuelve el numero de inmuebles a importar.
     *
     * @version 1.0
     *
     * @return array json response
     */
    public static function contarInmuebles()
    {
        session_start();
        $sooprema = new SoopremaController();
        $count = $sooprema->getNumberProperties();
        wp_send_json(['count' => array_sum($count)]);
    }

    /**
     * foundInXML
     * Detecta si el inmueble que se consulta está en el XML.
     *
     * @version 1.0
     *
     * @return bool
     */
    public function foundInXML($id)
    {
        $inmuebles = $this->GetXML();
        $find = [];
        foreach ($inmuebles->property as $data) {
            $find[] = $data->id;
        }
        $position = array_search($id, $find);

        return false !== $position ? 1 : 0;
    }

    public function borrarImagenes($post_id)
    {
        global $wpdb;
        $datas = $media = get_attached_media('', $post_id);
        foreach ($datas as $data) {
            $file = get_attached_file($data->ID);
            wp_delete_file($file);
            $query1 = "DELETE FROM {$wpdb->prefix}posts where ID = {$data->ID}";
            $query2 = "DELETE FROM {$wpdb->prefix}postmeta WHERE post_id = {$data->ID} ";
            $wpdb->query($query1);
            $wpdb->query($query2);
        }
    }

    public static function importar_queue($i = false)
    {
        if (\session_status() == PHP_SESSION_NONE) {
            ini_set('session.use_strict_mode', 1);
            \session_start();
        }

        $sooprema = new SoopremaController();
        wp_send_json($sooprema->processQueue());
    }
    
    public static function programarQueue()
    {
        global $wpdb;
        $activar = get_option('sooprema_activar_cron');

        if ($activar == 1) {
            if (get_option('sooprema_notificar_email') == '1') {
                $email = get_option('sooprema_cron_email') != '' ? get_option('sooprema_cron_email') : get_bloginfo('admin_email');
                $to = $email;
                $subject_ini = 'Iniciando importacion';
                $subject_fin = 'Finalizado importacion';
                $body_ini = 'Se ha iniciado el proceso de la cola el  '.date('Y-m-d H:i:s');
                $body_fin = 'Se ha terminado el proceso de la cola el  '.date('Y-m-d H:i:s');
                $headers = ['Content-Type: text/html; charset=UTF-8'];
                wp_mail($to, $subject_ini, $body_ini, $headers);
            }
            $sooprema = new SoopremaController();
            //   $queue = trim(get_option('sooprema_task_queue'), '{}');
            $queue = $wpdb->get_var("SELECT option_value FROM $wpdb->options WHERE option_name = 'sooprema_task_queue'");
            $elements = explode("},{", $queue);
            $numbInmuebles = ($queue === '') ? 0 : count($elements);
            
            while ($numbInmuebles > 0) {
                $sooprema->processQueue();
                
                $numbInmuebles=$numbInmuebles-1;
                // error_log($numbInmuebles);
            }
            
            if (get_option('chideal_notificar_email') == '1') {
                wp_mail($to, $subject_fin, $body_fin, $headers);
            }
            wp_mail($to, $subject_fin, $body_fin, $headers);
        }
    }
    /**
     * clear_queue function
     * borra la cola del webhook
     */
    public static function clean_queue()
    {
        \update_option('sooprema_task_queue', '');
        wp_send_json(['status'=>'ok','message'=>'queue cleared']);
    }

    public function setPlanta($planta)
    {
        switch($planta) {
            case '-3':
                return 'Sótano 3';
                break;
            case '-2':
                return 'Sótano 2';
                break;
            case '-1':
                return 'Sótano 1';
                break;
            case '0':
                return 'Bajo';
                break;
            case '-11':
                return 'Entreplanta';
                break;
            case '-12':
                return 'Semisótano';
                break;
            default:
                return $planta;
                break;
        }
    }
}
