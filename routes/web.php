<?php

use Illuminate\Support\Facades\Route;
use TomatoPHP\TomatoSauce\Http\Controllers\ReportController;

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

Route::prefix('reports')->group(function() {
    Route::get('/', 'ReportsController@index');
});

Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('admin/reports/api', [ReportController::class, 'api'])->name('reports.api');
    Route::get('admin/reports/getJoins/api/{table}', [ReportController::class, 'getJoins'])->name('reports.getJoins.api');
    Route::get('admin/reports/getColumns/api/{table}', [ReportController::class, 'getColumns'])->name('reports.getColumns.api');
    Route::get('admin/reports/create', [ReportController::class, 'create'])->name('reports.create');
    Route::post('admin/reports', [ReportController::class, 'store'])->name('reports.store');
    Route::get('admin/reports/{model}', [ReportController::class, 'show'])->name('reports.show');
    //TODO: to use on update method
    // Route::get('admin/reports/{model}/edit', [ReportController::class, 'edit'])->name('reports.edit');
    // Route::post('admin/reports/{model}', [ReportController::class, 'update'])->name('reports.update');
    Route::delete('admin/reports/{model}', [ReportController::class, 'destroy'])->name('reports.destroy');
});
