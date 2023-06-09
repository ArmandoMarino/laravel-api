<?php

namespace Database\Seeders;
// MODELS
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use illuminate\support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        // Prende l'id dal controller type seleziona  l'id e poi lo trsaforma in un array (di id)
        $type_ids = Type::select('id')->pluck('id')->toArray();


        $technology_ids = Technology::select('id')->pluck('id')->toArray();

        for ($i = 0; $i < 30; $i++) {
            $project = new Project();

            // Assegnamo un id random preso dal $type_ids sopra e lo seediamo
            $project->type_id = Arr::random($type_ids);
            $project->title = $faker->text(20);
            $project->description = $faker->paragraphs(15, true);
            // $project->image = $faker->imageUrl(250, 250);
            $project->slug = Str::slug($project->title, '-');
            $project->is_published = $faker->boolean();

            $project->save();


            // Dopo aver salvato il Project nel DB genero a caso gli id relazionati con i projects
            $project_technologies = [];

            foreach ($technology_ids as $technology_id) {
                if ($faker->boolean()) $project_technologies[] = $technology_id;
            }

            $project->technologies()->attach($project_technologies);
        }
    }
}
