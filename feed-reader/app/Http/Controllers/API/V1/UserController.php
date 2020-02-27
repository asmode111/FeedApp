<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserEmailRequest;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function getByEmail(UserEmailRequest $request)
    {
        $validated = $request->validated();

        return response()->json([
            'isSuccess' => true,
        ]);
    }
}
