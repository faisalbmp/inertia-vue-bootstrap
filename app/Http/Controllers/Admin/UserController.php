<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()
            // ->filterBy($request)
            /* ->whereHas('roles', function (Builder $query) use ($roleIds) {
                $query->whereIn('id', $roleIds);
            }) */
            ->orderBy('created_at', 'DESC')
            ->paginate()
            ->withQueryString();
        return Inertia::render('Admin/Users/Index', ['users' => $users]);
    }
}