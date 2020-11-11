@extends('admin_dashboard')
@section('admin_container')
@extends('admin_dashboard');
@section("admin_container")

<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="{{("/dashboard")}}">Dashboard</a> 
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="#">Manage Product</a></li>
</ul>
<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon user"></i><span class="break"></span>Members</h2>
            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
            </div>
        </div>
        <p style="alert alert-success">
            <?php
            $message = Session::get('message');
            if($message){
                echo $message;
                Session::put('message', null);
            } 
            ?>
        </p>
        <p style="alert alert-success">
            <?php
            $massege = Session::get('massege');
            if($massege){
                echo $massege;
                Session::put('massege', null);
            } 
            ?>
        </p>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable" style="overflow-x:auto">
              <thead>
                  <tr>
                      
                      <th>Product Name</th>
                      <th>Product Price</th>
                      <th>Quantity</th>
                      <th>Order Time</th>
                      <th>Image</th>
                      <th>status</th>
                      <th>Size</th>
                      <th>Actions</th>
                  </tr>
              </thead>   
               
              <tbody>
                @foreach ($all_ordered_detail as $pro)
                <tr>
                    
                    <td class="center">{{ $pro->product_name }}</td>
                    <td class="center">{{ $pro->Product_price }}</td>
                    <td class="center">{{ $pro->product_seles_quantity }}</td>
                    <td class="center">{{ $pro->created_at }}</td>
                    <td class="center"><img src="{{URL::to($pro->product_image)}}" style="height: 80px; width: 80px"></td>
                    <td class="center">{{ $pro->order_status }}</td>
                    <td class="center">{{ $pro->product_size }}</td>
                    
                    <td class="center">
                       
                        <a class="btn btn-info" href="{{URL::to("/view-manage-product/".$pro->id)}}">
                            <i class="halflings-icon white edit"></i>  
                        </a>
                        <a class="btn btn-danger" id="delete" href="{{URL::to("/delete_product/".$pro->id)}}">
                            <i class="halflings-icon white trash"></i> 
                        </a>
                        
                    </td>
                </tr>

                @endforeach
               
              </tbody>
               
          </table>            
        </div>
    </div><!--/span-->

</div><!--/row-->


@endsection
@endsection