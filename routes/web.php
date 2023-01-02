<?php

use App\Http\Livewire\clientComp;
use App\Http\Livewire\LocationComp;
use App\Http\Livewire\VoitureComp;
use App\Http\Livewire\TypeVoitureComp;
use App\Http\Livewire\Utilisateurs;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(["middleware"=>["auth","auth.admin"],
            "as"=> "admin."],
            function(){
                Route::group(["prefix"=>"habilitations",
                "as"=>"habilitations."
            ],function(){
                Route::get('/utilisateurs', Utilisateurs::class)->name("users.index");
 
            });

            Route::group(["prefix"=>"gestvoitures",
            "as"=>"gestvoitures."
        ],function(){
            Route::get('/types', TypeVoitureComp::class)->name("types");
            Route::get('/voitures', VoitureComp::class)->name("voitures");
        });
});

Route::group([
    "middleware" => ["auth", "auth.employe"],
    'as' => 'employe.'
], function(){
    Route::get("/clients", ClientComp::class)->name("clients.index");
});
Route::group([
    "middleware" => ["auth", "auth.employe"],
    'as' => 'employe.'
], function(){
    Route::get("/locations", LocationComp::class)->name("locations.index");
});



