<?php


namespace devups\ModulePaiement\Controller;


class AfrikpayController extends \Controller
{
    public static function reference(){
        $agregateur=MonetbilController::Crypte(\Request::post('reference'),'devups');
        \Dvups_agregateur::update(array('reference'=>$agregateur['b']))->where('nom','=',\Request::post('agregateur'))->exec();
        \Response::set("reference",\Request::post('reference'));
        \Response::set("agregateur",\Request::post('agregateur'));
        return \Response::$data;
    }

    public static function url()
    {
        $qb = \Dvups_agregateur::select()->where("nom",'=','afrikpay')->__getOne();
        $c=$qb->getReference();
        $cle=MonetbilController::Decrypte($c,'dv_administrateur');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.afrikpay.com/api/online/online/?merchantid=' .$cle['c']);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response, true);
        $resultat = '';
        if (is_array($result) and array_key_exists('result', $result)) {
            $resultat = $result['result'];
        }
        else{
            return null;
        }
            return [
                "agregateur"=>'afrikpay',
                'resultat'=>$resultat
            ];
    }

}