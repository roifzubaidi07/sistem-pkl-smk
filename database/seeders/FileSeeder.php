<?php

namespace Database\Seeders;

use App\Models\File;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        File::create([
            'name' => 'Surat Bimbingan & Monitoring',
            'filename' => 'Template-laporan-bimbingan.docx',
            'is_pembimbing' => true,
            'header' => 'Content-Type: application/msword',
        ]);
        File::create([
            'name' => 'Panduan PKL',
            'filename' => 'Panduan.docx',
            'is_pembimbing' => false,
            'header' => 'Content-Type: application/msword',
        ]);
        File::create([
            'name' => 'Template Laporan PKL',
            'filename' => 'Template-laporan.docx',
            'is_pembimbing' => false,
            'header' => 'Content-Type: application/msword',
        ]);
    }
}
