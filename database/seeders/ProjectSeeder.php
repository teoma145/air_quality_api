<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $projects = config('db.projects');
            foreach ($projects as $project) {
            $new_project = new Project();
            $new_project->name = $project['name'];
            $new_project->description = $project['description'];
            $new_project->user_id = 1;
            $new_project->slug = Str::slug($project['name'], '-');
            $new_project->language = $project['language'];
            $new_project->image = ProjectSeeder::storeimage($project['image'], $project['name']);
            $new_project->save();
        }
    }
    public static function storeimage($img, $name)
    {
        //$url = 'https:' . $img;
        $url = $img;
        $contents = file_get_contents($url);
        // $temp_name = substr($url, strrpos($url, '/') + 1);
        // $name = substr($temp_name, 0, strpos($temp_name, '?')) . '.jpg';
        $name = Str::slug($name, '-') . '.jpg';
        $path = 'images/' . $name;
        Storage::put('images/' . $name, $contents);
        return $path;
    }
}
