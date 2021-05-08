<?php

namespace App\Http\Repository\ProductSlider;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

Class ProductSliderRepository implements ProductSliderInterface
{
    public function get($id)
    {
        $imageString = Product::find($id)->image_slider;
        $arrayOfImageFiles = explode(',', $imageString);
        
        return $arrayOfImageFiles;
    }
    public function store($request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'image_slider' => 'required',
        ]);
        if ($validator->fails()) {
            alert()->warning('Error Occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $images = Product::find($request->post('product_id'))->image_slider;
        $arrayOfImageFiles = explode(',', $images);
        $newArray = array();

        if ($request->file('image_slider')) {
            $countImage = count($arrayOfImageFiles);
            foreach ($request->file('image_slider') as $image) {
                $extension = $image[0]->getClientOriginalExtension();
                $name = Auth::user()->id . '_p_' . $countImage . '_' . $this->uniqueString() . ++$countImage . '.' . $extension;
                $image[0]->move(public_path('product_image'), $name);
                $newArray[] = $name;
            }
        }

        if ($images == 0) {
            $newLink = implode(",", $newArray);
        } else {
            $newLink = $images . ',' . implode(",", $newArray);
        }

        $addProduct = Product::find($request->post('product_id'));
        $addProduct->image_slider = $newLink;
        $addProduct->save();
        Alert::success('Success', 'Successfully, New Product Slider Image has been Added.');
    }
    public function update($request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'image_name' => 'required',
            'imageToUpload' => 'required',
        ]);
        if ($validator->fails()) {
            alert()->warning('Error Occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $imageLink = $request->post('image_name');
        $originalName = explode('.', $imageLink);
        $images = Product::find($request->post('product_id'))->image_slider;
        $arrayOfImageFiles = explode(',', $images);

        $newArray = array();

        foreach ($arrayOfImageFiles as $image) {
            if ($image == $imageLink) {
                $path_image = public_path() . '/product_image/' . $imageLink;

                if (file_exists($path_image) == true) {
                    unlink($path_image);
                }
                if ($request->imageToUpload) {
                    $uploadImage = $request->imageToUpload;
                    $name = $originalName[0] . '.' . $uploadImage->getClientOriginalExtension();
                    $uploadImage->move(public_path('product_image'), $name);
                    $newArray[] = $name;
                    continue;
                }
            }
            $newArray[] = $image;
        }

        $currentArray = implode(",", $newArray);

        $addProduct = Product::find($request->post('product_id'));
        $addProduct->image_slider = $currentArray;
        $addProduct->save();
        Alert::success('Success', 'Successfully, The Product Slider Image has been updated.');
    }
    public function delete($request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'image_name' => 'required',
        ]);
        if ($validator->fails()) {
            alert()->warning('Error Occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $imageLink = $request->post('image_name');
        $images = Product::find($request->post('product_id'))->image_slider;
        $arrayOfImageFiles = explode(',', $images);
        $newArray = array();

        foreach ($arrayOfImageFiles as $image) {
            if ($image == $imageLink) {
                $path_image = public_path() . '/product_image/' . $imageLink;
                if (file_exists($path_image) == true) {

                    unlink($path_image);
                }
                continue;
            }
            $newArray[] = $image;
        }

        $currentArray = implode(",", $newArray);

        $addProduct = Product::find($request->post('product_id'));
        $addProduct->image_slider = $currentArray;
        $addProduct->save();
        Alert::success('Success', 'Successfully, The Product Slider Image has been deleted.');
    }
    private function uniqueString()
    {
        $m = explode(' ', microtime());
        list($totalSeconds, $extraMilliseconds) = array($m[1], (int)round($m[0] * 1000, 3));
        $txID = date('YmdHis', $totalSeconds) . sprintf('%03d', $extraMilliseconds);
        $txID = substr($txID, 2, 15);
        return $txID;
    }
}
