<?php

use webvolant\abslider\Console;
use webvolant\abadmin\Http\Middleware;
use Illuminate\Support\Facades\View;

use webvolant\abslider\Models\Slider;

View::composer(array('abtemplate.index'),
    function($view)
    {
        $view->with('sliders', Slider::all());
    });

\Route::get('getSlides', function()
{
    return Slider::where('status','!=',0)->get();
});

//группа роутов админа
\Route::group(['prefix'=>'admin','middleware' => 'webvolant\abadmin\Http\Middleware\CheckRoleManager'], function() {

//Slider
\Route::get('slider/index', array('as'=>'slider/index','uses'=>'webvolant\abslider\Http\Controllers\SliderController@index'));
\Route::get('slider/add', array('as'=>'slider/add','uses'=>'webvolant\abslider\Http\Controllers\SliderController@add'));
\Route::post('slider/add', array('as'=>'slider/add','uses'=>'webvolant\abslider\Http\Controllers\SliderController@add'));

\Route::get('slider/edit/{link}', array('as'=>'slider/edit','uses'=>'webvolant\abslider\Http\Controllers\SliderController@edit'))->where('link', '[A-Za-z-0-9]+');
\Route::post('slider/edit/{link}', array('as'=>'slider/edit','uses'=>'webvolant\abslider\Http\Controllers\SliderController@edit'))->where('link', '[A-Za-z-0-9]+');

\Route::get('slider/delete/{link}', array('as'=>'slider/delete','uses'=>'webvolant\abslider\Http\Controllers\SliderController@delete'))->where('link', '[A-Za-z-0-9]+');

});

