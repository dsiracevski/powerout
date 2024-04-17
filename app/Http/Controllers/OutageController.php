<?php

namespace App\Http\Controllers;

use App\Http\Requests\OutageRequest;
use App\Http\Resources\OutageResource;
use App\Models\Outage;
use Illuminate\Http\JsonResponse;

class OutageController extends Controller
{
    public function index()
    {
        return OutageResource::collection(Outage::all()->load('location'));
    }

    public function store(OutageRequest $request): OutageResource
    {
        return new OutageResource(Outage::create($request->validated()));
    }

    public function show(Outage $outage): OutageResource
    {
        return new OutageResource($outage);
    }

    public function update(OutageRequest $request, Outage $outage)
    {
        $outage->update($request->validated());

        return new OutageResource($outage);
    }

    public function destroy(Outage $outage): JsonResponse
    {
        $outage->delete();

        return response()->json();
    }
}
