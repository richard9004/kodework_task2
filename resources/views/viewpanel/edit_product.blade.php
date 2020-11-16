     
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
    <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
  </ol>
</nav>


          <div class="col-sm-8">
          	<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Edit Existing Product</h6>
                </div>
                <div class="card-body">
                	   @if(session()->has('success'))
           <div  class="alert alert-success" style="text-align:center">  {{ session()->get('success') }} </div>
          @endif

               @if(session()->has('error'))
           <div  class="alert alert-danger" style="text-align:center">  {{ session()->get('error') }} </div>
          @endif
                     {!! Form::model($data,['method' => 'patch','route'=>['update-product',$data->id],'enctype'=>'multipart/form-data', 'class'=>'form-info']) !!}
                     	    {!! csrf_field() !!}
  <div class="form-group">
    <label for="exampleInputEmail1" class="bold-label">Product Name</label>
  
     {!! Form::text('name', null, array('placeholder' => 'Enter Product Name','class' => 'form-control','id'=>'name')) !!}
    @if($errors->has('name'))
                      <div class="error_message">{{ $errors->first('name') }}</div>
                      @endif
  </div>
   <div class="form-group">
    <label for="exampleInputEmail1" class="bold-label">Price</label>
    {!! Form::text('price', null, array('placeholder' => 'Enter Product Price','class' => 'form-control','id'=>'price')) !!}
     @if($errors->has('price'))
                      <div class="error_message">{{ $errors->first('price') }}</div>
                      @endif
   
  </div>

   <div class="form-group">
    <label for="exampleInputEmail1" class="bold-label">GST</label>
    {!! Form::text('gst', null, array('placeholder' => 'Enter Product Price','class' => 'form-control','id'=>'gst')) !!}
     @if($errors->has('gst'))
                      <div class="error_message">{{ $errors->first('gst') }}</div>
                      @endif
   
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1" class="bold-label">GST Type</label>
   <select class="form-control" name="gst_type">
   	  <option value="">--Select--</option>
  <option value="0" {!! $data->gst_type == '0' ? 'selected="selected"' : '' !!}>Exclusive</option>
  <option value="1" {!! $data->gst_type == '1' ? 'selected="selected"' : '' !!}>Inclusive</option>
</select>
    @if($errors->has('gst_type'))
                      <div class="error_message">{{ $errors->first('gst_type') }}</div>
                      @endif
  </div>

   <div class="form-group">
    <label for="exampleInputEmail1" class="bold-label">Quantity</label>
    {!! Form::text('quantity', null, array('placeholder' => 'Enter Product Price','class' => 'form-control','id'=>'quantity')) !!}
    @if($errors->has('quantity'))
                      <div class="error_message">{{ $errors->first('quantity') }}</div>
                      @endif
  </div>

    <div class="form-group mb-4">
                                        <label>Upload Image</label>
                                        <input class="form-control" type="file" name="product_image" placeholder="Upload Video" value="{{ $data->path }}">

                                        <div class="error_message" style="color:red">{{ $errors->first('product_image') }}</div>
                                    </div>
 
  <button type="submit" class="btn btn-primary">Update Product</button>
 {!! Form::close() !!}
                </div>
              </div>
          </div>
          
        </div>
        <!-- /.container-fluid -->

@endsection