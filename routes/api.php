<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProviderUserController;


Route::get('/users', [ProviderUserController::class, 'index'])->name('provider.users.index');
