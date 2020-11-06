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
                      <th>Category ID</th>
                      <th>Category Name</th>
                      <th>Description</th>
                      <th>Status</th>
                      <th>Actions</th>
                  </tr>
              </thead>   
               
              <tbody>
                @foreach ($categorys as $cat)
                <tr>
                    <td>{{ $cat->categorie_id }}</td>
                    <td class="center">{{ $cat->categorie_name }}</td>
                    <td class="center">{{ $cat->categorie_description }}</td>
                    <td class="center">
                        
                            @if ($cat->publication_status == 1)
                            <span class="label label-success">Active</span>
                            @else
                            <span class="label label-danger">Not Active</span>
                            @endif
                       
                        
                    </td>
                    <td class="center">
                        @if($cat->publication_status == 1)
                    <a class="btn btn-danger" href="{{URL::to("/unActive_category/".$cat->categorie_id)}}">
                            <i class="halflings-icon white thumbs-down"></i>  
                        </a>
                        @else
                        <a class="btn btn-success" href="{{URL::to("/active_category/".$cat->categorie_id)}}">
                            <i class="halflings-icon white thumbs-up"></i>  
                        </a>
                        @endif
                        <a class="btn btn-info" href="{{URL::to("/edit_category/".$cat->categorie_id)}}">
                            <i class="halflings-icon white edit"></i>  
                        </a>
                        <a class="btn btn-danger" id="delete" href="{{URL::to("/delete_category/".$cat->categorie_id)}}">
                            <i class="halflings-icon white trash"></i> 
                        </a>
                        <button type="button" class="btn btn-primary btn-sm" data-id="{{$cat->categorie_id}}" data-toggle="modal" data-target="#myModal">+Sub Category</button>
                        <a class="btn btn-danger" href="{{URL::to("/show.subcategory/")}}">
                           show Sub Cat
                        </a>
                    </td>
                </tr>

                @endforeach
                {{ $categorys->links() }}
              </tbody>
               
          </table>            
        </div>
    </div><!--/span-->

</div><!--/row-->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">New Sub Category</h4>
        </div>
    <form action="{{url("/addSub_category")}}" method="POST">

                @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="subcategorie_name" id="">
                </div>
                
                    <div class="form-group">
                        
                        <input type="hidden" value="" class="form-control" name="maincategory_id" id="cat_id">
                    </div>
                <div class="form-group">
                    <label for="des">Description</label>
                    <textarea name="subcategorie_description" id="des" cols="20" rows="5" id='des' class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="title">Publication Status</label>
                    <input type="checkbox" class="form-control" name="subpublication_status" value="1">
                </div>
            </div>
           
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection