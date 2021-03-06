<!DOCTYPE html>
<html>
<head>
	<title>Store Listing</title>
	 <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="{{ URL::to('https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css') }}">
     <script src="{{ URL::to('https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js') }}"></script>
     <script src="{{ URL::to('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js') }}"></script>
     <script src="{{ URL::to('https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js') }}"></script>

     <style type="text/css">
     	 .search_bar{
     	 	margin-top: 20px;
     	 }
     </style>
</head>
<body>
	 <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <a class="navbar-brand" href="#">Product Manager</a>
     </nav>
   <div class="container">
       <div class="row breadcrumb search_bar">
     <div class="col-sm-3">
          	   <div class="form-group">
                 
                  <input type="text" class="form-control" id="search_by_name" name="search_by_name" placeholder="Search by product name">
              </div>


          </div>    

          <div class="col-sm-2">
          	<div class="form-group">
               
               <select class="form-control" id="by-sort">
                   <option value="">Sort By</option>
                   <option value="by_date">By date</option>
                   <option value="price_low_to_high">Price low to high</option>
                   <option  value="price_high_to_low">Price high to low</option>
               </select>
            </div>
          </div>   
            <div class="col-sm-3">
          	<div class="form-group">
              
               <select class="form-control" id="number_of_records" name="number_of_records">
                  <option value="">Number of records</option>
                   <option value="5">5</option>
                   <option value="10">10</option>
                   <option  value="20">20</option>
                   <option value="all">All</option>
               </select>
            </div>
          </div>   
          <div class="col-sm-4">	
          	 <a href="{{ url('store-listing') }}" class="btn btn-sm btn-primary">Reset</a>
          </div>
       </div>	

       <div class="row loading_div" style="display:none;">
       	      

       	      <p style="text-align: center;">Please Wait</p>
       </div>

       <div class="row product-content-div">
       	 





       </div>
      

       </div>
   </div>
</body>
</html>


<script type="text/javascript">
	var base_url="{{URL::to('/') }}";
	$(document).ready(function(){


 var sort_by=$('#by-sort').val();
           var search_by_name=$('#search_by_name').val();
           var number_of_records=$('#number_of_records').val();
		 call_ajax(sort_by, search_by_name, number_of_records);
        
        //Sorting Function
        $('#by-sort').change(function(){
           

           var sort_by=$(this).val();
           var search_by_name=$('#search_by_name').val();
           var number_of_records=$('#number_of_records').val();
           
           call_ajax(sort_by, search_by_name, number_of_records);

            
        });

        //Search By Product Name
          $('#search_by_name').keyup(function(){
           

           var sort_by=$('#by-sort').val();
           var search_by_name=$('#search_by_name').val();
           var number_of_records=$('#number_of_records').val();
           
           call_ajax(sort_by, search_by_name, number_of_records);

            
        });

        //Number of Rows
          $('#number_of_records').change(function(){
           

           var sort_by=$('#by-sort').val();
           var search_by_name=$('#search_by_name').val();
           var number_of_records=$('#number_of_records').val();
           
           call_ajax(sort_by, search_by_name, number_of_records);

            
        });
 

       function get_view_data(data){
       	console.log(data);

       }

        //Common Function
        function call_ajax(sort_by, search_by_name, number_of_records){
        	$('.product-content-div').html('');
        	    $.ajax({
                type: 'POST',
                url: '{{url("display-products-with-filters")}}',
                data: { 
                  'sort_by': sort_by, 
                  'search_by_name': search_by_name, 
                  'number_of_records': number_of_records, 
                  "_token": "{{ csrf_token() }}"
                },
                beforeSend: function() {
                 $(".loading_div").show();
                 $('.product-content-div').hide();
                },
                success: function(data){
                 // console.log(data);

                  var personObject = JSON.parse(data);
                  console.log(personObject);
                   $(".loading_div").hide();
                    $('.product-content-div').show();
                 
                  if(personObject.length === 0){
                 	$('.product-content-div').append('<p>No records found</p>');
                  }else{

                  $.each(personObject, function(index,prdouct_data) {
                  	      if(prdouct_data.path!=""){
 						    image_path=base_url+"/uploads/images/"+prdouct_data.path;
                  	      }else{
                  	      	image_path="https://www.indianbankseauction.com/PropertyImages/nopreview.jpeg";
                  	      }
                  	      
                          $('.product-content-div').append(' <div class="col-sm-3"><div class="card"><img class="card-img-top" src="'+image_path+'" style="width:250px;height:200px" alt="Card image cap"><div class="card-body"><h5 class="card-title">'+prdouct_data.name+'</h5><p class="card-text">Price: '+prdouct_data.price+'</p><p>GST: '+prdouct_data.gst+'</p><a class="btn btn-primary get_product_view_data '+prdouct_data.id+'" data-toggle="modal" data-target="#myModal">View</a></div></div></div>');
                  }); 
                 }
                


                }
             });
        }

	});

$(document).on("click",".get_product_view_data",function() {

               var product_id = $(this).attr('class').split(' ').pop();
               

               $.ajax({
                type: 'POST',
                url: '{{url("view-product-store")}}',
               
                data: { 
                  'product_id': product_id, 
                  "_token": "{{ csrf_token() }}" // <-- the $ sign in the parameter name seems unusual, I would avoid it
                },
                success: function(data){
                  //console.log(data);
                  var personObject = JSON.parse(data); //parse json string into JS object
                  //console.log(personObject);
 if(personObject[0].path!=""){
 						    view_path=base_url+"/uploads/images/"+personObject[0].path;
                  	      }else{
                  	      	view_path="https://www.indianbankseauction.com/PropertyImages/nopreview.jpeg";
                  	      }
                  $('.product_name').text(personObject[0].name);
                  $('.product_image').attr("src", view_path);
                  $('.product_price').text(personObject[0].price);
                  $('.product_gst').text(personObject[0].gst);
                  $('.product_created').text(personObject[0].created_at);
                  $('.product_updated').text(personObject[0].updated_at);
                  $('.product_quantity').text(personObject[0].quantity);
                }
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
      	 <div class="row">
      	 	<div class="col-sm-12"><img src="" class="img img-responsive img-rounded product_image" style="width: 400px;"></div>
      	 	
      	 </div>
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
          	 
          	
          </table>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
