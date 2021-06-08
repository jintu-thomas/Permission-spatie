<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;




class PermissionController extends Controller
{
    public function SuperAdmin()
    {
        auth()->user()->assignRole('Super_Admin');
        auth()->user()->givePermissionTo('blog-read','blog-edit','blog-create','blog-delete','user-create','assign-permission');
        return "success";
    }
}
