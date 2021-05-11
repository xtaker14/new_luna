<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Gdrive_read extends CI_Controller{



    public function __construct(){

        require APPPATH .'third_party/google/vendor/autoload.php';


        //https://console.developers.google.com/apis/credentials?project=download-gdrive-233608

        $this->client = new Google_Client();
        $this->client->setClientId('533454299152-41bhpndmvmlke1ov8rqlu7irf1sbkuv6.apps.googleusercontent.com');
        $this->client->setClientSecret('F-IkWtDmPtZhJGsixz-QUe5I');
        $this->client->refreshToken('1/9Ar4Ulwv-LX2lkQ5u9a4Xo9Hl72b7MXenWBa30Z7qnc');

    }



    public function a_token() {

        $CI = get_instance();    

        $CI->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file','key_prefix' => 'read_'));

        if ( ! $access_token = $CI->cache->get('access_token_readonly'))

        {

            $a_c = $this->client->getAccessToken();

            $tokennya = $a_c["access_token"];

            $CI->load->library('encryption');

            $CI->encryption->initialize(array('cipher' => 'aes-256','mode' => 'ctr','key' => 'johanufi@gmail.com'));

            $access_token = $CI->encryption->encrypt($tokennya);

            $CI->cache->save('access_token_readonly', $access_token, 300);//times = 600 default = 5 minutes

        }

        return $this->token_descrypt($access_token);

    }



    public function token_descrypt($string_encrypted){

        $CI = get_instance(); 

        $CI->load->library('encryption');

        $CI->encryption->initialize(array('cipher' => 'aes-256','mode' => 'ctr','key' => 'vyant.xepozone@gmail.com'));

        $result = $CI->encryption->decrypt($string_encrypted);

        return $result;

    }

}