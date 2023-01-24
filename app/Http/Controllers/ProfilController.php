<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paste;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfilController extends Controller
{
    /**
     * Show profil.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user()->id;
            $pastes = Paste::where('user_id', $user)->where(function($query) {
                $query->whereNull('term')->orWhere('created_at', '>=', DB::raw('NOW() - INTERVAL `term` SECOND'));
            })->paginate(4);

            $private_paste = Paste::where('user_id', $user)->where(function($query) {
                $query->whereNull('term')->orWhere('created_at', '>=', DB::raw('NOW() - INTERVAL `term` SECOND'));
            })->take(10)->orderBy('created_at', 'desc')->get();

            $public_paste = Paste::where('access', 'public')->where(function($query) {
                $query->whereNull('term')->orWhere('created_at', '>=', DB::raw('NOW() - INTERVAL `term` SECOND'));
            })->take(10)->orderBy('created_at', 'desc')->get();

            return view('profil', [ 'pastes' => $pastes, 'public_paste' => $public_paste, 'private_paste' => $private_paste ]);
        }

        return view('welcome');
    }
}
