<div id="page-wrapper">

            <div class="row">
                 <!--  page header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Manage Post Table</h1>
                </div>
                 <!-- end  page header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Manage Post Table
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                             <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Post Id</th>
                                            <th>Category Name</th>
                                            <th>Post Title</th>
                                            <th>Publication Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                      foreach ($all_post as $v_post){
                                      ?>  
                                       <tr> 
                                           <td><?php echo $v_post->post_id;?></td>
                                           <td><?php echo $v_post->category_name;?></td>
                                           <td><?php echo $v_post->post_title;?></td>
                                           <td>
                                               <?php 
                                               if($v_post->publication_status==1){
                                                   echo 'published';
                                                   
                                               }
                                               else{
                                                   echo 'unpublished';
                                               }
                                               ?>
                                           </td>
                                           <td>
                                               <?php
                                               if($v_post->publication_status==1){
                                               ?>
   <a href="<?php echo base_url();?>super_admin/unpublished_post/<?php echo $v_post->post_id;?>">unpublished|</a>
                                            <?php }
                                            else{
                                            ?>
   <a href="<?php echo base_url();?>super_admin/published_post/<?php echo $v_post->post_id;?>">published|</a>
                                            <?php }?>
   <a href="<?php echo base_url();?>super_admin/edit_post/<?php echo $v_post->post_id;?>">Edit|</a>
           <a href="<?php echo base_url();?>super_admin/delete_post/<?php echo $v_post->post_id;?>">Delete</a>
                                           </td>
                                           <?php }?>
                                       </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                     <!-- End  Kitchen Sink -->
                </div>
                
               
            </div>
        </div>
        <!-- end page-wrapper -->

    