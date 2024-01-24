<?php

use App\Models\UserSetting;


if (!function_exists('userSetting')) {
    /**
     * Dohvata ili postavlja korisničku postavku.
     *
     * @param  int    $userId
     * @param  string $key
     * @param  mixed  $value (opcionalno)
     * @return mixed
     */
    function userSetting($userId, $key, $value = null)
    {
        if ($value === null) {
            // Dohvatanje postavke
            return UserSetting::where('user_id', $userId)->where('key', $key)->value('value');
        } else {
            // Postavljanje ili ažuriranje postavke
            $setting = UserSetting::updateOrCreate(
                ['user_id' => $userId, 'key' => $key],
                ['value' => $value]
            );
            return $setting->value;
        }
    }
}

if(!function_exists('generateValidPassword')){
    function generateValidPassword($length = 10) {
        $password = '';
        $characterSets = [];
        $characterSets[] = 'abcdefghjkmnpqrstuvwxyz';
        $characterSets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
        $characterSets[] = '1234567890';
        $characterSets[] = '@$!%*#?&^()-_=+\/:;';

        foreach ($characterSets as $set) {
            $password .= $set[array_rand(str_split($set))];
        }

        while (strlen($password) < $length) {
            $randomSet = $characterSets[array_rand($characterSets)];
            $password .= $randomSet[array_rand(str_split($randomSet))];
        }

        return str_shuffle($password);
    }
}

if(!function_exists('setTranslationLabel')){
    function setTranslationLabel($label) {
        $label_trans = __('global.'. strtolower(preg_replace('/\s+/', '_', $label)));
        $trans_check = 'global.'. strtolower(preg_replace('/\s+/', '_', $label));

        return ( $label_trans != $trans_check) ? $label_trans : $label;
    }
}

if(!function_exists('calcRightCol')){
    function calcRightCol($data, $x) {
        if($x > 0){
            $col = (12/$x) < 4 ? 2 : (12/$x);
            $data = str_replace('dynamic-col', 'col-'.(12/$x), $data);
        }

        return $data;
    }
}

if(!function_exists('myCryptie')){
    function myCryptie($string, $todo='encode') {
        $key = sha1('y+6kg>btI1imcoBJOnHp7AF_fTGKQxqU5hXZzjRYWCDrlv8-u9NMdS');
        $strLen = strlen($string);
        $keyLen = strlen($key);
        $j = 0;
        $return = '';
        
        if( $todo == 'decode' ){
            for ($i = 0; $i < $strLen; $i+=2) {
                $ordStr = hexdec(base_convert(strrev(substr($string,$i,2)),36,16));
                if ($j == $keyLen) { $j = 0; }
                $ordKey = ord(substr($key,$j,1));
                $j++;
                $return .= chr($ordStr - $ordKey);
            }
        } else {
            for ($i = 0; $i < $strLen; $i++) {
                $ordStr = ord(substr($string,$i,1));
                if ($j == $keyLen) { $j = 0; }
                $ordKey = ord(substr($key,$j,1));
                $j++;
                $return .= strrev(base_convert(dechex($ordStr + $ordKey),16,36));
            }
        }
        return $return;
    }
}

if(!function_exists('getBadge')){
    function getBadge($badge){

        switch ($badge) {
            case 'active':
                $return = '<span class="badge badge-success">'. setTranslationLabel($badge) .'</span>';
                break;
            case 'inactive':
                $return = '<span class="badge badge-danger">'. setTranslationLabel($badge) .'</span>';
                break;
            case 'blocked':
                $return = '<span class="badge badge-danger">'. setTranslationLabel($badge) .'</span>';
                break;
            case 'suspended':
                $return = '<span class="badge badge-warning">'. setTranslationLabel($badge) .'</span>';
                break;
            case 'goes_live':
                $return = '<span class="badge badge-warning">'. setTranslationLabel($badge) .'</span>';
                break;
            case 'pending':
                $return = '<span class="badge badge-primary">'. setTranslationLabel($badge) .'</span>';
                break;
            default:
               $return = setTranslationLabel($badge);
        }

        return $return;
    }
}