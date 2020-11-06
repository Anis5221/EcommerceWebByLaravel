@extends('admin_dashboard')
@section('admin_container')					
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to("/dashboard")}}">Home</a>
            <i class="icon-angle-right"></i> 
        </li>
        <li>
            <i class="icon-edit"></i>
            <a href="#">Add Manufecture</a>
        </li>
    </ul>
    <?php 
        $category = App\Models\Categorie::where('publication_status',1)->get();
        $manufacture = App\Models\Manufecture::where('manpublication_status',1)->get();
    ?>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Manufecture</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
              <p class="alert alert-success">
                <?php
                $message = Session::get('message');
                  if($message){
                    echo $message;
                    Session::put("message", null);
                  }
                ?>
              </p>

              @if (count($errors) > 0)
              <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif
                <form action="{{url('/insert-slider')}}" class="form-horizontal" enctype="multipart/form-data" method="POST">
                  @csrf
                  <fieldset>
                    
                      <div class="control-group">
                        <label class="control-label">Select Slider Image</label>
                        <div class="controls">
                          <input type="file" name="image" required class="form-control"  />
                        </div>
                      </div>


                    <div class="control-group">
                      <label class="control-label" for="date01">Publication Status</label>
                      <div class="controls">
                        <input type="checkbox" class="input-xlarge" name="publication_status" value="1" >
                      </div>
                    </div>
                    <div class="form-actions">
                      <button type="submit" class="btn btn-primary">Save changes</button>
                      <button type="reset" class="btn">Cancel</button>
                    </div>
                  </fieldset>
                </form>   

            </div>
        </div><!--/span-->

    </div><!--/row-->
@endsection