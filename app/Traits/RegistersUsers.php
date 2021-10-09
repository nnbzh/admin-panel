<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

trait RegistersUsers
{
    /**
     * Handle a registration request for the application.
     *
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function register(Request $request)
    {
        if ($request->user()->cannot('manage', User::class)) {
            abort(403);
        }

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        event(new Registered($user = $this->create($request->all())));

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectTo);
    }
}
