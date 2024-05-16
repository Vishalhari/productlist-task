<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Products;

use Illuminate\Support\Facades\Validator;
use Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Products::orderBy('id','DESC')->paginate(5);
        return view('products.index',compact('products'))
        ->with('i', ($request->input('page', 1) - 1) * 5);
        //return view('products/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['edit'] = 0;
        return view('products.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'productname'=>'required',
            'description'=>'required',
            'productprice'=>'required',
        ]);
        if($validator -> fails()){
            return back()->withErrors($validator)->withInput();
        } else {

          

            $obj_products = new Products();  
            $obj_products->product_name   = $request->productname;
            $obj_products->product_description    = $request->description; 
            $obj_products->product_price    = $request->productprice; 
            $obj_products->save();

            Session::flash('success', 'Products Created successfully!');
            return redirect('products');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['edit'] = 1;
        $data['products'] = Products::find($id);
        return view('products.create',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'productname'=>'required',
            'description'=>'required',
            'productprice'=>'required',
        ]);
        if($validator -> fails()){
            return back()->withErrors($validator)->withInput();
        } else {

          

            $obj_products = Products::find($id);  
            $obj_products->product_name   = $request->productname;
            $obj_products->product_description    = $request->description; 
            $obj_products->product_price    = $request->productprice; 
            $obj_products->save();

            Session::flash('success', 'Products Created successfully!');
            return redirect('products');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Products::where('id',$id)->delete();
        Session::flash('success', 'Products successfully Deleted!');
        return redirect('products');
    }


    public function search(Request $request) {
        $searchTerm = $request->input('search');



        $products = Products::where('product_name', 'like', '%' . $searchTerm . '%')->paginate(5);
        return view('products.index',compact('products'))
        ->with('i', ($request->input('page', 1) - 1) * 5);

        
    }
}
