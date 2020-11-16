     
@extends('viewpanel.layouts.master')

@section('title', $title)

@section('content')
  <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
       <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ url('manage-products') }}">Manage Products</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create New Product</li>
  </ol>
</nav>


          <div class="col-sm-8">
          	<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Create a new Product</h6>
                </div>
                <div class="card-body">
                	   @if(session()->has('success'))
           <div  class="alert alert-success" style="text-align:center">  {{ session()->get('success') }} </div>
          @endif

               @if(session()->has('error'))
           <div  class="alert alert-danger" style="text-align:center">  {{ session()->get('error') }} </div>
          @endif
                     <form method="post" action="{{ url('save-product') }}" enctype="multipart/form-data">
                     	    {!! csrf_field() !!}
  <div class="form-group">
    <label for="exampleInputEmail1" class="bold-label">Product Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" aria-describedby="emailHelp" placeholder="Enter Product Name">
    @if($errors->has('name'))
                      <div class="error_message">{{ $errors->first('name') }}</div>
                      @endif
  </div>
   <div class="form-group">
    <label for="exampleInputEmail1" class="bold-label">Price</label>
    <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}" aria-describedby="emailHelp" placeholder="Enter Product Price">
     @if($errors->has('price'))
                      <div class="error_message">{{ $errors->first('price') }}</div>
                      @endif
   
  </div>

   <div class="form-group">
    <label for="exampleInputEmail1" class="bold-label">GST</label>
    <input type="text" class="form-control" id="gst" name="gst" aria-describedby="emailHelp" value="{{ old('gst') }}" placeholder="Enter Product GST">
     @if($errors->has('gst'))
                      <div class="error_message">{{ $errors->first('gst') }}</div>
                      @endif
   
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1" class="bold-label">GST Type</label>
   <select class="form-control" name="gst_type">
   	  <option value="">--Select--</option>
  <option value="0" {!! old('gst_type') == '0' ? 'selected="selected"' : '' !!}>Exclusive</option>
  <option value="1" {!! old('gst_type') == '1' ? 'selected="selected"' : '' !!}>Inclusive</option>
</select>
    @if($errors->has('gst_type'))
                      <div class="error_message">{{ $errors->first('gst_type') }}</div>
                      @endif
  </div>



   <div class="form-group">
    <label for="exampleInputEmail1" class="bold-label">Quantity</label>
    <input type="text" class="form-control" id="quantity" value="{{ old('quantity') }}" name="quantity" aria-describedby="emailHelp" placeholder="Enter Product Quantity">
    @if($errors->has('quantity'))
                      <div class="error_message">{{ $errors->first('quantity') }}</div>
                      @endif
  </div>

   <div class="form-group mb-4">
                                        <label>Upload Image</label>
                                        <input class="form-control" type="file" name="product_image" placeholder="Upload Video">
                                        <div class="error" style="color:red">{{ $errors->first('product_image') }}</div>
                                    </div>


 
  <button type="submit" class="btn btn-primary">Save Product</button>
</form>
                </div>
              </div>
          </div>
          
        </div>
        <!-- /.container-fluid -->

@endsection