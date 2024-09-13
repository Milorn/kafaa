<?php

namespace App\Http\Controllers;

use App\Models\ActivityArea;
use App\Models\Wilaya;

class ViewDataController extends Controller
{
    public function activityAreas()
    {
        return ActivityArea::all();
    }

    public function wilayas()
    {
        return Wilaya::all();
    }
}
