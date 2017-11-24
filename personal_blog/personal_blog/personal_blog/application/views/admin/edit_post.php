<div id="page-wrapper">
    <div class="row">
        <!-- page header -->
        <div class="col-lg-12">
            <h1 class="page-header">Edit Post Forms</h1>
        </div>
        <!--end page header -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!-- Form Elements -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edit Post
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
                  <form role="form" name="edit_post_form" action="<?php echo base_url();?>super_admin/update_post" method="post">
                                <div class="form-group">
                                    <label>Post Title</label>
            <input class="form-control" name="post_title" type="text" value="<?php echo $post_info->post_title;?>">
            <input class="form-control" name="post_id" type="hidden" value="<?php echo $post_info->post_id;?>">
                                  </div>
                                <div class="form-group">
                                            <label>Category Name</label>
                                            <select class="form-control" name="category_id">
                                                <option>select one</option>
                                                
                                               </select>
                                  </div>
                                <div class="form-group"><label>Post Summary</label><textarea class="form-control" rows="3" name="post_summary"><?php echo $post_info->post_summary;?></textarea>
                                  </div>
                                <div class="form-group">
                                            <label>Post Description</label>
                                        <textarea class="form-control" rows="3" name="post_description"><?php echo $post_info->post_description;?></textarea>
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
<script type='text/javascript'>
                document.forms['edit_post_form'].elements['publication_status'].value='<?php echo $post_info->publication_status;?>';
                </script>