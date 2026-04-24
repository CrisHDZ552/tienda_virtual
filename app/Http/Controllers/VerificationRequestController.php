<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VerificationRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\AdminVerificationRequest;
use App\Notifications\UserVerificationReviewed;

class VerificationRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = VerificationRequest::with('user');

        // Búsqueda por nombre o correo electrónico
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        // Filtro por estado
        if ($request->filled('status')) {
            $status = $request->status;
            if ($status === 'pending') {
                $query->whereNull('status');
            } elseif ($status === 'accepted') {
                $query->where('status', 1);
            } elseif ($status === 'rejected') {
                $query->where('status', 0);
            }
        }

        $requests = $query->latest()->paginate(10);

        return view('request.verificar_solicitud', compact('requests'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reason' => 'required|string|max:1000',
        ]);

        // Comprobar si el usuario ya tiene una solicitud pendiente
        $existingRequest = VerificationRequest::where('user_id', Auth::id())
            ->whereNull('status')
            ->first();

        if ($existingRequest) {
            return back()->with('error', 'Ya tienes una solicitud de verificación pendiente de respuesta.');
        }

        // Crear la nueva solicitud
        VerificationRequest::create([
            'user_id' => Auth::id(),
            'reason' => $request->reason,
            // status es null por defecto como se define en la migración
        ]);

        // Notificar a todos los administradores
        $admins = User::role('admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new AdminVerificationRequest(Auth::user()->name));
        }

        return back()->with('status', 'Tu solicitud de verificación ha sido enviada con éxito y está en revisión.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:0,1',
        ]);

        $verificationRequest = VerificationRequest::findOrFail($id);
        $verificationRequest->status = $request->status;
        $verificationRequest->save();

        // Si la solicitud es aceptada, cambiar de rol
        if ($request->status == 1) {
            $user = $verificationRequest->user;
            // Remueve el rol actual de vendedor
            $user->removeRole('vendedor');
            // Asigna el nuevo rol de verificado
            $user->assignRole('verificado');
        }

        // Notificar al usuario que solicitó la verificación
        $verificationRequest->user->notify(new UserVerificationReviewed($request->status));

        $message = $request->status == 1 ? 'Solicitud aceptada. El usuario ahora es verificado.' : 'Solicitud rechazada.';
        return back()->with('status', $message);
    }
}