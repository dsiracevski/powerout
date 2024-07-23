<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    use ApiResponses;
    public function __invoke(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->ok('');
    }
}
