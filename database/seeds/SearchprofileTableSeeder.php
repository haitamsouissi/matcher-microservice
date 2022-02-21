<?php

use App\SearchProfile;
use Illuminate\Database\Seeder;

class SearchprofileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(SearchProfile::class, 100)->create();
    }
}
