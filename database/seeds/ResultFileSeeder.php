<?php

/**
 * @file ResultFileSeeder.php
 */

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Vanderbilt;
use App\CellineDataset;

/**
 * @class ResultFileSeeder
 */
class ResultFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $fichier=file('./storage/Data/20161112 resultats vanderbilt et CIT.csv',FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES); //vanderbilt's settlement
        unset($fichier[0]);
        unset($fichier[1]);

        foreach ($fichier as $value) { //insertion of the data in vanderbilts table with duplicates (except 'UNS')
            $value=explode(';',$value);
            if (strpos($value[4], "UNS")===false){

                if (Vanderbilt::where([
                    ['class','=',$value[4]],
                    ['correlation','=',$value[5]],
                    ['pval','=',$value[6]]])->exists()){
                }

                else{
                    DB::table('vanderbilts')->insert([
                        'class'=>($value[4]),
                        'correlation'=>($value[5]),
                        'pval'=>($value[6]),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }

                $vanderbilt=Vanderbilt::where([
                ['class',$value[4]],
                ['correlation',($value[5])],
                ['pval',$value[6]],
                ])->first();
                
                $cellinedataset=CellineDataset::all();

                if ($cellinedataset->contains('file',$value[2])===false){ //verifies that the vanderbilt file is already existing in celline_dataset
                        DB::table('celline_dataset')->insert([
                        'file'=>($value[2]),
                    ]);
                }
                
                $cellinedataset=CellineDataset::where(
                    'file', $value[2])->first();

                $vanderbilt -> celline_dataset() -> save($cellinedataset, 'vanderbilt_id');
            }
        }
    }
}