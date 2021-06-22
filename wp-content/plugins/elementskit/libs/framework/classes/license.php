<?php 
namespace ElementsKit\Libs\Framework\Classes;
use ElementsKit\Libs\Framework\Classes\Utils;

defined( 'ABSPATH' ) || exit;

class License{

    public static $instance = null;

    public function global_var_cache_get($key){
        global $elementskit_global_var_cache;
        if(isset($elementskit_global_var_cache[$key])){
            return $elementskit_global_var_cache[$key];
        }

        return null;
    }

    public function global_var_cache_set($key, $value){
        global $elementskit_global_var_cache;
        $elementskit_global_var_cache[$key] = $value;

        return true;
    }

    public function get_license_info(){
        return ['status'=>'valid'];
    }

    public function activate($key){
       
        update_option('__validate_oppai__', 1);
        Utils::instance()->save_option('license_key', 'nulled');
        
        
        return $o;
    }
    public function revoke(){
        $data = [
            'key' => 'nulled',
        ];

        update_option('__validate_oppai__',1);
        Utils::instance()->save_option('license_key', 'nulled');
        
        return true;
    }
    public function com_validate($data = []){
        if(strlen($data['key']) < 28){
            return null;
        }
        $data['oppai'] = 1;
        $data['action'] = 'activate';
        $data['v'] = \ElementsKit::version();
        $url = \ElementsKit::api_url() . 'license?' . http_build_query($data);
        
        $args = array(
            'timeout'     => 60,
            'redirection' => 3,
            'httpversion' => '1.0',
            'blocking'    => true,
            'sslverify'   => true,
        ); 

        $res = wp_remote_get( $url, $args );

        return (object) json_decode(
            (string) $res['body']
        ); 
    }

    public function com_revoke($data = []){
        $data['oppai'] = 1;
        $data['action'] = 'revoke';
        $data['v'] = \ElementsKit::version();
        $url = \ElementsKit::api_url() . 'license?' . http_build_query($data);
        
        $args = array(
            'timeout'     => 10,
            'redirection' => 3,
            'httpversion' => '1.0',
            'blocking'    => true,
            'sslverify'   => true,
        ); 

        $res = wp_remote_get( $url, $args );

        return (object) json_decode(
            (string) $res['body']
        );
    }

    public function status(){
       
        
        return 'valid';
    }

    public static function instance() {
        if ( is_null( self::$instance ) ) {

            // Fire the class instance
            self::$instance = new self();
        }

        return self::$instance;
    }
}