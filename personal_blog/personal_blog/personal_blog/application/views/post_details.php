<div>
    <div>
    <?php 
    foreach($all_post_info as $v_info){
    ?>
    <h6>Posted By:<?php echo $v_info->author_name;?></h6>
    <h6>Date:<?php echo $v_info->post_date_time;?></h6>
    <h3><?php echo $v_info->post_title;?>:</a></h3>
    <p>
        <img src="<?php echo base_url().$v_info->post_image;?>" width="300" height="100">
    </p>
    <h5><?php echo $v_info->post_summary;?><a href="<?php echo base_url();?>welcome/details_for_post/<?php echo $v_info->post_id;?>">Read More....</a></h5>
    <?php }?>
    </div>
 </div>