<?php

namespace SnycEzy\ServiceM8_HubSpot;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Servicem8AccountInfo extends Model
{
    use SoftDeletes;
    //
    protected $table = 'servicem8_account_info';

    protected $fillable = [
        'username', 'password'
    ];

    public function getCompanyFromServicem8()
    {
        $return = array('status'=>false, 'message'=>'', 'response'=>'');
        try{
            $client = new \GuzzleHttp\Client();

            $response = $client->request('GET', 'https://api.servicem8.com/api_1.0/company.json', [
                'headers' => [
                    'Authorization' => ['Basic '.base64_encode($this->username.':'.$this->password)],
                    'Accept' => 'application/json'
                ],
            ]);
            $return = array('status'=>true, 'message'=>'', 'response'=>json_decode($response->getBody()));
            return $return;
        }
        catch(Exception $e)
        {
            $response = $e->getResponse();
            $response = json_decode($response->getBody());
            $return = array('status'=>false, 'message'=>$response->message, 'response'=>$response);
            return $return;
        }
    }

    public function getCompanyContactFromServicem8()
    {
        $return = array('status'=>false, 'message'=>'', 'response'=>'');
        try{
            $client = new \GuzzleHttp\Client();

            $response = $client->request('GET', 'https://api.servicem8.com/api_1.0/companycontact.json', [
                'headers' => [
                    'Authorization' => ['Basic '.base64_encode($this->username.':'.$this->password)],
                    'Accept' => 'application/json'
                ],
            ]);
            $return = array('status'=>true, 'message'=>'', 'response'=>json_decode($response->getBody()));
            return $return;
        }
        catch(Exception $e)
        {
            $response = $e->getResponse();
            $response = json_decode($response->getBody());
            $return = array('status'=>false, 'message'=>$response->message, 'response'=>$response);
            return $return;
        }
    }

}
