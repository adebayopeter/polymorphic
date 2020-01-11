<?php

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

use App\Staff;
use App\Photo;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create/{staff_id}', function($staff_id) {

    $staff = Staff::find($staff_id);

    $staff->photos()->create(['path' => 'staff'.$staff_id.'.jpg']);

});


Route::get('/read/{staff_id}', function($staff_id) {

    $staff = Staff::findOrFail($staff_id);

    foreach($staff->photos as $photo) {
        
        echo $photo->path;

    }

});

Route::get('/update/{staff_id}', function($staff_id) {

    $staff = Staff::findOrFail(1);

    $photo = $staff->photos()->whereId(1)->first();

    $photo->path = "Updated_image.jpg";

    $photo->save();

});

Route::get('/delete/{staff_id}', function($staff_id) {

    $staff = Staff::findOrFail($staff_id);

    $staff->photos()->whereId($staff_id)->delete();

});

Route::get('/assign', function(){

    $staff = Staff::findOrFail(1);

    $photo = Photo::findOrFail(4);

    $staff->photos()->save($photo);

});

Route::get('/un-assign', function(){

    $staff = Staff::findOrFail(1);

    $staff->photos()->whereId(4)->update(['imageable_id' => '', 'imageable_type' => '']);
});