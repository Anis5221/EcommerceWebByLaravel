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
              <p class="alert-success">
                <?php
                $message = Session::get('message');
                  if($message){
                    echo $message;
                    Session::put("message", null);
                  }
                ?>
              </p>
                <form action="{{url('/insert-manufecture')}}" class="form-horizontal" method="POST">
                  @csrf
                  <fieldset>
                    
                    <div class="control-group">
                      <label class="control-label" for="date01">Manufacture Name</label>
                      <div class="controls">
                        <input type="text" class="input-xlarge" name="manufecture_name" required >
                      </div>
                    </div>

                            
                    <div class="control-group hidden-phone">
                      <label class="control-label" for="textarea2">Manufecture Description</label>
                      <div class="controls">
                        <textarea class="cleditor" name="manufecture_description" rows="3" required></textarea>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" for="date01">Publication Status</label>
                      <div class="controls">
                        <input type="checkbox" class="input-xlarge" name="manpublication_status" value="1" >
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