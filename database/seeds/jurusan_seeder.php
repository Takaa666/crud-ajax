<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class jurusan_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jurusan')->insert([
            'jurusan' => 'RPL',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => 1,
        ]);
    }
}
