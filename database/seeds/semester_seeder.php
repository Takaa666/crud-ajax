<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class semester_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('semester')->insert([
            'semester' => 'RPL',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => 1,
        ]);
    }
}
