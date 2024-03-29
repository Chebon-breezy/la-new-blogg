<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
class HomeController extends Controller
{
    public function index() {
        return view('home');
    }

    public function add_product(Request $request) {
        $data=new Product;
        
        $data->title = $request->title;
        $data->description = $request->description;

        $image = $request->image; 

        if ($image) {
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product',$imagename);
        $data->image = $imagename;
        }
        //check if image is added


        $data->save();
        
        return redirect()->back();
}

public function show_product(Request $request) {

  $data=Product::all();
  return view('product', compact('data'));
}

public function delete_product($id){

  $item = Product::find($id);

  $item->delete();

  return redirect()->back();

}
}