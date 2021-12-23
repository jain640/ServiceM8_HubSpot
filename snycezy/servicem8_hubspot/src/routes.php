<?php

Route::get('calculator', function(){
	echo 'Hello from the calculator package!';
});
Route::get('syncezy', 'SnycEzy\ServiceM8_HubSpot\SyncEzyServiceM8HubSpotController@index')->name('syncezy.detail');
Route::post('syncezy/update-servicem8/{id}', 'SnycEzy\ServiceM8_HubSpot\SyncEzyServiceM8HubSpotController@update_first')->name('syncezy.update_servicem8');
Route::post('syncezy/update-hubspot/{id}', 'SnycEzy\ServiceM8_HubSpot\SyncEzyServiceM8HubSpotController@update_second')->name('syncezy.update_hubspot');

Route::get('syncezy/sync/{id}', 'SnycEzy\ServiceM8_HubSpot\SyncEzyServiceM8HubSpotController@sync')->name('syncezy.sync');
