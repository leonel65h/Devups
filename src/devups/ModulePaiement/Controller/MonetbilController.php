<?php


namespace devups\ModulePaiement\Controller;

class MonetbilController extends \Controller
{
 public static  $service_key;
 public static $amount;
public static $return_url;
public static $notify_url;
public static $logo;

    /**
     * @return mixed
     */
    public static function getLogo()
    {
        return self::$logo;
    }

    /**
     * @param mixed $logo
     */
    public static function setLogo($logo)
    {
        self::$logo = $logo;
    }

    /**
     * @return mixed
     */
    public static function getServiceKey()
    {
        return [
            "service_key"=>self::$service_key
        ];

    }
    /**
     * @param mixed $service_key
     */
    public static function setServiceKey($service_key)
    {
        self::$service_key=$service_key;
    }


    /**
     * @return mixed
     */
    public static function getAmount()
    {
        return [
            "amount"=>self::$amount
        ];
    }

    /**
     * @param mixed $amount
     */
    public static function setAmount($amount)
    {
        self::$amount=$amount;
    }

    /**
     * @return mixed
     */
    public function getReturnUrl()
    {
        return $this->return_url;
    }

    public static function reference(){
        \Dvups_agregateur::update(array('reference'=>\Request::post('reference')))->where('nom','=',\Request::post('agregateur'))->exec();
        \Response::set("reference",\Request::post('reference'));
        \Response::set("agregateur",\Request::post('agregateur'));
        return \Response::$data;
    }


    /**
     * @param mixed $return_url
     */
    public function setReturnUrl()
    {
        $this->return_url ='';
    }

    /**
     * @return mixed
     */
    public function getNotifyUrl()
    {
        return $this->notify_url;
    }

    /**
     * @param mixed $notify_url
     */
    public function setNotifyUrl()
    {
        $this->notify_url ='';
    }



    public static function mergeArguments($monetbil_args){
        return array_merge(array(
            'amount' =>self::$amount,
            'phone' =>'',
            'country'=> 'CM,SN',
            'user' => 'leonel65',
            'first_name' => 'leonel65',
            'last_name' => 'leonel65',
            'email' => 'leonel65kuaya@gmail.com',
            'return_url' =>\Request::post('urlR'),
            'notify_url' =>\Request::post('urlN'),
            'logo' =>\Request::post('logo'),
        ), $monetbil_args);
    }

    public static function url($monetbil_args = array())
    {
        $qb = \Dvups_agregateur::select()->where("nom",'=','monetbil')->__getOne();
        $c=$qb->getReference();
        $querydata=self::mergeArguments($monetbil_args);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.monetbil.com/widget/v2.1/' .$c);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($querydata, '', '&'));
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response, true);
        $payment_url = '';
        if (is_array($result) and array_key_exists('payment_url', $result)) {
            $payment_url = $result['payment_url'];
        }
        else{
            return null;
        }
            return [
                "agregateur"=>'monetbil',
                "payment_url"=>$payment_url
            ];
    }
    public function statistique(){
        $a = array(
            'val'=>array('12','122','184','140','24','124','104','40','89','14','654','45')
        );
        \Genesis::renderView("agregateur.statistique",$a);
    }


}