<?php
include "../include/head.php";
?>
<div class="main-panel">
    <div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Staff Time Table</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Staff Time Table</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

<!-- Main content -->
<section class="content">
        <div class="container-fluid">
          <!-- SELECT2 EXAMPLE -->
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Staff Time Table</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
              </div>
            </div>
            <form role="form" method="POST" id="">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12" id="error_section"></div>

                 
                  <!-- <div class="col-md-3">
                    <div class="form-group">
                      <label>Timings</label> 
                    </div>
                 </div> -->
  
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Department</label> 
                  <select class="form-control"><option value="">Select</option>
                  <option value="">Teaching Department</option>
                  <option value="">Medical Department</option>
                  <option value="">Transport Department</option>
                  <option value="">Non Teaching Department</option>
                </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                      <label>Post</label> 
                  <select class="form-control"><option value="">Select</option>
                  <option value="">Principal</option>
                  <option value="">Class Teacher</option>
                  <option value="">Subject Teacher</option>
                  <option value="">Guest Teacher</option>
                  <option value="">Sports Teacher</option>
                </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                      <label></label> 
                      <input type="submit" class="btn btn-primary" style="margin-top: 29px;">

   
                    </div>
                </div>
                </div>

              </div>

              <!-- /.card-header -->
              <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div id="demo">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S No.</th>
                                            <th>Staff Name</th>
                                            <th class="project-actions text-center">Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>1</td>
                                            <td>Mr Kumar</td>
                                           

                                            <td class="project-actions text-center">
                                                <button class="btn btn-info btn-sm" onclick="">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>

                                                </button>
                                                <button class="btn btn-danger btn-sm" onclick="">
                                                    <i class="fas fa-trash">
                                                    </i>

                                                </button>
                                            </td>
                                        </tr>


                                   <tr>
                                            <td>2</td>
                                            <td>Jyoti Rani</td>
                                           

                                            <td class="project-actions text-center">
                                                <button class="btn btn-info btn-sm" onclick="">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>

                                                </button>
                                                <button class="btn btn-danger btn-sm" onclick="">
                                                    <i class="fas fa-trash">
                                                    </i>

                                                </button>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td>3</td>
                                            <td>Ajay kumar</td>
                                           

                                            <td class="project-actions text-center">
                                                <button class="btn btn-info btn-sm" onclick="">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>

                                                </button>
                                                <button class="btn btn-danger btn-sm" onclick="">
                                                    <i class="fas fa-trash">
                                                    </i>

                                                </button>
                                            </td>
                                        </tr>
                                        
                                       
                                        


                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
           

        </div>
        </form> 
              <!-- /.card-body -->


          </div>

        
        </div>
      </section>
      <!-- /.content -->

       
</div>



<?php include "../include/foot.php" ?>