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
      $arr = array(
        11 => array('fighter', 'Phalanx'),
        12 => array('fighter', 'Knight'),
        13 => array('fighter', 'Gladiator'),
        14 => array('fighter', 'Rune Knight'),

        21 => array('rogue', 'Ranger'),
        22 => array('rogue', 'Treasure Hunter'),
        23 => array('rogue', 'Assasin'),
        24 => array('rogue', 'Rune Walker'),

        31 => array('mage', 'Bishop'),
        32 => array('mage', 'Warlock'),
        33 => array('mage', 'Inquirer'),
        34 => array('mage', 'Elemental Master'),
    );
      return $arr[$key];
    }
}

if(!function_exists('luna_job5'))
{
    function luna_job5($key) {
        $arr = array(
            11 => array('fighter','Paladin'),
            12 => array('fighter','Panzer'),
            13 => array('fighter','Crusader'),
            14 => array('fighter','Destroyer'),
            15 => array('fighter','Sword Master'),
            16 => array('fighter','Magnus'),

            21 => array('rogue','Sniper'),
            22 => array('rogue','Intraper'),
            23 => array('rogue','Blade Taker'),
            24 => array('rogue','Templar Master'),
            25 => array('rogue','Arch Ranger'),
            
            26 => array('mage','Storm Master'),
            31 => array('mage','Cardinal'),
            32 => array('mage','Soul Arbiter'),
            33 => array('mage','Grand Master'),
            34 => array('mage','Necromancer'),
            // 35 => array('mage','RunicMaster'),
            35 => array('mage','Rune Master'),
        );
        return $arr[$key];
    }
}

if(!function_exists('luna_job6'))
{
    function luna_job6($key)
    {
      $arr = array(
        11 => array('fighter', 'Lord'),
        12 => array('fighter', 'Death Knight'),
        13 => array('fighter', 'Arc Templar'),

        21 => array('rogue', 'Soul Eye'),
        22 => array('rogue', 'Blood Stalker'),
        23 => array('rogue', 'Arc Bridger'),

        31 => array('mage', 'Saint'),
        32 => array('mage', 'Dark Archon'),
        33 => array('mage', 'Arc Celebrant'),
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

if(!function_exists('split_name')){
    function split_name($name) {
        $name = trim($name);
        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $first_name = trim( preg_replace('#'.preg_quote($last_name,'#').'#', '', $name ) );
        return array($first_name, $last_name);
    }
}

?>