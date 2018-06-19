<?php

use Illuminate\Database\Seeder;
use App\Level;
class YearLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 12 ; $i++) { 
            $level = new Level();
            $level->category = 'G';
            $level->level = $i;
            $level->save();
        }

        $level = new Level();
        $level->category = 'P';
        $level->level = 'Toddler';
        $level->save();

        $level1 = new Level();
        $level1->category = 'P';
        $level1->level = 'Nursery 1';
        $level1->save();

        $level2 = new Level();
        $level2->category = 'P';
        $level2->level = 'Nursery 2';
        $level2->save();

        $level3 = new Level();
        $level3->category = 'P';
        $level3->level = 'Kindergarten';
        $level3->save();

        $level4 = new Level();
        $level4->category = 'H';
        $level4->level = 1;
        $level4->save();

        $level11 = new Level();
        $level11->category = 'H';
        $level11->level = 2;
        $level11->save();

        $level22 = new Level();
        $level22->category = 'H';
        $level22->level = 3;
        $level22->save();

        $level33 = new Level();
        $level33->category = 'H';
        $level33->level = 4;
        $level33->save();

        $level34 = new Level();
        $level34->category = 'H';
        $level34->level = 5;
        $level34->save();
    }
}
