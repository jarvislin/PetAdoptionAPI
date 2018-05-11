<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnimalsController extends Controller
{

    const MODEL = "App\Animal";

    use RESTActions;

    public function all(Request $request)
    {
        $offset = $request->query('offset') ?: 0;
        $field = $request->query('order_by') ?: 'animal_update';
        $sort = $request->query('sort') ?: 'desc';

        $animals = DB::select("select * from animals order by $field $sort limit 40 offset $offset;");

        return $this->respond('done', $animals);
    }

}
