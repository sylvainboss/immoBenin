<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Biens;
use App\Models\Notifications;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{


    public function index()
    {
        $totalAnnonce = Biens::where('userid',Auth::user()->id)->count();
        return view('profile.index',compact('totalAnnonce'));
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function upload_avatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Limite de 2 Mo
        ]);
        $user = Auth::user();
        // Suppression de l'avatar existant s'il y en a un
        if ($user->picture) {
            Storage::delete('public/' . $user->avatar); // Chemin public pour les avatars
        }
        // Stockage du nouvel avatar
        $path = $request->file('avatar')->store('avatars', 'public'); // Stocke dans 'storage/app/public/avatars'

        $user->picture = $path;
        $user->save();

        // Redirection avec un message de succès
        return redirect()->back()->with('success', 'Avatar mis à jour avec succès.');
    }

    public function completeProfile(Request $request)
    {
        $request->validate([
            'telephone' => 'nullable|string|max:15',
            'adresse' => 'nullable|string|max:255',
            'ville' => 'nullable|string|max:100',
            'profession' => 'nullable|string|max:100',
            'identite' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();

        // Mettre à jour les champs texte
        $user->telephone = $request->input('telephone');
        $user->adresse = $request->input('adresse');
        $user->ville = $request->input('ville');
        $user->profession = $request->input('profession');

        // Upload du document d'identité
        if ($request->hasFile('indentite')) {
            if ($user->identite) {
                Storage::delete('public/' . $user->indentite);
            }

            $identitePath = $request->file('indentite')->store('identites', 'public');
            $user->indentite = $identitePath;
        }

        $user->save();

        return back()->with('status', 'Profil complété avec succès');
    }
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function ownerProperties()
    {
        // Vérifie si un utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour accéder à cette page.');
        }

        $userId = Auth::id();

        // Requête pour récupérer les propriétés avec les relations nécessaires
        $properties = Biens::with(['type', 'ville']) // Remplacez "vile" par "ville" si c'est le bon nom de la relation
            ->where('userid', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('profile.properties', compact('properties'));
    }

    public function getNotifications()
    {
        $user = Auth::user();
        $notifications = Notifications::orderBy('created_at','desc')->where('userid',$user->id)->paginate(10);
        return view('profile.notification',compact('notifications'));
    }

  
    public function becomeOwner()
    {
        // Récupérer l'utilisateur actuellement connecté
        $user = Auth::user();

        // Vérifier si les champs 'indentite' et 'telephone' sont remplis
        if ($user->indentite && $user->telephone) {
            // Si les deux champs sont remplis, mettre à jour le rôle de l'utilisateur
            $user->role = 'owner';
            $user->save();

            // Optionnel : Vous pouvez envoyer un message de succès à l'utilisateur
            return redirect()->route('profile')->with('success', 'Félicitations, vous êtes maintenant un propriétaire!');
        } else {
            // Si l'un des champs est manquant, rediriger l'utilisateur pour compléter son profil
            return redirect()->route('profile.edit')->with('error', 'Veuillez compléter votre profil avant de devenir propriétaire.');
        }
    }

    

    public function markAsRead(string $id) {
        $notifications = Notifications::findOrfail($id);
        if (!$notifications) {
            return redirect()->back()->with('error', 'Votre message est correctement envoyé');
        }
        $notifications->read = true;
        $notifications->save();
        return redirect()->back();
    }

    public function deleteNotification (string $id){
        $notifications = Notifications::findOrafail($id);
        if (!$notifications) {
            return redirect()->back()->with('error', 'Votre message est correctement envoyé');
        }

        $notifications->delete();
    }
}
