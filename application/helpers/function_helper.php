<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function FullURL(){
    $url = base_url().uri_string();
    return $url;
}
function AssetsURL(){
    $url = (isset($_SERVER['HTTPS']) ? "https://" : "http://").$_SERVER['HTTP_HOST'].'/assets/';
    return $url;
}
function PrintArray($data){
    $output = '<pre>'.print_r($data,1).'</pre>';
}
function YesOrNo($data){
    if ($data == 1){
        return '<i class="fas fa-check fa-fw"></i>';
    } else {
        return '<i class="fas fa-times fa-fw"></i>';
    }
}
// Indonesian Format
// function TimetoTimeDate($time){
// 	$bulan = array (
//         'Januari',
//         'Februari',
//         'Maret',
//         'April',
//         'Mei',
//         'Juni',
//         'Juli',
//         'Agustus',
//         'September',
//         'Oktober',
//         'November',
//         'Desember',
//     );
//     $time = date('h:i:s A, d-m-Y', $time);
// 	$time = explode('-', $time);
// 	$time = $time[0] . ' ' . $bulan[ (int)$time[1] - 1 ] . ' ' . $time[2];
//     return $time;
// }
// function TimetoDate($time){
// 	$bulan = array (
//         'Januari',
//         'Februari',
//         'Maret',
//         'April',
//         'Mei',
//         'Juni',
//         'Juli',
//         'Agustus',
//         'September',
//         'Oktober',
//         'November',
//         'Desember',
//     );
//     $time = date('d-m-Y', $time);
// 	$time = explode('-', $time);
// 	$time = $time[0] . ' ' . $bulan[ (int)$time[1] - 1 ] . ' ' . $time[2];
//     return $time;
// }
// function timetostr($time_sinces){
    
//     $estimate_time = time() - $time_sinces;

//     if ( $estimate_time <= 1 ){
//         return '1 second ago';
        
//     } else {
//         $condition = array( 
//             24 * 60 * 60            =>  'Hari',
//             60 * 60                 =>  'Jam',
//             60                      =>  'Menit',
//             1                       =>  'Detik'
//         );

//         foreach( $condition as $secs => $str ){
//             $d = $estimate_time / $secs;

//             if ( $d >= 1 ){
//                 $r = round( $d );
//                 if ($estimate_time <= 259200){
//                     return $r.' '.$str.' yang lalu.';

//                 } else {
//                     $bulan = array (
//                         'Januari',
//                         'Februari',
//                         'Maret',
//                         'April',
//                         'Mei',
//                         'Juni',
//                         'Juli',
//                         'Agustus',
//                         'September',
//                         'Oktober',
//                         'November',
//                         'Desember',
//                     );
//                     $time = date('d-m-Y', $time_sinces);
//                     $time = explode('-', $time);
//                     $time = $time[0] . ' ' . $bulan[ (int)$time[1] - 1 ] . ' ' . $time[2];
//                     return $time;
//                 }
//             }
//         }
//     }
// }
function TimetoTimeDate($time){
    $time = date('H:i:s, d M Y', $time);
    return $time;
}
function TimetoDate($time){
    $time = date('d F Y', $time);
    return $time;
}
function timetostr($time_sinces){
    
    $estimate_time = time() - $time_sinces;

    if ( $estimate_time <= 1 ){
        return '1 second ago';
        
    } else {
        $condition = array( 
            24 * 60 * 60            =>  'day',
            60 * 60                 =>  'hour',
            60                      =>  'minute',
            1                       =>  'second'
        );

        foreach( $condition as $secs => $str ){
            $d = $estimate_time / $secs;

            if ( $d >= 1 ){
                $r = round( $d );
                if ($estimate_time <= 259200){
                    return $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
                } else {
                    return date('d F Y', $time_sinces);
                }
            }
        }
    }
}
function secondsToTime($s)
{
    $h = floor($s / 3600);
    $s -= $h * 3600;
    $m = floor($s / 60);
    $s -= $m * 60;

    if ($h < 10){
        $h = sprintf('%02d', $h);
    }
    
    if ($m < 10){
        $m = sprintf('%02d', $m);
    }
    
    if ($s < 10){
        $s = sprintf('%02d', $s);
    }
    return $h.':'.$m.':'.$s;
}
function ConvertTTL($data, $type = 'ttl'){

    if ($data == null){
        $data = 'xxx, 0';
    }
                    
    preg_match('/^([^,]+),/', $data, $matches );
    $tempat_lahir = $matches[1];

    preg_match('/, (.*)/', $data, $matches );
    $tanggal_lahir = $matches[1];

    if($type === 'tempat_lahir'){
        $tempat_lahir = strtolower($tempat_lahir);
        $tempat_lahir = ucwords($tempat_lahir);
        $output = $tempat_lahir;

    } elseif($type === 'tanggal_lahir'){
        $output = $tanggal_lahir;

    } else {
        $output = ucwords(strtolower($tempat_lahir)).', '.TimetoDate($tanggal_lahir);

    }

    return $output;
}
function NumToRoman($number) {
    $map = array(
        'M' => 1000,
        'CM' => 900,
        'D' => 500,
        'CD' => 400,
        'C' => 100,
        'XC' => 90,
        'L' => 50,
        'XL' => 40,
        'X' => 10,
        'IX' => 9,
        'V' => 5,
        'IV' => 4,
        'I' => 1
    );
    $returnValue = '';
    while ($number > 0) {
        foreach ($map as $roman => $int) {
            if($number >= $int) {
                $number -= $int;
                $returnValue .= $roman;
                break;
            }
        }
    }
    return $returnValue;
}
function text_substr($text, $length){
    if (strlen($text) >= $length){
        $text = strip_tags($text);
        $text = substr($text, 0, $length) . ' ...';
    }
    return $text;
}
function dash2space($text){
    $text = str_replace("-", " ", $text);
    $text = ucwords($text);
    return $text;
}
function space2dash($text){
    $text = preg_replace('/[^A-Za-z0-9]/', ' ', $text);
    $text = preg_replace('/\s+/', ' ', $text);
    $text = str_replace(' ', '-', $text);
    return $text;
}
function remove_tags($data){
    $data = utf8_decode($data);
    $data = str_replace('&nbsp;', ' ', $data);
    $data = preg_replace('/\s\s+/', '',$data);
    $data = trim($data);
    return $data;
}
function Keyword_Site($data) {
    $data = preg_replace('/\s\s+/', '', $data);
    $data = preg_replace("/&#?[a-z0-9]+;/i",' ',$data);
    $data = strip_tags($data);
    $data = preg_replace('/[^A-Za-z0-9]/', ', ',strtolower($data));
    $data = implode(" ", preg_split("/[\s]+/", $data));
    $data = implode(',',array_unique(explode(',', $data)));
    $data = preg_replace('/[^A-Za-z0-9,]/', ' ',$data);
    return $data;
}
function sha_data($input1, $input2 = '', $hash = 'sha256'){
    if($input2 === ''){
        $output = strtoupper($input1);

    } else {
        $output = strtoupper($input1).':'.strtoupper($input2);

    }
    $output = hash($hash, $output);
    $output = strtolower($output);
    return $output;
}
function Gen_RandomBoth($length){
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function Gen_RandomText($length) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function Gen_RandomNumber($length) {
    $numbers = '0123456789';
    $numbersLength = strlen($numbers);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $numbers[rand(0, $numbersLength - 1)];
    }
    return $randomString;
}
function Gen_RandomCode($length = 16){
    $characters = '@#$%^&*-_+=?23456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function curl_do_api($url){
    if (!function_exists('curl_init')){
        $output = 'Sorry cURL is not installed!';
    } else {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $output = curl_exec($ch);
        curl_close($ch);
    }
    return $output;
}
function Logout_site($URL){
    session_unset(); 
    session_destroy();
    if (isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            setcookie($name, '', time()-1000);
            setcookie($name, '', time()-1000, '/');
        }
    }
    redirect($URL);
}