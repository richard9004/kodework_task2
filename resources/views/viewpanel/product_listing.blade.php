     
@extends('viewpanel.layouts.master')

@section('title', $title)

@section('content')




  <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Product Listing</h1>

         
                   <div class="col-sm-12">
          	<div class="card shadow">
                <div class="card-header">
                  <h6 class="m-0 font-weight-bold text-primary float-left">Product Listing</h6>
                  <a href="{{ url('create-new-product') }}" class="btn btn-sm btn-dark float-right"><i class="fa fa-plus"></i> Create New Product</a>
                </div>
                <div class="card-body">
                	<form class="form-inline se-form" method="GET" action="{{url('search-product')}}">
                	
  <div class="form-group">
  	
     <input type="text" class="form-control" value="{{ request()->get('pname') }}" id="pname" name="pname" placeholder="Search By Product Name">
  </div>

  <div class="form-group mx-sm-3">
  
     <select class="form-control" name="sort_by_gst">
  	 	<option value="">--Sort By GST Type</option>
  	 	<option value="0" {!! request()->get('sort_by_gst') == '0' ? 'selected="selected"' : '' !!}>Exclusive</option>
        <option value="1" {!! request()->get('sort_by_gst') == '1' ? 'selected="selected"' : '' !!}>Inclusive</option>
  	 </select>
  </div>
 
  <button type="submit" class="btn btn-success mx-sm-1"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
  <a href="{{url('manage-products')}}" class="btn btn-primary mx-sm-1"><i class="fa fa-registered" aria-hidden="true"></i> Reset</a>
</form>





                	   @if(session()->has('success'))
           <div  class="alert alert-success" style="text-align:center">  {{ session()->get('success') }} </div>
          @endif

               @if(session()->has('error'))
           <div  class="alert alert-danger" style="text-align:center">  {{ session()->get('error') }} </div>
          @endif
          <table class="table table-bordered">
    <thead>
      <tr>
        <th>Name</th>
        <th>Price</th>
        <th>GST</th>
        <th>GST type</th>
        <th>Quantity</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    	@foreach($data as $d)
      <tr>
        <td>{{$d->name}}</td>
        <td>{{$d->price}}</td>
        <td>{{$d->gst}}</td>
        @if($d->gst_type =='0')         
        <td>Exclusive</td>         
        @else
        <td>Inclusive</td>        
        @endif
        
        <td>{{$d->quantity}}</td>
        <td><a class="btn btn-sm btn-primary" href="{{ url('edit-product', $d->id) }}">Edit</a> | <a class="btn btn-sm btn-info get_product_view_data {{$d->id}}" data-toggle="modal" data-target="#myModal">View</a> | {!! Form::open(['method' => 'DELETE','route' => ['delete-product', $d->id],'style'=>'display:inline', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger']) !!}
                                {!! Form::close() !!}</td>
       
      </tr>
      @endforeach

       @if(count($data)==0)         
        <td colspan="6">No Records Found</td> 
       @endif  
      
    </tbody>
  </table>

  <div class="col-sm-12">{!! $data->render() !!}</div>
   
                </div>
              </div>
          </div>

        </div>
        <!-- /.container-fluid -->
<script type="text/javascript">
	  function ConfirmDelete()
  {
  var x = confirm("Are you sure you want to delete?");
  if (x)
    return true;
  else
    return false;
  }
	$(document).ready(function(){
        
        $('.get_product_view_data').click(function(){
               var product_id = $(this).attr('class').split(' ').pop();
               

               $.ajax({
                type: 'POST',
                url: '{{url("view-product")}}',
               
                data: { 
                  'product_id': product_id, 
                  "_token": "{{ csrf_token() }}" // <-- the $ sign in the parameter name seems unusual, I would avoid it
                },
                success: function(data){
                  //console.log(data);
                  var personObject = JSON.parse(data); //parse json string into JS object
                  //console.log(personObject);

                  $('.product_name').text(personObject[0].name);
                  $('.product_price').text(personObject[0].price);
                  $('.product_gst').text(personObject[0].gst);
                  $('.product_created').text(personObject[0].created_at);
                  $('.product_updated').text(personObject[0].updated_at);
                  $('.product_quantity').text(personObject[0].quantity);
                }
});
        });
	});
</script>


<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Product Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <table class="table">
          	 <tr>
          	 	 <th>Name</th>
          	     <td class="product_name"></td>
          	 </tr>
          	  <tr>
          	 	 <th>Price</th>
          	     <td class="product_price"></td>
          	 </tr>
          	  <tr>
          	 	 <th>GST</th>
          	     <td class="product_gst"></td>
          	 </tr>
          	 <tr>
          	 	 <th>Quantity</th>
          	     <td class="product_quantity"></td>
          	 </tr>
          	  <tr>
          	 	 <th>Created at</th>
          	     <td class="product_created"></td>
          	 </tr>
          	  <tr>
          	 	 <th>Updated at</th>
          	     <td class="product_updated"></td>
          	    
          	 </tr>
          	
          </table>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


@endsection



