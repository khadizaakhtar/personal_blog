  <div id="page-wrapper">

            <div class="row">
                 <!--  page header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Manage Category Table</h1>
                </div>
                 <!-- end  page header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Manage Category Table
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Category Id</th>
                                            <th>Category Name</th>
                                            <th>Publication Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php 
                                    foreach ($all_category as $v_category){
                                    ?>
                                    <tbody>
                                        <td><?php echo $v_category->category_id;?></td>
                                        <td><?php echo $v_category->category_name;?></td>                                                                    <td>
                                            <?php 
                                            if($v_category->publication_status==1){
                                                echo 'published';
                                            }
                                            else{
                                                echo 'unpublished';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                           <?php 
                                           if($v_category->publication_status==1){
                                           ?>
        <a href="<?php echo base_url();?>super_admin/unpublished_category/<?php echo $v_category->category_id;?>">Unpublished|</a>
                                            <?php }
                                            else{
                                            ?>
            <a href="<?php echo base_url();?>super_admin/published_category/<?php echo $v_category->category_id;?>">Published|</a>
                                            <?php }?>
       <a href="<?php echo base_url();?>super_admin/edit_category/<?php echo $v_category->category_id;?>">Edit|</a>
                                            <a href="<?php echo base_url();?>super_admin/delete_category/<?php echo $v_category->category_id;?>">Delete|</a>
                                        </td>
                                    <?php }?>
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

    