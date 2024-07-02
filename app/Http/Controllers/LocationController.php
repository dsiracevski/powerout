<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use Illuminate\Http\JsonResponse;

class LocationController extends Controller
{
    public function index()
    {
        return LocationResource::collection(Location::paginate());
    }

    public function store(LocationRequest $request): LocationResource
    {
        return new LocationResource(Location::create($request->validated()));
    }

    public function show(Location $location): LocationResource
    {
        return new LocationResource($location);
    }

    public function update(LocationRequest $request, Location $location): LocationResource
    {
        $location->update($request->validated());

        return new LocationResource($location);
    }

    public function destroy(Location $location): JsonResponse
    {
        $location->delete();

        return response()->json();
    }
}
