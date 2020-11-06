@extends('admin_dashboard');
@section("admin_container")

<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="{{("/dashboard")}}">Dashboard</a> 
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="#">All Manufecture</a></li>
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
        <p class="alert-success">
            <?php
            $message = Session::get('message');
            if($message){
                echo $message;
                Session::put('message', null);
            } 
            ?>
        </p>
        <p class="alert alert-success">
            <?php
            $massege = Session::get('massege');
            if($massege){
                echo $massege;
                Session::put('massege', null);
            } 
            ?>
        </p>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
              <thead>
                  <tr>
                      <th>Manufecture ID</th>
                      <th>Manufecture Name</th>
                      <th>Description</th>
                      <th>Status</th>
                      <th>Actions</th>
                  </tr>
              </thead>   
               
              <tbody>
                @foreach ($brand as $br)
                <tr>
                    <td>{{ $br->manufecture_id }}</td>
                    <td class="center">{{ $br->manufecture_name }}</td>
                    <td class="center">{{ $br->manufecture_description }}</td>
                    <td class="center">
                        
                            @if ($br->manpublication_status == 1)
                            <span class="label label-success">Active</span>
                            @else
                            <span class="label label-danger">Unactive</span>
                            @endif
                       
                        
                    </td>
                    <td class="center">
                        @if($br->manpublication_status == 1)
                    <a class="btn btn-danger" href="{{URL::to("/unActive_manu/".$br->manufecture_id)}}">
                            <i class="halflings-icon white thumbs-down"></i>  
                        </a>
                        @else
                        <a class="btn btn-success" href="{{URL::to("/active_manu/".$br->manufecture_id)}}">
                            <i class="halflings-icon white thumbs-up"></i>  
                        </a>
                        @endif
                        <a class="btn btn-info" href="{{URL::to("/edit_manu/".$br->manufecture_id)}}">
                            <i class="halflings-icon white edit"></i>  
                        </a>
                        <a class="btn btn-danger" id="delete" href="{{URL::to("/delete_manu/".$br->manufecture_id)}}">
                            <i class="halflings-icon white trash"></i> 
                        </a>

                          
                    </td>
                </tr>

                @endforeach
                {{ $brand->links() }}
              </tbody>
               
          </table>            
        </div>
    </div><!--/span-->

</div><!--/row-->


@endsection