<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePasteRequest;
use App\Models\User;
use App\Models\Paste;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PasteController extends Controller
{
    /**
     * Show pastes.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $private_paste = null;
        if (Auth::check()) {
            $user = Auth::user()->id;
            $private_paste = Paste::where('user_id', $user)->where(function($query) {
                $query->whereNull('term')->orWhere('created_at', '>=', DB::raw('NOW() - INTERVAL `term` SECOND'));
            })->take(10)->orderBy('created_at', 'desc')->get();
        }

        $public_paste = Paste::where('access', 'public')->where(function($query) {
            $query->whereNull('term')->orWhere('created_at', '>=', DB::raw('NOW() - INTERVAL `term` SECOND'));
        })->take(10)->orderBy('created_at', 'desc')->get();
        return view('welcome', ['public_paste' => $public_paste, 'private_paste' => $private_paste]);
    }

    /**
     * Show specific paste.
     *
     * @param  string  $url
     * @return \Illuminate\View\View
     */
    public function show($url)
    {
        $single_paste = Paste::where('url', $url)->first();
        if(is_null($single_paste) || (!is_null($single_paste->term) && Carbon::parse( $single_paste->created_at )->addSecond($single_paste->term) < Carbon::now() )) {
            return abort(404);
        }
        if (!is_null($single_paste->user_id)) {
            $single_paste->name = $single_paste->user->name;
        }
        $private_paste = null;
        if (Auth::check()) {
            $user = Auth::user()->id;
            $private_paste = Paste::where('user_id', $user)->where(function($query) {
                $query->whereNull('term')->orWhere('created_at', '>=', DB::raw('NOW() - INTERVAL `term` SECOND'));
            })->take(10)->orderBy('created_at', 'desc')->get();
        }

        $public_paste = Paste::where('access', 'public')->where(function($query) {
            $query->whereNull('term')->orWhere('created_at', '>=', DB::raw('NOW() - INTERVAL `term` SECOND'));
        })->take(10)->orderBy('created_at', 'desc')->get();
        return view('paste', ['single_paste' => $single_paste, 'public_paste' => $public_paste, 'private_paste' => $private_paste]);
    }

    /**
     * Create paste.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePasteRequest $request)
    {
        $validated = $request->validated();
        if ($validated['title'] == null) {
            $validated['title'] = 'Untitled';
        }
        $url = md5($validated['title'] . $validated['text'] . now());
        if (Auth::check() && !$request->scalcreate_guestes) {
            $user = Auth::user()->id;
            $validated['user_id'] = $user;
        }
        $validated['url'] = $url;
        $paste = Paste::create($validated);
        if ($paste) {
            return redirect()->action(
                [PasteController::class, 'show'], ['url' => $url]
            );
        }
        return view('welcome');
    }
}

