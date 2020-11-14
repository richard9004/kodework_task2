     
@extends('viewpanel.layouts.master')

@section('title', $title)

@section('content')
  <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">API Details</h1>

          <div class="card">
  <div class="card-header">Your API Key is below</div>
  <div class="card-body">
  	<div class="col-sm-12">
  		<form class="form-inline" action="/action_page.php">
  <div class="form-group">
    <label for="api_key">API-Key:&nbsp; </label>

    <label for="api_key_vale"><b>{{Auth::user()->api_key}}</b></label>
    
  </div>
  

 
</form>	
<br>
<label>URL:&nbsp; {{url('api-product-details')}}/<b>API-KEY</b></label>


  	</div>


  	<div class="col-sm-12">
  		<a class="btn btn-sm btn-success fetch_products"><i class="fa fa-eye" aria-hidden="true"></i> Fetch Products Using API</a>
  		<pre id="display_product_details" >

        </pre>
  	</div>
  </div>
  
</div>

        </div>
        <!-- /.container-fluid -->

        <script type="text/javascript">
        	$(document).ready(function(){
                 $('.fetch_products').click(function(){
                    $('#display_product_details').text('');
                     $.ajax({
               
                   url: '{{url("api-product-details",Auth::user()->api_key)}}',
               
                   success: function(data){
                  //console.log(data);
                      var personObject = JSON.parse(data); //parse json string into JS object
                      var personObject = JSON.stringify(personObject, undefined, 2); //parse json string into JS object
                      console.log(personObject);

                      $('#display_product_details').text(personObject);
                   }
        	       });
                 });

        		 

        		});
        </script>

@endsection