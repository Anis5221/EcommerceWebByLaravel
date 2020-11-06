@extends('admin_dashboard');
@section("admin_container")

<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="{{("/dashboard")}}">Dashboard</a> 
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="#">All Category</a></li>
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
            $massege = Session::get('message');
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
                      <th>Category ID</th>
                      <th>Main Category Name</th>
                      <th>Category Name</th>
                      <th>Description</th>
                      <th>Status</th>
                      <th>Actions</th>
                  </tr>
              </thead>   
               
              <tbody>
                @foreach ($subcategory as $cat)
                <tr>
                    <td>{{ $cat->subcategorie_id }}</td>
                    <td>{{ $cat->categorie_name }}</td>
                    <td class="center">{{ $cat->subcategorie_name }}</td>
                    <td class="center">{{ $cat->subcategorie_description }}</td>
                    <td class="center">
                        
                            @if ($cat->subpublication_status == 1)
                            <span class="label label-success">Active</span>
                            @else
                            <span class="label label-danger">Not Active</span>
                            @endif
                       
                        
                    </td>
                    <td class="center">
                        @if($cat->subpublication_status == 1)
                    <a class="btn btn-danger" href="{{URL::to("/unActive_subcategory/".$cat->subcategorie_id)}}">
                            <i class="halflings-icon white thumbs-down"></i>  
                        </a>
                        @else
                        <a class="btn btn-success" href="{{URL::to("/active_subcategory/".$cat->subcategorie_id)}}">
                            <i class="halflings-icon white thumbs-up"></i>  
                        </a>
                        @endif
                      <button class="btn btn-info" data-myname="{{ $cat->subcategorie_name }}" data-des="{{ $cat->subcategorie_description }}" data-id="{{$cat->subcategorie_id}}" data-toggle="modal" data-target="#edit">
                            <i class="halflings-icon white edit"></i>  
                        </button>
                        <a class="btn btn-danger" id="delete" href="{{URL::to("/delete_subcategory/".$cat->subcategorie_id)}}">
                            <i class="halflings-icon white trash"></i> 
                        </a>

                        
                    </td>
                </tr>

                @endforeach
                {{ $subcategory->links() }}
              </tbody>
               
          </table>            
        </div>
    </div><!--/span-->

</div><!--/row-->



<!-- Modal2 -->



<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Edit Sub Category</h5>
        <button type="button" class="close pb-4" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url("/update.subcategory")}}" method="POST">
          @csrf
          <input type="hidden" id="cat_id" name="cat_id">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Name:</label>
            <input type="text" name="name" class="form-control" id="name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Description</label>
            <textarea class="form-control" name="des" id="des"></textarea>
          </div>
          <div class="form-group">
            <label for="title">Publication Status</label>
            <input type="checkbox" class="form-control" name="subpublication_status" value="1">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Change</button>
        </div>
      </form>
      </div>
    
    </div>
  
  </div>
</div>

<!-- end Modal2 -->


@endsection