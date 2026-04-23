<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        // Obtener todos los usuarios de la base de datos
        // Para grandes cantidades de usuarios, considera usar paginación: User::paginate(10);
        $users = User::all();
        return view('welcome', compact('users'));
    }
}
