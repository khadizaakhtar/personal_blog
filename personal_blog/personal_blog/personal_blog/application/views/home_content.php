
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
    <?php }?>
</div>