<div id="page-wrapper">
    <div class="row">
        <!-- page header -->
        <div class="col-lg-12">
            <h1 class="page-header">Add Post Forms</h1>
        </div>
        <!--end page header -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!-- Form Elements -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add Post
                </div>
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
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
<form role="form" action="<?php echo base_url();?>super_admin/save_post" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Post Title</label>
                                    <input class="form-control" name="post_title">
                                  </div>
                                <div class="form-group">
                                            <label>Category Name</label>
                                            <select class="form-control" name="category_id">
                                                <option>select one</option>
                                                <?php 
                                                 foreach ($all_published_category as $v_category){
                                                ?>
          <option value="<?php echo $v_category->category_id;?>"><?php echo $v_category->category_name;?></option>
                                                <?php }?>
                                            </select>
                                  </div>
                                <div class="form-group">
                                          <label>Post Summary</label>
                                         <textarea class="form-control" rows="3" name="post_summary"></textarea>
                                  </div>
                                <div class="form-group">
                                            <label>Post Description</label>
                                        <textarea class="form-control" rows="3" name="post_description"></textarea>
                                  </div>
                                <div class="form-group">
                                            <label>File input</label>
                                            <input type="file" name="post_image">
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
                                <button type="submit" class="btn btn-primary">Save Post</button>
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