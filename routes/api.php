<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\CourseLecture;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/lectures/by-course/{id}', function ($id) {
    return CourseLecture::where('course_id', $id)
        ->select('id', 'lecture_title') // ✅ THIS IS IMPORTANT
        ->get();
});
