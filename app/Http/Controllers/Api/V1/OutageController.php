<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\OutageRequest;
use App\Http\Resources\Api\V1\OutageResource;
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
