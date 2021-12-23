<?php

namespace SnycEzy\ServiceM8_HubSpot;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use SnycEzy\ServiceM8_HubSpot\HubspotAccountInfo as ServiceM8_HubSpotHubspotAccountInfo;
use SnycEzy\ServiceM8_HubSpot\Servicem8AccountInfo as ServiceM8_HubSpotServicem8AccountInfo;

class SyncDetail extends Model
{
    use SoftDeletes;
    //
    protected $table = 'sync_detail';

    protected $fillable = [
        'name','first_party_name', 'first_party_id', 'second_party_name', 'second_party_id'
    ];

    function getfirstparty()
    {
        return ServiceM8_HubSpotServicem8AccountInfo::where(['id'=> $this->first_party_id])->first();
    }

    function getsecondparty()
    {
        return ServiceM8_HubSpotHubspotAccountInfo::where(['id'=> $this->second_party_id])->first();
    }
}
