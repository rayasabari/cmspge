<?php

namespace Database\Seeders;

use App\Models\ElementType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ElementTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $elements = [
            [
                'slug' => 'text-heading',
                'name' => 'Text Heading'
            ],
            [
                'slug' => 'text-editor',
                'name' => 'Text Editor'
            ],
            [
                'slug' => 'collections',
                'name' => 'Collections'
            ],
            [
                'slug' => 'image',
                'name' => 'Image',
            ],
            [
                'slug' => 'google-maps',
                'name' => 'Google Maps',
            ],
            [
                'slug' => 'external-link',
                'name' => 'Eksternal Link',
            ]
        ];
        ElementType::insert($elements);
    }
}
