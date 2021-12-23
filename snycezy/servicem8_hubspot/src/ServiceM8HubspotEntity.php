<?php

namespace SnycEzy\ServiceM8_HubSpot;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use SnycEzy\ServiceM8_HubSpot\HubspotAccountInfo as ServiceM8_HubSpotHubspotAccountInfo;
use SnycEzy\ServiceM8_HubSpot\Servicem8AccountInfo as ServiceM8_HubSpotServicem8AccountInfo;

class ServiceM8HubspotEntity extends Model
{
    //
    use SoftDeletes;
    //
    protected $table = 'servicem8_hubspot_entity_info';

    protected $fillable = [
        'object_type', 'servicem8_id', 'hubspot_id'
    ];

    public function SyncCompanyToHubspot($data, $HubspotAccountInfo)
    {
        $return = array('status'=>false, 'message'=>'', 'response'=>'');
        $tmp_res = array();
        foreach($data as $dtres)
        {
            if(!empty($dtres->active))
            {
                $properties = array();
                if(!empty($dtres->address_city))
                    $properties["city"] = $dtres->address_city;

                if(!empty($dtres->website))
                    $properties["domain"] = $dtres->website;

                if(!empty($dtres->name))
                    $properties["name"] = $dtres->name;

                if(!empty($dtres->address_state))
                    $properties["state"] = $dtres->address_state;

                if(!empty($dtres->address))
                    $properties["address"] = $dtres->address;

                if(!empty($dtres->address_postcode))
                    $properties["zip"] = $dtres->address_postcode;

                $entity = ServiceM8HubspotEntity::where(['object_type'=>'company', 'servicem8_id'=>$dtres->uuid])->first();
                if(!empty($entity) && $entity->count()>0)
                {
                    $reponse = $HubspotAccountInfo->updateCompany($entity->hubspot_id, $properties);
                    $rep['id'] = $entity->hubspot_id;
                }
                else
                {
                    $reponse = $HubspotAccountInfo->createCompany($properties);
                }
                if(!empty($reponse['status']))
                {
                    $rep = $reponse['response'];
                    if(!empty($entity) && $entity->count()>0)
                    {
                        $entity->update(['hubspot_id'=>$rep['id']]);
                    }
                    else
                    {
                        ServiceM8HubspotEntity::create(['object_type'=>'company', 'servicem8_id'=>$dtres->uuid, 'hubspot_id'=>$rep['id']]);
                    }
                    $tmp_res['success'][] = ['object_type'=>'company', 'servicem8_id'=>$dtres->uuid, 'hubspot_id'=>$rep['id']];
                }
                else{
                    $tmp_res['failed'][] = ['object_type'=>'company', 'servicem8_id'=>$dtres->uuid, 'hubspot_id'=>'', 'reponse'=>$reponse];
                }
            }
            else
            {
                $entity = ServiceM8HubspotEntity::where(['object_type'=>'company', 'servicem8_id'=>$dtres->uuid])->first();
                if(!empty($entity) && $entity->count()>0)
                {
                    $reponse = $HubspotAccountInfo->DeleteCompany($entity->hubspot_id);
                    $entity->delete();
                }

            }
        }
        $return['status'] = true;
        $return['response'] = $tmp_res;
        return $return;
    }

    public function SyncContactToHubspot($data, $HubspotAccountInfo)
    {
        $return = array('status'=>false, 'message'=>'', 'response'=>'');
        $tmp_res = array();
        foreach($data as $dtres)
        {
            $properties = array();
            if(!empty($dtres->email))
                $properties["email"] = $dtres->email;

            if(!empty($dtres->first))
                $properties["firstname"] = $dtres->first;

            if(!empty($dtres->last))
                $properties["lastname"] = $dtres->last;

            if(!empty($dtres->phone))
                $properties["phone"] = $dtres->phone;

            if(!empty($dtres->mobile))
                $properties["mobilephone"] = $dtres->mobile;

            if(!empty($dtres->type))
                $properties["jobtitle"] = $dtres->type;

            if(!empty($dtres->company_uuid))
            {
                $entity_c = ServiceM8HubspotEntity::where(['object_type'=>'company', 'servicem8_id'=>$dtres->company_uuid])->first();
                if(empty($entity_c))
                {

                    $entity = ServiceM8HubspotEntity::where(['object_type'=>'contact', 'servicem8_id'=>$dtres->uuid])->first();
                    if(!empty($entity) && $entity->count()>0)
                    {
                        $reponse = $HubspotAccountInfo->DeleteContact($entity->hubspot_id);
                        $entity->delete();
                    }
                    continue;
                }
                elseif(empty($dtres->active))
                {
                    $entity = ServiceM8HubspotEntity::where(['object_type'=>'contact', 'servicem8_id'=>$dtres->uuid])->first();
                    if(!empty($entity) && $entity->count()>0)
                    {
                        $reponse = $HubspotAccountInfo->DeleteContact($entity->hubspot_id);
                        $entity->delete();
                    }
                    continue;
                }
            }
            $contactID = '';
            $entity = ServiceM8HubspotEntity::where(['object_type'=>'contact', 'servicem8_id'=>$dtres->uuid])->first();
            if(!empty($entity) && $entity->count()>0)
            {
                $reponse = $HubspotAccountInfo->updateContact($entity->hubspot_id, $properties);
                $rep['id'] = $contactID = $entity->hubspot_id;
            }
            else
            {
                $reponse = $HubspotAccountInfo->createContact($properties);
            }
            if(!empty($reponse['status']))
            {
                $rep = $reponse['response'];
                if(!empty($entity) && $entity->count()>0)
                {
                    $entity->update(['hubspot_id'=>$rep['id']]);
                    $contactID = $rep['id'];
                }
                else
                {
                    $entity = ServiceM8HubspotEntity::create(['object_type'=>'contact', 'servicem8_id'=>$dtres->uuid, 'hubspot_id'=>$rep['id']]);
                    $contactID = $rep['id'];
                }
                $tmp_res['success'][] = ['object_type'=>'contact', 'servicem8_id'=>$dtres->uuid, 'hubspot_id'=>$rep['id']];
            }
            else{
                if($reponse['response']=="409")
                {
                    $data = $HubspotAccountInfo->searchContact($dtres->email);
                    if(!empty($data['status']))
                    {
                        if($data['response']['total']>0)
                        {
                            $rep = $data['response']['results'][0];
                            if(!empty($entity) && $entity->count()>0)
                            {
                                $entity->update(['hubspot_id'=>$rep['id']]);
                                $contactID = $rep['id'];
                            }
                            else
                            {
                                $entity = ServiceM8HubspotEntity::create(['object_type'=>'contact', 'servicem8_id'=>$dtres->uuid, 'hubspot_id'=>$rep['id']]);
                                $contactID = $rep['id'];
                            }
                            $tmp_res['success'][] = ['object_type'=>'contact', 'servicem8_id'=>$dtres->uuid, 'hubspot_id'=>$rep['id']];
                        }
                    }
                }
                else{
                    $tmp_res['failed'][] = ['object_type'=>'contact', 'servicem8_id'=>$dtres->uuid, 'hubspot_id'=>'', 'reponse'=>$reponse];
                    continue;
                }
            }
            if(!empty($dtres->company_uuid))
            {
                $entity_c = ServiceM8HubspotEntity::where(['object_type'=>'company', 'servicem8_id'=>$dtres->company_uuid])->first();
                if(!empty($entity_c) && $entity_c->count()>0)
                {
                    $companyID = $entity_c->hubspot_id;
                    if(!empty($dtres->active))
                    {
                        $HubspotAccountInfo->ContactToCompanyAssociation($contactID, $companyID);
                    }
                    else
                    {
                        $HubspotAccountInfo->archiveContactToCompanyAssociation($contactID, $companyID);
                    }
                }
            }
        }
        $return['status'] = true;
        $return['response'] = $tmp_res;
        return $return;
    }
}
