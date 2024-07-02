<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Http\Resources\LocationResource;
use App\Models\Location;

class LocationController extends Controller
{
    public function index()
    {
        return LocationResource::collection(Location::has('activeOutages')->get()->load('activeOutages'));
    }

    public function store(LocationRequest $request)
    {
        return new LocationResource(Location::create($request->validated()));
    }

    public function show(Location $location)
    {
        return new LocationResource($location);
    }

    public function update(LocationRequest $request, Location $location)
    {
        $location->update($request->validated());

        return new LocationResource($location);
    }

    public function destroy(Location $location)
    {
        $location->delete();

        return response()->json();
    }
}
