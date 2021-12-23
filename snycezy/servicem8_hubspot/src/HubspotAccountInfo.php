<?php

namespace SnycEzy\ServiceM8_HubSpot;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use HubSpot\Factory;
use HubSpot\Client\Crm\Contacts\Model\SimplePublicObjectInput as contactSimplePublicObjectInput;

use HubSpot\Client\Crm\Contacts\Model\PublicObjectSearchRequest as contactPublicObjectSearchRequest;
use HubSpot\Client\Crm\Companies\Model\SimplePublicObjectInput as CompaniesSimplePublicObjectInput;

use HubSpot\Client\Crm\Contacts\ApiException as ContactApiException;
use HubSpot\Client\Crm\Companies\ApiException as CompApiException;

class HubspotAccountInfo extends Model
{
    use SoftDeletes;
    //
    protected $table = 'hubspot_account_info';

    protected $fillable = [
        'api_key'
    ];

    public function getContactHubSpot(){
        $return = array('status'=>false, 'message'=>'', 'response'=>'');

        $client = Factory::createWithApiKey($this->api_key);

        try {
            $apiResponse = $client->crm()->contacts()->basicApi()->getPage(10, null, null, null, false);
            $return = array('status'=>true, 'message'=>'', 'response'=>json_decode($apiResponse, true)['results']);

        } catch (ContactApiException $e) {
            $return = array('status'=>false, 'message'=>$e->getMessage(), 'response'=>'');
        }

        return $return;
    }

    public function createContact($properties){

        $return = array('status'=>false, 'message'=>'', 'response'=>'');

        $client = Factory::createWithApiKey($this->api_key);

        $SimplePublicObjectInput = new contactSimplePublicObjectInput(['properties' => $properties]);
        try {
            $apiResponse = $client->crm()->contacts()->basicApi()->create($SimplePublicObjectInput);
            $return = array('status'=>true, 'message'=>'', 'response'=>json_decode($apiResponse, true));
        } catch (ContactApiException $e) {

            $return = array('status'=>false, 'message'=>$e->getMessage(), 'response'=>$e->getCode());
        }
        return $return;
    }

    public function updateContact($contactID, $properties){
        $return = array('status'=>false, 'message'=>'', 'response'=>'');

        $client = Factory::createWithApiKey($this->api_key);

        $SimplePublicObjectInput = new contactSimplePublicObjectInput(['properties' => $properties]);
        try {
            $apiResponse = $client->crm()->contacts()->basicApi()->update($contactID, $SimplePublicObjectInput, null);
            $return = array('status'=>true, 'message'=>'', 'response'=>json_decode($apiResponse, true));
        } catch (ContactApiException $e) {
            $return = array('status'=>false, 'message'=>$e->getMessage(), 'response'=>$e->getCode());
        }
        return $return;
    }

    public function getCompanyHubSpot(){
        $return = array('status'=>false, 'message'=>'', 'response'=>'');
        $client = Factory::createWithApiKey($this->api_key);

        try {
            $apiResponse = $client->crm()->companies()->basicApi()->getPage(10, null, null, null, false);
            $return = array('status'=>true, 'message'=>'', 'response'=>json_decode($apiResponse, true)['results']);
        } catch (CompApiException $e) {
            $return = array('status'=>false, 'message'=>$e->getMessage(), 'response'=>'');
        }
        return $return;
    }

    public function createCompany($properties){
        $return = array('status'=>false, 'message'=>'', 'response'=>'');
        $client = Factory::createWithApiKey($this->api_key);
        $SimplePublicObjectInput = new CompaniesSimplePublicObjectInput(['properties' => $properties]);
        try {
            $apiResponse = $client->crm()->companies()->basicApi()->create($SimplePublicObjectInput);
            $return = array('status'=>true, 'message'=>'', 'response'=>json_decode($apiResponse, true));
        } catch (CompApiException $e) {
            $return = array('status'=>false, 'message'=>$e->getMessage(), 'response'=>'');
        }
        return $return;
    }

    public function updateCompany($companyID, $properties){
        $return = array('status'=>false, 'message'=>'', 'response'=>'');
        $client = Factory::createWithApiKey($this->api_key);

        $SimplePublicObjectInput = new CompaniesSimplePublicObjectInput(['properties' => $properties]);
        try {
            $apiResponse = $client->crm()->companies()->basicApi()->update($companyID, $SimplePublicObjectInput, null);
            $return = array('status'=>true, 'message'=>'', 'response'=>json_decode($apiResponse, true));
        } catch (CompApiException $e) {
            $return = array('status'=>false, 'message'=>$e->getMessage(), 'response'=>'');
        }
        return $return;
    }

    public function ContactToCompanyAssociation($contactID, $companyID)
    {
        $return = array('status'=>false, 'message'=>'', 'response'=>'');
        $client = Factory::createWithApiKey($this->api_key);

        try {
            $apiResponse = $client->crm()->contacts()->associationsApi()->create($contactID, "company", $companyID, "Contact_to_company");
            $return = array('status'=>true, 'message'=>'', 'response'=>json_decode($apiResponse, true));
        } catch (ApiException $e) {
            $return = array('status'=>false, 'message'=>$e->getMessage(), 'response'=>'');
        }
        return $return;
    }

    //Delete Association Of contact from Company
    public function archiveContactToCompanyAssociation($contactID, $companyID)
    {
        $return = array('status'=>false, 'message'=>'', 'response'=>'');
        $client = Factory::createWithApiKey($this->api_key);

        try {
            $apiResponse = $client->crm()->contacts()->associationsApi()->archive($contactID, "company", $companyID, "contact_to company");
            $return = array('status'=>true, 'message'=>'', 'response'=>json_decode($apiResponse, true));
        } catch (ApiException $e) {
            $return = array('status'=>false, 'message'=>$e->getMessage(), 'response'=>'');
        }
        return $return;
    }

    public function CompanyToContactAssociation($companyID, $contactID)
    {
        $return = array('status'=>false, 'message'=>'', 'response'=>'');
        $client = Factory::createWithApiKey($this->api_key);

        try {
            $apiResponse = $client->crm()->companies()->associationsApi()->create($companyID, "Contact", $contactID, "company_to_contact");
            $return = array('status'=>true, 'message'=>'', 'response'=>json_decode($apiResponse, true));
        } catch (ApiException $e) {
            $return = array('status'=>false, 'message'=>$e->getMessage(), 'response'=>'');
        }
        return $return;
    }

    public function ArchiveCompanyToContactAssociation($companyID, $contactID)
    {
        $return = array('status'=>false, 'message'=>'', 'response'=>'');
        $client = Factory::createWithApiKey($this->api_key);

        try {
            $apiResponse = $client->crm()->companies()->associationsApi()->archive($companyID, "Contact", $contactID, "company_to_contact");
            $return = array('status'=>true, 'message'=>'', 'response'=>json_decode($apiResponse, true));
        } catch (ApiException $e) {
            $return = array('status'=>false, 'message'=>$e->getMessage(), 'response'=>'');
        }
        return $return;
    }

    public function DeleteCompany($companyID){
        $return = array('status'=>false, 'message'=>'', 'response'=>'');
        $client = Factory::createWithApiKey($this->api_key);

        try {
            $apiResponse = $client->crm()->companies()->basicApi()->archive($companyID);
            $return = array('status'=>true, 'message'=>'', 'response'=>json_decode($apiResponse, true));
        } catch (ApiException $e) {
            $return = array('status'=>false, 'message'=>$e->getMessage(), 'response'=>'');
        }
        return $return;
    }

    public function DeleteContact($contactID){
        $return = array('status'=>false, 'message'=>'', 'response'=>'');
        $client = Factory::createWithApiKey($this->api_key);

        try {
            $apiResponse = $client->crm()->contacts()->basicApi()->archive($contactID);
            $return = array('status'=>true, 'message'=>'', 'response'=>json_decode($apiResponse, true));
        } catch (ApiException $e) {
            $return = array('status'=>false, 'message'=>$e->getMessage(), 'response'=>'');
        }
        return $return;
    }

    public function searchContact($email)
    {
        $return = array('status'=>false, 'message'=>'', 'response'=>'');
        $client = Factory::createWithApiKey("eu1-906e-cc88-4f28-9073-f265f052552b");

        $arr = array('filter_groups' => array(array('filters'=>array(array("value"=>$email,"propertyName"=>"email","operator"=>"EQ")))), 'sorts' => array("email"), 'properties' => array("id"), 'limit' => 9, 'after' => 0);


        $PublicObjectSearchRequest = new contactPublicObjectSearchRequest($arr);
        try {
            $apiResponse = $client->crm()->contacts()->searchApi()->doSearch($PublicObjectSearchRequest);
            $return = array('status'=>true, 'message'=>'', 'response'=>json_decode($apiResponse, true));
        } catch (ApiException $e) {
            $return = array('status'=>false, 'message'=>$e->getMessage(), 'response'=>'');
        }
        return $return;
    }
}
