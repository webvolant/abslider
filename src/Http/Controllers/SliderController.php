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
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class SliderController extends Controller {

    public function index()
    {
        $items = Slider::all();
        return view('abslider::backend.index',array('sliders' => $items));
    }

    public function add()
    {
        if (\Request::all()){
            $validator = \Validator::make(\Request::all(), [
                /*'email' => array('required','unique:users,email'),
                'name' => 'required',
                'password' => array('required','confirmed'),
                'password_confirmation' => array('required'),
                'role' => 'required',
                'status' => 'required',*/
                'logo'=>array('mimes:jpeg,jpg,png,bmp,gif,svg'),
            ]);

            if ($validator->fails()) {
                return \Redirect::route('slider/add')->withErrors($validator)->withInput();
            }
            else{
                //dd(\Request::all());
                $item = new Slider();

                foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties):
                    $title_lang = "title_$localeCode";
                    $description_lang = "description_$localeCode";
                    $item->$title_lang = \Request::get($title_lang);
                    $item->$description_lang = \Request::get($description_lang);
                endforeach;

                $item->status = \Request::get('status');
                //$item->link = Helper::alias(\Request::get('title'));
                $item->keywords = \Request::get('keywords');
                $item->save();
                if (\Request::hasFile('logo')) {
                    $dir = '/uploads/sliders'.date('/Y/'.$item->id.'/');
                    $image = \Request::file('logo');
                    $filename = $image->getClientOriginalName();

                    $image->move(public_path().$dir, $filename);

                    //dd($dir.$filename);
                    //large

                    $large = \Image::make(url().$dir.$filename);
                    $large->resize(config('config.large_width'),config('config.large_height'));
                    //$img->insert(public_path().'/template_image/watermark.png');
                    $large->save(public_path().$dir.'large_'.$filename);
                    $item->large_thumb = $dir.'large_'.$filename;

                    $img_normal = \Image::make(url().$dir.$filename);
                    $img_normal->resize(config('config.normal_width'), config('config.normal_height'));
                    //$img_normal->insert(public_path().'/template_image/watermark.png');
                    $img_normal->save(public_path().$dir.'normal_'.$filename);
                    $item->normal_thumb = $dir.'normal_'.$filename;

                    $img_small = \Image::make(url().$dir.$filename);
                    $img_small->resize(config('config.small_width'), config('config.small_height'));
                    //$img_normal->insert(public_path().'/template_image/watermark.png');
                    $img_small->save(public_path().$dir.'small_'.$filename);
                    $item->small_thumb = $dir.'small_'.$filename;
                    $item->save();
                }

                return \Redirect::route('slider/index');
            }
        }
        return view('abslider::backend.add');
    }

    public function edit($link)
    {
        $item = Slider::find($link);

        if (\Request::all()){
            $validator = \Validator::make(\Request::all(), [
                'logo'=>array('mimes:jpeg,jpg,png,bmp,gif,svg'),
            ]);

            if ($validator->fails()) {
                return \Redirect::route('slider/edit',array('item'=>$item))->withErrors($validator)->withInput();
            }
            else{
                //dd(url());
                if (\Request::hasFile('logo')) {
                    $dir = '/uploads/sliders'.date('/Y/'.$item->id.'/');
                    $image = \Request::file('logo');
                    $filename = $image->getClientOriginalName();

                    $image->move(public_path().$dir, $filename);

                    //dd($dir.$filename);
                    //large

                    $large = \Image::make(url().$dir.$filename);
                    $large->resize(config('config.large_width'),config('config.large_height'));
                    //$img->insert(public_path().'/template_image/watermark.png');
                    $large->save(public_path().$dir.'large_'.$filename);
                    $item->large_thumb = $dir.'large_'.$filename;

                    $img_normal = \Image::make(url().$dir.$filename);
                    $img_normal->resize(config('config.normal_width'), config('config.normal_height'));
                    //$img_normal->insert(public_path().'/template_image/watermark.png');
                    $img_normal->save(public_path().$dir.'normal_'.$filename);
                    $item->normal_thumb = $dir.'normal_'.$filename;

                    $img_small = \Image::make(url().$dir.$filename);
                    $img_small->resize(config('config.small_width'), config('config.small_height'));
                    //$img_normal->insert(public_path().'/template_image/watermark.png');
                    $img_small->save(public_path().$dir.'small_'.$filename);
                    $item->small_thumb = $dir.'small_'.$filename;

                    //$item->normal_thumb = $dir.$filename;
                    //$item->save();

                }

                foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties):
                    $title_lang = "title_$localeCode";
                    $description_lang = "description_$localeCode";
                    $item->$title_lang = \Request::get($title_lang);
                    $item->$description_lang = \Request::get($description_lang);
                endforeach;

                $item->status = \Request::get('status');
                //$item->link = Helper::alias(\Request::get('title'));
                $item->keywords = \Request::get('keywords');
                $item->save();

                return \Redirect::route('slider/index');
            }
        }
        return view('abslider::backend.edit', array('item'=>$item));
    }

    public function delete($id)
    {
        $item = Slider::find($id);
        $item->delete();
        return \Redirect::route("slider/index");
    }


} 