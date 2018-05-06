<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Animal extends Model
{

    use SoftDeletes;

    protected $fillable = ['id', 'animal_id', 'animal_subid', 'animal_area_pkid', 'animal_shelter_pkid'
        , 'animal_place', 'animal_kind', 'animal_sex', 'animal_bodytype', 'animal_colour', 'animal_age'
        , 'animal_sterilization', 'animal_bacterin', 'animal_foundplace', 'animal_title', 'animal_remark'
        , 'animal_status', 'animal_opendate', 'animal_closeddate', 'animal_update', 'animal_createtime'
        , 'shelter_name', 'album_file', 'shelter_address', 'shelter_tel'];

    protected $dates = ['deleted_at'];

    public static $rules = [
        // Validation rules
    ];

    // Relationships

}
