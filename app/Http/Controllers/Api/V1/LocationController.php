<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LocationRequest;
use App\Http\Resources\Api\V1\LocationResource;
use App\Models\Location;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LocationController extends Controller
{
    public function index(): AnonymousResourceCollection
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
