<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class CrawlerController extends Controller
{
    public function update()
    {
        $this->updateData();
        $this->removeOldData();
    }

    public function updateData()
    {
        $skip = 0;
        do {
            $dataArray = $this->fetchOpenData($skip);
            foreach ($dataArray as &$value) {
                $animal = \App\Animal::updateOrCreate([
                    'id' => $value['animal_shelter_pkid'] . $value['animal_id'],
                ], [
                    'animal_id' => $value['animal_id'],
                    'animal_subid' => $value['animal_subid'],
                    'animal_area_pkid' => $value['animal_area_pkid'],
                    'animal_shelter_pkid' => $value['animal_shelter_pkid'],
                    'animal_place' => $value['animal_place'],
                    'animal_kind' => $value['animal_kind'],
                    'animal_sex' => $value['animal_sex'],
                    'animal_bodytype' => $value['animal_bodytype'],
                    'animal_colour' => $value['animal_colour'],
                    'animal_age' => $value['animal_age'],
                    'animal_sterilization' => $value['animal_sterilization'],
                    'animal_bacterin' => $value['animal_bacterin'],
                    'animal_foundplace' => $value['animal_foundplace'],
                    'animal_title' => $value['animal_title'],
                    'animal_remark' => $value['animal_remark'],
                    'animal_status' => $value['animal_status'],
                    'animal_opendate' => $value['animal_opendate'],
                    'animal_closeddate' => $value['animal_closeddate'],
                    'animal_update' => $value['animal_update'],
                    'animal_createtime' => $value['animal_createtime'],
                    'shelter_name' => $value['shelter_name'],
                    'album_file' => $value['album_file'],
                    'shelter_address' => $value['shelter_address'],
                    'shelter_tel' => $value['shelter_tel'],
                ]);
            }

            $skip += 100;
        } while (sizeof($dataArray) > 0);
    }

    public function removeOldData()
    {
        $expiredAnimals = \App\Animal::whereDate('updated_at', '<=', Carbon::now()->subDays(1)->toDateTimeString())->get();

        foreach ($expiredAnimals as &$animal) {
            $animal->forceDelete();
        }
    }

    /**
     * @return Array opendata
     */
    public function fetchOpenData($skip)
    {
        $url = 'http://data.coa.gov.tw/Service/OpenData/AnimalOpenData.aspx?$top=100&$skip=' . $skip;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $output = curl_exec($ch);
        curl_close($ch);

        $array = json_decode($output, true);

        return $array;
    }
}
