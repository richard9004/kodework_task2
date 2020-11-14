<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use App\User;
use App\Product;
use Auth;
use Hash;

class ProductController extends Controller
{
    //$this->middleware('auth');
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
             $data = DB::table('products')->where('user_id',auth()->user()->id)->orderBy('id', 'desc')->paginate(5);
         return view('viewpanel.product_listing')->with('title','Manage Products')->with('data',$data);
    }

    public function create_product(){
        return view('viewpanel.create_product')->with('title','Create New Product');


    }


    public function api_product_details($api_key){
             $data = DB::table('products')
                     ->join('users', 'users.id', '=', 'products.user_id')
                     ->select('products.*')
                     ->where('users.api_key',auth()->user()->api_key)
                     ->get();

               if($data){
                  echo json_encode($data);exit;
               }else{
                  $array[] = array('msg'=>'No Records Found');
                  echo json_encode($array);exit;
               }      

            
    }

    public function save_product(Request $request){
           
        $validation = Validator::make($request->all(), [
         'name'     => 'required',
         'price' => 'required|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
         'gst' => 'required|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
         'gst_type' => 'required',
         'quantity' => 'required|numeric'
        
         ]);

      // Check if it fails //
      if( $validation->fails() ){
         return redirect()->back()->withInput()->with('errors', $validation->errors() );
      }

     //echo $request->price;exit;

        $data=array(
            'name'     => $request->name,
            'price' => $request->price,
            'gst' => $request->gst,
            'gst_type' => $request->gst_type,
            'quantity' => $request->quantity,
            'user_id' => auth()->user()->id,
            'created_at'=> date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s')
        );

         if(DB::table('products')->insert($data)){
            return redirect('manage-products')->with('success','New product has been created'); 
           }else{
            return redirect('register-new-user')->with('error','Unable to create a product'); 
         }



    }

    public function search_product(Request $request){
          
       $query = DB::table('products');

          

        if(isset($request->pname) && !empty($request->pname)){
              
             $query->where('name','like','%'.$request->pname.'%');
             
           
        }

         if(isset($request->sort_by_gst) && !empty($request->sort_by_gst)){
              
             $query->where('gst_type',$request->sort_by_gst);
             
           
        }
        
        $data = $query->where('user_id',auth()->user()->id)->paginate(5);

        return view('viewpanel.product_listing')->with('title','Manage Products')->with('data',$data);


    } 

   

    public function delete_product(Request $request, $id){

        if(Product::find($id)->delete()){
             return redirect('manage-products')->with('success','Product has been deleted successfully');
        }else{
             return redirect('manage-products')->with('error','Error in deleting product'); 
        }
    }


    public function view_product(Request $request){

         $data = DB::table('products')->where('id',$request->product_id)->get();
         echo json_encode($data);exit;
              
    }

     public function edit_product($id)
     {
        $data = Product::find($id);
        return view('viewpanel.edit_product')->with('title','Edit Product')->with('data',$data);
     }

     public function update_product(Request $request, $id){
       $validation = Validator::make($request->all(), [
         'name'     => 'required',
         'price' => 'required|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
         'gst' => 'required|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
         'gst_type' => 'required',
         'quantity' => 'required|numeric'
        
         ]);

      // Check if it fails //
      if( $validation->fails() ){
         return redirect()->back()->withInput()->with('errors', $validation->errors() );
      }

       $data=array(
            'name'     => $request->name,
            'price' => $request->price,
            'gst' => $request->gst,
            'gst_type' => $request->gst_type,
            'quantity' => $request->quantity,
            'updated_at'=> date('Y-m-d H:i:s')
        );

         if(Product::find($id)->update($data)){
            return redirect('manage-products')->with('success','Product updated successfully'); 
           }else{
            return redirect('edit-product')->with('error','Unable to create a product'); 
         }



     }


   


    
}
