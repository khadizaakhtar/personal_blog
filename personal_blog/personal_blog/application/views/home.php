<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitiona
    .dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $title;?></title>
        <meta name="keywords" content="Red Blog Theme, Free CSS Templates" />
        <meta name="description" content="Red Blog Theme - Free CSS Templates by templatemo.com" />
        <link href="<?php echo base_url();?>templatemo_style.css" rel="stylesheet" type="text/css" />

    </head>
    <body>

        <div id="templatemo_top_wrapper">
            <div id="templatemo_top">

                <div id="templatemo_menu">

                    <ul>
                        <li><a href="<?php echo base_url();?>" class="current">Home</a></li>
                        <li><a href="<?php echo base_url();?>welcome/sign_up">Sign Up</a></li>
                        <li><a href="<?php echo base_url();?>welcome/log_in">Log In</a></li>
                        <li><a href="<?php echo base_url();?>welcome/contact">Contact Us</a></li>
                    </ul>    	

                </div> <!-- end of templatemo_menu -->

                <div id="twitter">
                    <a href="#">follow us <br />
                        on twitter</a>
                </div>

            </div>
        </div>

        <div id="templatemo_header_wrapper">
            <div id="templatemo_header">

                <div id="site_title">
                    <h1><a href="http://www.templatemo.com" target="_parent"><strong>Personal Blog</strong>
                            <span>Different Category Article Here</span></a></h1>
                </div>

            </div>
        </div>

        <div id="templatemo_main_wrapper">
            <div id="templatemo_main">
                <div id="templatemo_main_top">

                    <div id="templatemo_content">
                       <?php echo $maincontent;?>  

                    </div>
                    <div id="templatemo_sidebar">
                        <h4>RECENT POSTS</h4>
                        <ul class="templatemo_list">
                            <?php 
                           foreach($all_published_post as $v_post){
                           ?>
      <li><a href="<?php echo base_url();?>welcome/recent_post/<?php echo $v_post->post_id;?>"><?php echo $v_post->post_title;?></a></li>
                             <?php }?>                  
                        </ul>

                        <div class="cleaner_h40"></div>                     
                        <h4>CATEGORIES</h4>
                        <ul class="templatemo_list">
                            <?php 
                            foreach($all_published_category as $v_category){
                            ?>
  <li><a href="<?php echo base_url();?>welcome/post_category/<?php echo $v_category->category_id;?>"><?php echo $v_category->category_name;?></a></li>
                            <?php }?>
                        </ul>

                        <div class="cleaner_h40"></div>
                            <h4>RECENT COMMENTS</h4>
                    </div>

                    <div class="cleaner"></div>
                </div>

            </div>

            <div id="templatemo_main_bottom"></div>

        </div>

        <div id="templatemo_footer">

            Copyright © 2048 <a href="index.html">Your Company Name</a> | 
            <a href="http://www.iwebsitetemplate.com" target="_parent">Website Templates</a> by
            <a href="http://www.templatemo.com" target="_parent">Free CSS Templates</a>

        </div>
        <div align=center>This template  downloaded form
        <a href='http://all-free-download.com/free-website-templates/'>free website templates</a></div></body>
</html>