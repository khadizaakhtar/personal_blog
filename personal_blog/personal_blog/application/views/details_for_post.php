<div>
    <div>
    <?php 
    foreach($all_post as $v_info){
    ?>
    <h6>Posted By:<?php echo $v_info->author_name;?></h6>
    <h6>Date:<?php echo $v_info->post_date_time;?></h6>
    <h3><?php echo $v_info->post_title;?>:</a></h3>
    <h5><?php echo $v_info->post_summary;?></a></h5>
    <p>
        <img src="<?php echo base_url().$v_info->post_image;?>" width="300" height="100">
    </p>
    <p><?php echo $v_info->post_description;?></p>
    <p><a href="<?php echo base_url();?>welcome/sign_up">sig up</a> or <a href="<?php echo base_url();?>welcome/log_in"> login</a> for comments</p>
      </div>
    <div>
       <?php 
   $user_id=$this->session->userdata('user_id');
   if($user_id!=NULL){
   ?>
   <form action="#" method="post">
        <table>
            <tr>
                <td>Post Your Comments</td>
            </tr>
            <tr>
               <td><textarea cols="50" rows="4"></textarea></td>
            </tr>
            <tr>
                 <td><input type="submit" class="submit_btn" name="submit" id="submit" value="Post Comments" /></td>
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