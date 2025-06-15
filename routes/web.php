<?php

use App\Http\Controllers\UploadController;
use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\Auth\ResetPage;
use App\Livewire\Pages\ContactPage;
use App\Livewire\Pages\Dashboard;
use App\Livewire\Pages\HomePage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

    Route::get('/', HomePage::class)->name('home');
    Route::get('/contact', ContactPage::class)->name('contact');

    Route::middleware(['auth'])->group(function(){
        Route::get('/dashboard', Dashboard::class)->name('dashboard');
    
    });
    
    //Auth
    Route::get('/login', LoginPage::class)->name('login');
    Route::get('/register', RegisterPage::class)->name('register');
    Route::get('/reset-password', ResetPage::class)->name('reset');

    Route::post('/post-login', function (Request $request) {
    
            $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (auth()->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
             toast("Login Successful", 'success');
        
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');

    })->name('post_login');

    Route::post('/post-register', function (Request $request) {
    
           $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'image' => UploadController::UploadFile($request),
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        auth()->login($user);

        toast("Account Created Successfully", 'success');

        return redirect('/dashboard');

    })->name('post_register');
