<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' =>true ]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/fillable','CrudeController@getOffers');


Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function(){
    Route::group(['prefix'=>'offers'],function(){
        // Route::get('store','CrudeController@store'); 
        Route::get('create','CrudeController@create');
        Route::post('store','CrudeController@store') -> name('offers.store');
        
        Route::get('edit/{offer_id}','CrudeController@editOffer'); 
        Route::post('update/{offer_id}','CrudeController@updateOffer') -> name('offers.update');
        Route::get('delete/{offer_id}','CrudeController@delete')->name('offer.delete');
        Route::get('all','CrudeController@getAllOffers')->name('Offer.all');
    });   
    
    Route::group(['prefix'=>'grades'],function(){
        Route::get('inserting','GradeController@insert');
        Route::post('saving','GradeController@save') -> name('grades.save');
        
        Route::get('show','GradeController@showGrades')->name('grade.all');
        Route::get('edit/{grade_id}','GradeController@editGrade') -> name('grade.edit');
        Route::post('update/{grade_id}','GradeController@updateGrade') -> name('grade.update');
        Route::get('delete/{grade_id}','GradeController@deleteGrade')->name('grade.delete');
    }); 
    Route::get('video','CrudeController@getVideo');
});

/** OTHER PAGES THAT SHOULD NOT BE LOCALIZED **/


