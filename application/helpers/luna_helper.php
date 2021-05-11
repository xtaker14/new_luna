<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('json'))
{
    function json($data = NULL){
        $CI = get_instance();
        $CI->output->set_status_header ( 200 )->set_content_type ( 'application/json', 'utf-8' )->set_output ( json_encode ( $data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) )->_display ();
        exit ();
    }
}

if(!function_exists('dbloader'))
{
    function dbloader($dbname=''){
        $CI = get_instance();
        $a = $CI->load->database($dbname, TRUE);
        return $a;
    }

}

if(!function_exists('luna_job4'))
{
    function luna_job4($key)
    {
      $arr = array(11 => 'Phalanx',
        12 => 'Knight',
        13 => 'Gladiator',
        14 => 'Rune Knight',
        21 => 'Ranger',
        22 => 'Treasure Hunter',
        23 => 'Assasin',
        24 => 'Rune Walker',
        31 => 'Bishop',
        32 => 'Warlock',
        33 => 'Inquirer',
        34 => 'Elemental Master'
    );
      return $arr[$key];
    }
}

if(!function_exists('luna_job5'))
{
    function luna_job5($key)
    {
      $arr = array(
        11 => 'Paladin',
        12 => 'Panzer',
        13 => 'Crusader',
        14 => 'Destroyer',
        15 => 'Sword Master',
        16 => 'Magnus',
        21 => 'Sniper',
        22 => 'Intraper',
        23 => 'Blade Taker',
        24 => 'Templar Master',
        25 => 'Arch Ranger',
        26 => 'Storm Master',
        31 => 'Cardinal',
        32 => 'Soul Arbiter',
        33 => 'Grand Master',
        34 => 'Necromancer',
        35 => 'RunicMaster'
    );
      return $arr[$key];
    }
}

if(!function_exists('luna_job6'))
{
    function luna_job6($key)
    {
      $arr = array(
        11 => 'Lord',
        12 => 'Death Knight',
        13 => 'Arc Templar',
        21 => 'Soul Eye',
        22 => 'Blood Stalker',
        23 => 'Arc Bridger',
        31 => 'Saint',
        32 => 'Dark Archon',
        33 => 'Arc Celebrant'
    );
      return $arr[$key];
    }
}

if(!function_exists('curl')){
  function curl($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
        curl_setopt($ch, CURLOPT_ENCODING,'gzip');
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $header[] = "Accept-Language: en";
        $header[] = "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.0; de; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3
        ";
        $header[] = "Pragma: no-cache";
        $header[] = "Cache-Control: no-cache";
        $header[] = "Accept-Encoding: gzip,deflate";
        $header[] = "Content-Encoding: gzip";
        $header[] = "Content-Encoding: deflate";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $load = curl_exec($ch);
        curl_close($ch);
        return $load;
    }
}

if(!function_exists('curl_biasa')){
  function curl_biasa($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
        curl_setopt($ch, CURLOPT_ENCODING,'gzip');
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $load = curl_exec($ch);
        curl_close($ch);
        return $load;
    }
}

function pre($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

if(!function_exists('get_instance'))
{
    function get_instance()
    {
        $CI = &get_instance();
    }
}

if(!function_exists('getHashedPassword'))
{
    function getHashedPassword($plainPassword)
    {
        return password_hash($plainPassword, PASSWORD_DEFAULT);
    }
}

if(!function_exists('verifyHashedPassword')){
    function verifyHashedPassword($plainPassword, $hashedPassword){
        return password_verify($plainPassword, $hashedPassword) ? true : false;
    }
}

if(!function_exists('cek_referer')){
    function cek_referer(){
        $test = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
        if($test == $_SERVER['SERVER_NAME']){
            return true;
        }else{
            return false;
        }
    }
}

if(!function_exists('setFlashData'))
{
    function setFlashData($status, $flashMsg)
    {
        $CI = get_instance();
        $CI->session->set_flashdata($status, $flashMsg);
    }
}

if(!function_exists('multi_flash'))
{
    function multi_flash($arr,$redirect=''){
        $CI = get_instance();
        foreach ($arr as $key => $value) {
           $CI->session->set_flashdata($key, $value);
        }
        redirect(base_url($redirect));
    }
}

if(!function_exists('is_robot')){
    function is_robot(){
        $CI = get_instance();    
        if($CI->agent->is_robot()){
            return true;
        }else{
            return false;
        }
    }
}

if(!function_exists('is_mobile')){
    function is_mobile(){
        $CI = get_instance();    
        if($CI->agent->is_mobile()){
            return true;
        }else{
            return false;
        }
    }
}

if(!function_exists('is_browser')){
    function is_browser(){
        $CI = get_instance();    
        if($CI->agent->is_browser()){
            return true;
        }else{
            return false;
        }
    }
}

if(!function_exists('toggle_to_int'))
{
    function toggle_to_int($val){
        if($val=='on'){
           $val = 1;
        }else{
           $val = 0;
        }
        return $val;
    }
}

if(!function_exists('str_cleaner'))
{
    function str_cleaner($val){
        $a = str_replace("'", "`", $val);
        return $a;
    }
}

if(!function_exists('title_to_url')){
    function title_to_url($value){
        $value = preg_replace("/[^A-Za-z0-9- ]/", ' ', $value);
        $value = trim($value);
        $value = str_replace(' ', '-', $value);
        $value = preg_replace('/\-+/', '-', $value);
        return urlencode($value);
    }
}

?>