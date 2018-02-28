<?php

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use App\Celline;
use App\Dataset;

class CelDatasetLigneeFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cellines = Celline::all();
        $datasets = Dataset::all();

        $fichier=file('./storage/Data/cel_dataset_lignee.txt');
        unset($fichier[0]);

        foreach ($fichier as $value) {
            $value=explode("\t",$value);

            $datasets= Dataset::firstOrNew(['name'=>$value[0]]);
            //$datasets= save();

            $cellines= Celline::firstOrNew(['name'=>$value[2]]);
            //$cellines=save();

    
            $dataset=Dataset::where('name',$value[0])->get();
            $celline=Celline::where('name',$value[2])->get();
            $filename=$value[1];

           
            $dataset -> cellines() -> attach($celline -> id, [
            "file" => $filename]);
        }


    }

}
