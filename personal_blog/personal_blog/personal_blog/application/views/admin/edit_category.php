<div id="page-wrapper">
    <div class="row">
        <!-- page header -->
        <div class="col-lg-12">
            <h1 class="page-header">Edit Category Forms</h1>
        </div>
        <!--end page header -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!-- Form Elements -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edit Category
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
           <form role="form" name="edit_category_form"action="<?php echo base_url();?>super_admin/update_category" method="post">
                                <div class="form-group">
                                    <label>Category Name</label>
  <input class="form-control" name="category_name" type="text" value="<?php echo $category_info->category_name;?>">
  <input class="form-control" name="category_id" type="hidden" value="<?php echo $category_info->category_id;?>">
                                    
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
                                <button type="submit" class="btn btn-primary">Update Category</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End Form Elements -->
        </div>
    </div>
</div>
<script type='text/javascript'>
                document.forms['edit_category_form'].elements['publication_status'].value='<?php echo $category_info->publication_status;?>';
                </script>