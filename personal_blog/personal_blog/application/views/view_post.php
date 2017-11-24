<div>
    <?php 
    foreach($all_post_info as $v_info){
    ?>
    <h3><a href="<?php echo base_url();?>welcome/post_details/<?php echo $v_info->category_id;?>"><?php echo $v_info->post_title;?></a></h3>
    <?php }?>
</div>