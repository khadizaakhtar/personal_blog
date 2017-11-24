<div>
<div class="post_section">
      <?php
      foreach($published_post_for_home_content as $v_post_for_home_content){
      ?>
    <h6>Posted By:<?php echo $v_post_for_home_content->author_name;?></h6>
    <h6>Date:<?php echo $v_post_for_home_content->post_date_time;?></h6>
   <h3><?php echo $v_post_for_home_content->post_title;?></h3>
   <h6><?php echo $v_post_for_home_content->post_summary;?></h6>
   <p>
        <img src="<?php echo base_url().$v_post_for_home_content->post_image;?>" width="400" height="200">
    </p>
    <p><?php echo $v_post_for_home_content->post_description;?></p>
   
</div>
 <div>
  <form action="<?php echo base_url();?>welcome/show_comments/<?php echo $v_post_for_home_content->post_id;?>" method="post">
       <tr>
             <textarea cols="50" rows="4" name="comments_description"></textarea>
      </tr>
    </form>  
 </div>   
<div>
    <?php 
   $user_id=$this->session->userdata('user_id');
   if($user_id!=NULL){
   ?>
    <form action="<?php echo base_url();?>welcome/save_comments" method="post">
        <table>
            <tr>
                <td>Post Your Comments</td>
            </tr>
            <tr>
               <td><textarea cols="50" rows="4" name="comments_description"></textarea></td>
            </tr>
            <tr>
                 <td><input type="submit" class="submit_btn" name="submit" id="submit" value="Post Comments"/></td>
            </tr>
        </table>
    </form>
    <?php }
    else{   
    ?>
      <h6>post comments after login</h6>
    <?php }?>  
</div>
    <?php }?>
</div>