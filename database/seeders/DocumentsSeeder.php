<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('required_documents')->insert([
            [
                'document_name' => 'A2 Form',
            ],
            [
                'document_name' => 'PAN',
            ],
            [
                'document_name' => 'Passport',
            ],
            [
                'document_name' => 'Visa',
            ],
            [
                'document_name' => 'FEMA Declaration',
            ],
            [
                'document_name' => 'Offer Letter',
            ]
        ]);
    }
}
