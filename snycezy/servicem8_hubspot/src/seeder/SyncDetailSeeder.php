<?php

namespace SnycEzy\ServiceM8_HubSpot;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class SyncDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('sync_detail')->insert([
            'name' => 'ServiceM8 Integration HubSpot',
            'first_party_name' => 'ServiceM8',
            'second_party_name' => 'HubSpot',
        ]);
    }
}
