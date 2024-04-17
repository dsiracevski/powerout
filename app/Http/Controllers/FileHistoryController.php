<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileHistoryRequest;
use App\Models\FileHistory;

class FileHistoryController extends Controller
{
    public function index()
    {
        return FileHistory::all();
    }

    public function store(FileHistoryRequest $request)
    {
        return FileHistory::create($request->validated());
    }

    public function show(FileHistory $fileHistory)
    {
        return $fileHistory;
    }

    public function update(FileHistoryRequest $request, FileHistory $fileHistory)
    {
        $fileHistory->update($request->validated());

        return $fileHistory;
    }

    public function destroy(FileHistory $fileHistory)
    {
        $fileHistory->delete();

        return response()->json();
    }
}
