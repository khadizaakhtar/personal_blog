<div id="page-wrapper">
    <div class="row">
        <!-- page header -->
        <div class="col-lg-12">
            <h1 class="page-header">Add Category Forms</h1>
        </div>
        <!--end page header -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!-- Form Elements -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add Category
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div>
                                <h3 style="color:green">
                                    <?php 
                                    $msg=$this->session->userdata('message');
                                   if(isset($msg)){
                                       echo $msg;
                                       $this->session->unset_userdata('message');
                                   }
                                    ?>
                                    
                                </h3>
                            </div>
                      <form role="form" action="<?php echo base_url();?>super_admin/save_category" method="post">
                                <div class="form-group">
                                    <label>Category Name</label>
                                    <input class="form-control" name="category_name" type="text">
                                    <p class="help-block">category name here.</p>
                                </div>
                                <div class="form-group">
                                    <label>Publication Status</label>
                                    <div class="radio">
                                        <label>
                            <input type="radio" name="publication_status" id="optionsRadios1" value="1">Published
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                          <input type="radio" name="publication_status" id="optionsRadios2" value="0">Un Published
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save Category</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End Form Elements -->
        </div>
    </div>
</div>
<!-- end page-wrapper -->