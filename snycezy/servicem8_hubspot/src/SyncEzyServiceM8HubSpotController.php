<?php

namespace SnycEzy\ServiceM8_HubSpot;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SnycEzy\ServiceM8_HubSpot\HubspotAccountInfo as ServiceM8_HubSpotHubspotAccountInfo;
use SnycEzy\ServiceM8_HubSpot\Servicem8AccountInfo as ServiceM8_HubSpotServicem8AccountInfo;
use SnycEzy\ServiceM8_HubSpot\SyncDetail as ServiceM8_HubSpotSyncDetail;
use SnycEzy\ServiceM8_HubSpot\ServiceM8HubspotEntity as ServiceM8_HubSpotServiceM8HubspotEntity;


class SyncEzyServiceM8HubSpotController extends Controller
{
    //
    public function index()
    {
        ServiceM8_HubSpotSyncDetail::withTrashed()->where(['name' => 'ServiceM8 Integration HubSpot', 'first_party_name' => 'ServiceM8', 'second_party_name' => 'HubSpot'])->restore();
		$ServiceM8_HubSpotSyncDetail = ServiceM8_HubSpotSyncDetail::where(['name' => 'ServiceM8 Integration HubSpot', 'first_party_name' => 'ServiceM8', 'second_party_name' => 'HubSpot'])->first();
		if(empty($ServiceM8_HubSpotSyncDetail->id))
		{
			$ServiceM8_HubSpotSyncDetail = ServiceM8_HubSpotSyncDetail::create(['name' => 'ServiceM8 Integration HubSpot', 'first_party_name' => 'ServiceM8', 'first_party_id'=>'0', 'second_party_name' => 'HubSpot', 'second_party_id' => '0']);
		}

        $ServiceM8_HubSpotSyncDetail = ServiceM8_HubSpotSyncDetail::where(['name' => 'ServiceM8 Integration HubSpot', 'first_party_name' => 'ServiceM8', 'second_party_name' => 'HubSpot'])
        ->leftjoin('servicem8_account_info', 'sync_detail.first_party_id', '=', 'servicem8_account_info.id')
        ->leftjoin('hubspot_account_info','sync_detail.second_party_id','=','hubspot_account_info.id')
        ->select('servicem8_account_info.username', 'servicem8_account_info.password', 'sync_detail.*', 'hubspot_account_info.api_key')
        ->first();

        return view('servicem8hubspot::detail', ['syncdetail'=>$ServiceM8_HubSpotSyncDetail]);
    }

    public function update_first($id, Request $request)
    {
        $input = $request->input();

        $message = '';
        if(!empty($input['first_party_id']))
        {
            Servicem8AccountInfo::withTrashed()->where(['id' => $input['first_party_id']])->restore();
            $Servicem8AccountInfo = Servicem8AccountInfo::where(['id' => $input['first_party_id']])->first();
            if(!empty($Servicem8AccountInfo->id))
            {
                $Servicem8AccountInfo->update(['username'=>$input['username'], 'password' => $input['password']]);
                $message = 'ServiceM8 detail has been updated.';
            }
            else{
                $Servicem8AccountInfo = Servicem8AccountInfo::create(['username'=>$input['username'], 'password' => $input['password']]);

                ServiceM8_HubSpotSyncDetail::withTrashed()->where(['id' => $id])->restore();
                $ServiceM8_HubSpotSyncDetail = ServiceM8_HubSpotSyncDetail::where(['id' => $id])->first();
                if(!empty($ServiceM8_HubSpotSyncDetail->id))
                {
                    $ServiceM8_HubSpotSyncDetail->update(['first_party_id'=>$Servicem8AccountInfo->id]);
                }
                $message = 'ServiceM8 detail has been inserted.';
            }
        }
        else{
            $Servicem8AccountInfo = Servicem8AccountInfo::create(['username'=>$input['username'], 'password' => $input['password']]);

            ServiceM8_HubSpotSyncDetail::withTrashed()->where(['id' => $id])->restore();
            $ServiceM8_HubSpotSyncDetail = ServiceM8_HubSpotSyncDetail::where(['id' => $id])->first();
            if(!empty($ServiceM8_HubSpotSyncDetail->id))
            {
                $ServiceM8_HubSpotSyncDetail->update(['first_party_id'=>$Servicem8AccountInfo->id]);
            }
            $message = 'ServiceM8 detail has been updated.';

        }

        return redirect()->route('syncezy.detail')->with('success', $message);
        # code...
    }

    public function update_second($id, Request $request)
    {
        $input = $request->input();
        $message = '';
        if(!empty($input['second_party_id']))
        {
            ServiceM8_HubSpotHubspotAccountInfo::withTrashed()->where(['id' => $input['second_party_id']])->restore();
            $ServiceM8_HubSpotHubspotAccountInfo = ServiceM8_HubSpotHubspotAccountInfo::where(['id' => $input['second_party_id']])->first();
            if(!empty($ServiceM8_HubSpotHubspotAccountInfo->id))
            {
                $ServiceM8_HubSpotHubspotAccountInfo->update(['api_key'=>$input['api_key']]);
                $message = 'HubSpot detail has been updated.';
            }
            else{
                $ServiceM8_HubSpotHubspotAccountInfo = ServiceM8_HubSpotHubspotAccountInfo::create(['api_key'=>$input['api_key']]);

                ServiceM8_HubSpotSyncDetail::withTrashed()->where(['id' => $id])->restore();
                $ServiceM8_HubSpotSyncDetail = ServiceM8_HubSpotSyncDetail::where(['id' => $id])->first();
                if(!empty($ServiceM8_HubSpotSyncDetail->id))
                {
                    $ServiceM8_HubSpotSyncDetail->update(['second_party_id'=>$ServiceM8_HubSpotHubspotAccountInfo->id]);
                }
                $message = 'HubSpot detail has been created.';
            }
        }
        else
        {
            $ServiceM8_HubSpotHubspotAccountInfo = ServiceM8_HubSpotHubspotAccountInfo::create(['api_key'=>$input['api_key']]);

            ServiceM8_HubSpotSyncDetail::withTrashed()->where(['id' => $id])->restore();
            $ServiceM8_HubSpotSyncDetail = ServiceM8_HubSpotSyncDetail::where(['id' => $id])->first();
            if(!empty($ServiceM8_HubSpotSyncDetail->id))
            {
                $ServiceM8_HubSpotSyncDetail->update(['second_party_id'=>$ServiceM8_HubSpotHubspotAccountInfo->id]);
            }
            $message = 'HubSpot detail has been updated.';
        }


        return redirect()->route('syncezy.detail')->with('success', $message);
        # code...
    }
     public function sync($id, Request $request){

        $ServiceM8_HubSpotSyncDetail = ServiceM8_HubSpotSyncDetail::where(['id' => $id])->first();

        $Servicem8AccountInfo = ServiceM8_HubSpotServicem8AccountInfo::where(['id' => $ServiceM8_HubSpotSyncDetail->first_party_id])->first();

        $HubspotAccountInfo = ServiceM8_HubSpotHubspotAccountInfo::where(['id' => $ServiceM8_HubSpotSyncDetail->second_party_id])->first();

        $EntityInfo = new ServiceM8_HubSpotServiceM8HubspotEntity();

        $data = $Servicem8AccountInfo->getCompanyFromServicem8();
        if(!empty($data['status']))
        {
            $data = $EntityInfo->SyncCompanyToHubspot($data['response'], $HubspotAccountInfo);
        }


        $data = $Servicem8AccountInfo->getCompanyContactFromServicem8();

        if(!empty($data['status']))
        {
            $data = $EntityInfo->SyncContactToHubspot($data['response'], $HubspotAccountInfo);
        }
        return redirect()->route('syncezy.detail')->with('success', 'Record has been synced form ServiceM8 to Hubspot');
     }
}
