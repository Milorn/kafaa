<?php

namespace App\Http\Controllers;

use App\Models\ActivityArea;

class ViewDataController extends Controller
{
    public function activityAreas()
    {
        return ActivityArea::all();
    }
}
