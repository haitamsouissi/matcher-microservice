<?php

namespace App\Http\Controllers;

use App\Http\Resources\Match as ResourcesProperty;
use App\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        return new ResourcesProperty($property);
    }

}
