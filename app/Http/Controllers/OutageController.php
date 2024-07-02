<?php

namespace App\Http\Controllers;

use App\Http\Requests\OutageRequest;
use App\Http\Resources\OutageResource;
use App\Models\Outage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OutageController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return OutageResource::collection(Outage::with('location')->paginate());
    }

    public function store(OutageRequest $request): OutageResource
    {
        return new OutageResource(Outage::create($request->validated()));
    }

    public function show(Outage $outage): OutageResource
    {
        return new OutageResource($outage->load('location'));
    }

    public function update(OutageRequest $request, Outage $outage): OutageResource
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
