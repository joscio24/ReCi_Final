
<?php

use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
// use Illuminate\Support\Facades\Request;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\PostCardController;
use App\Events\Typing;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\DebatController;
use App\Http\Controllers\Auth\GoogleController;

use App\Http\Controllers\Auth\AuthController;

Broadcast::routes(['middleware' => ['web', 'auth']]);
 // Use 'auth' if not using Sanctum

// Add this to your routes/web.php
Auth::routes();


Route::get('/', [HomeController::class, 'index'])->name('accueil');

// Route::middleware('guest')->group(function () {
//     Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
//     Route::post('login', [LoginController::class, 'login']);

//     Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
//     Route::post('register', [RegisterController::class, 'register']);
// });




Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route::get('/otp-verification', function(){
//     return view('auth.otp-verification');
// })->name('otp.verify.form');

// Route::post('/otp-verify', [App\Http\Controllers\OTPVerificationController::class, 'verifyOTP'])->name('otp.verify');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/test-openai', function () {
    $response = Http::withToken(env('OPENAI_API_KEY'))->get('https://api.openai.com/v1/models');

    return $response->json(); // Devrait afficher la liste des modèles
});

Route::get('auth/google', function () {
    return Socialite::driver('google')->redirect();
})->name('google.login');
// Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);
Route::get('/email/verify/{token}', [GoogleController::class, 'verifyEmail'])->name('email.verify');
Route::get('/verify-email/{token}', function($token){
    $user = User::where('verification_token', $token)->first();

    if (!$user) {
        return redirect('/login')->with('error', 'Lien de vérification invalide ou expiré.');
    }

    $user->update([
        'email_verified_at' => now(),
        'verification_token' => null
    ]);

    Auth::login($user);

    return redirect('/')->with('success', 'Votre e-mail a été vérifié avec succès !');
});

Route::get('/search', [App\Http\Controllers\DebateController::class, 'search'])->name('search.debates');


Route::get('/otp/verify', [LoginController::class, 'showOtpForm'])->name('otp.verify.form');
Route::post('/otp/verify', [LoginController::class, 'verifyOtp'])->name('otp.verify');
Route::post('/otp-resend', [LoginController::class, 'resendOtp'])->name('otp.resend');


// Password Recovery
Route::get('/password/forgot', [LoginController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/password/forgot', [LoginController::class, 'sendResetOtp'])->name('password.email');

Route::get('/password/verify-otp', [LoginController::class, 'showResetOtpForm'])->name('password.otp.form');
Route::post('/password/verify-otp', [LoginController::class, 'verifyResetOtp'])->name('password.otp.verify');

Route::get('/password/reset', [LoginController::class, 'showResetForm'])->name('password.reset.form');
Route::post('/password/reset', [LoginController::class, 'resetPassword'])->name('password.update');




Route::middleware(['auth'])->group(function () {
    Route::post('/post-cards/{postCard}/messages', [MessageController::class, 'store'])->name('messages.store');

    Route::post('/post-cards/{postCard}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/comment/{id}/like', [CommentController::class, 'likeComment'])->middleware('auth');
    Route::post('/comment/{id}/unlike', [CommentController::class, 'unlikeComment'])->middleware('auth');
    Route::post('/comment/{id}/reply', [CommentController::class, 'reply'])->middleware('auth');

    Route::post('/debats/{id_debat}/votes', [VoteController::class, 'store']);

});
    Route::get('/profile', function () {
        return view('welcome');
    })->name('profile');
    // route to index page

    Route::get('/accueil', [HomeController::class, 'index']);
    Route::get('/sante', [HomeController::class, 'sante']);
    Route::get('/relations_internationales', [HomeController::class, 'relationInter']);
    Route::get('/education', [HomeController::class, 'education']);
    Route::get('/economie', [HomeController::class, 'economie']);
    Route::get('/politique', [HomeController::class, 'politiques']);
    Route::get('/justice', [HomeController::class, 'justice']);
    Route::get('/securite_et_defense', [HomeController::class, 'securite_et_defense']);
    Route::get('/technologie', [HomeController::class, 'technologie']);
    Route::get('/environment', [HomeController::class, 'environment']);
    Route::get('/droits', [HomeController::class, 'droits']);
    Route::get('/debats', [HomeController::class, 'debats']);

    Route::get('/debat/{id}/{slug}', [HomeController::class, 'debat'])->name('debat');

    Route::get('/post-cards/{postCard}/messages', [MessageController::class, 'index']);

    Route::post('/post_card/store', [PostCardController::class, 'store'])->name('post_card.store');

    Route::post('/debats/store', [DebatController::class, 'store'])->name('debats.store');

    Route::post('/broadcasting/auth', function () {
        return Auth::user();
    });

    Route::get('/typing/{debatId}', [MessageController::class, 'typing'])->name('typing.broadcast');

