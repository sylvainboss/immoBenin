<?php

namespace App\Http\Controllers;

use App\Models\Biens;
use App\Models\Contact;
use App\Models\Types;
use App\Models\User;
use App\Models\Ville;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        // Récupération de tous les utilisateurs sauf les admins
        $users = User::where('role', '!=', 'controller')->where('admin', false)->paginate(10);

        // Calcul du nombre total de tous les utilisateurs
        $totalOwner = User::where('role', 'owner')->count();

        // Calcul du nombre total d'annonces
        $totalAnnonces = Biens::count();

        // Calcul du nombre d'utilisateurs ayant pour rôle "controller"
        $totalControllers = User::where('role', 'controller')->count();

        // Passer les données à la vue
        return view('admin.index', compact('users', 'totalOwner', 'totalAnnonces', 'totalControllers'));
    }

    public function viewUser(string $id)
    {
        $user = User::findOrfail($id);
        return view('admin.viewUser', compact('user'));
    }

    public function allProperties()
    {
        $villes = Ville::all();
        $types = Types::all();
        return view('admin.allproperies', [
            'properties' => Biens::orderBy('created_at', 'desc')->paginate(6),
            'villes' => $villes,
            'types' => $types
        ]);
    }

    public function viewProperty(string $id)
    {
        // Récupération de l'annonce avec les détails du bien immobilier
        $property = Biens::findOrFail($id);

        // Si vous avez besoin de données supplémentaires comme les villes et types pour les sélections ou informations liées, vous pouvez les ajouter ici
        $villes = Ville::all(); // Exemple si vous avez une table Ville pour afficher des informations de ville
        $types = Types::all();  // Exemple si vous avez une table Type pour afficher des informations de type

        // Retourner la vue avec les données nécessaires
        return view('admin.viewProperty', compact('property', 'villes', 'types'));
    }


    public function publishProperty(Request $request, $id)
    {
        $property = Biens::findOrFail($id);

        // Mise à jour des informations du bien
        $property->update($request->except('action'));

        // Vérification si l'action est "publish"
        if ($request->action == 'publish') {
            $property->accept = true;
            $property->save();
        }

        return redirect()->route('dashboard.properties', $property->id)->with('success', 'L\'annonce a bien été publiée');
    }

    public function setting()
    {
        $user = Auth::user();
        return view('admin.settings', compact('user'));
    }

    public function controller()
    {
        $users = User::where('role', 'controller')->paginate(10);
        return view('admin.controller', compact('users'));
    }

    public function controller_create()
    {
        if (!Gate::allows('acces-admin') && Gate::allows('access-owner')) {
            abort(403);
        }
        return view('admin.controller_create');
    }

    public function create_controler(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'controller',
            'admin' => 1
        ]);

        event(new Registered($user));
        return redirect()->back()->with('success', 'controller crée avec succès');
    }

    public function contact(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'message' => ['required', 'string'],
        ]);
        $contact = Contact::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message
        ]);
        return redirect()->back()->with('success', 'Votre message est correctement envoyé');
    }

    public function getContact(){
        $contacts = Contact::orderBy('created_at','desc')->paginate(16);
        return view('admin.contact',compact('contacts'));
    }
}
