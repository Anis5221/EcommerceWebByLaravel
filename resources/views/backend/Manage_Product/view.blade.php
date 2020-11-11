@extends('admin_dashboard')
@section('admin_container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <div class="up-side">

                
                <div class="left-side col-md-6">
                    <table>
                        <thead>
                            <tr>
                                <th>Customer name</th>
                                <th>Customer Email</th>
                                <th>Customer Phone</th>
                            </tr>
                            

                            <tr>
                                <td>{{$customer_details->customer_name}}</td>
                                <td>{{$customer_details->customer_email}}</td>
                                <td>{{$customer_details->customer_phone}}</td>
                                
                              </tr>
                              
                        </thead>
                    </table>
                </div>
                <div class="right-side col-md-6">
                    <table>
                        <thead>
                            <tr>
                                <th>Product name</th>
                                <th>Order status</th>
                                <th>Quantity</th>
                            </tr>
                            <tr>
                                <td>{{$all_ordered_details->product_name}}</td>
                                <td>{{$all_ordered_details->order_status}}</td>
                                <td>{{$all_ordered_details->product_seles_quantity}}</td>
                              </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="up-side">

                
                <div class="left-side">
                    <table>
                        <thead>
                            <tr>
                                <th>Product name</th>
                                <th>Product image</th>
                                <th>Product Size</th>
                                <th>Product Price</th>
                                <th>Order tiem </th>
                               
                            </tr>
                            

                            <tr>
                                <td>{{$all_ordered_details->product_name}}</td>
                            <td><img src="{{url($all_ordered_details->product_image)}}" height="80px" width="80px" alt=""></td>
                                <td>{{$all_ordered_details->product_size}}</td>
                                <td>{{$all_ordered_details->product_price}}</td>
                                <td>{{$all_ordered_details->order_status}}</td>
                                
                              </tr>
                              
                        </thead>
                    </table>
                </div>
                
            </div>
            </div>
        </div>
    </div>
@endsection