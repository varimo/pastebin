@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-between">
    <form class="w-100 form-create-baste" action="{{ route('create_paste') }}" method="POST">
        @csrf
        <div class="d-flex flex-column">
            <span class="mb-4 fw-bold fs-5">New Paste</span>
            <textarea name="text" id="text" cols="30" rows="20"></textarea>
            @error('text')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <span class="mt-4">Optional Paste Settings</span>
            <div class="mt-2 mb-2">
                <label for="language" style="width: 200px; ">Syntax Highlighting:</label>
                <select name="language" id="language">
                    <option value="">None</option>
                    <option value="Bash">Bash</option>
                    <option value="C">C</option>
                    <option value="C#">C#</option>
                    <option value="C++">C++</option>
                    <option value="CSS">CSS</option>
                    <option value="HTML">HTML</option>
                    <option value="JSON">JSON</option>
                    <option value="Java">Java</option>
                    <option value="JavaScript">JavaScript</option>
                    <option value="Python">Python</option>
                    <option value="PHP">PHP</option>
                    <option value="Perl">Perl</option>
                    <option value="Ruby">Ruby</option>
                </select>
            </div>
            @error('text')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="mt-2 mb-2">
                <label for="term" style="width: 200px; ">Paste Expiration:</label>
                <select name="term" id="term">
                    <option value="">Never</option>
                    <option value="600">10 Minutes</option>
                    <option value="3600">1 Hour</option>
                    <option value="10800">3 Hour</option>
                    <option value="86400">1 Day</option>
                    <option value="604800">1 Week</option>
                    <option value="2592000">1 Month</option>
                </select>
            </div>
            @error('term')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="mt-2 mb-2">
                <label for="access" style="width: 200px; ">Paste Exposure:</label>
                <select name="access" id="access">
                    <option value="public">Public</option>
                    <option value="unlisted">Unlisted</option>
                    <option id="private-option" value="private"
                    @auth
                    @else
                        disabled
                    @endauth
                    >Private</option>
                </select>
            </div>
            @error('access')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="mt-2 mb-2">
                <label for="title" style="width: 200px; ">Paste Name / Title:</label>
                <input type="text" name="title" id="title">
            </div>
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <button type="submit" class="btn btn-primary mt-2 mb-2 ml-3" style="width: 197px; margin-left: 203px; ">Create New Paste</button>
            <div class="mt-2 mb-2" style="margin-left: 203px; ">
                <input type="checkbox" id="create_guest" name="create_guest" class="ml-6">
                <label for="create_guest">Paste as a guest </label>
            </div>
        </div>
    </form>
    @include('layouts.sidebar')
</div>
@endsection
