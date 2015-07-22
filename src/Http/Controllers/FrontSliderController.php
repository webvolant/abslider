<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 24.06.15
 * Time: 14:17
 */

namespace webvolant\abslider\Http\Controllers;

use App\Http\Controllers\Controller;
use \View;
use \Request;
use webvolant\abslider\Models\Slider;


class FrontSliderController extends Controller {

    public function index()
    {
        $items = Slider::all();
        return view('abslider::frontend.slider',array('sliders' => $items));
    }


} 