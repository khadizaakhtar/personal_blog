
                <div id="contact_form">
                <h3>Sign Up Form</h3>
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
                <form method="post" action="<?php echo base_url();?>welcome/save_register">
                    
                        <input type="hidden" name="post" value="Send" />
                        <label for="author">Name:</label>
                        <input type="text" id="author" name="user_name" class="required input_field" />
                        <div class="cleaner_h10"></div>
                        
                        <label for="email">Email:</label>
            <input type="email" id="email" name="user_email_address" class="validate-email required input_field" />
                        <div class="cleaner_h10"></div>
                        
                        <label for="phone">Password:</label> 
                        <input type="password" name="user_password" id="password" class="input_field" />
                        <div class="cleaner_h10"></div>
                        <label for="phone">Phone Number:</label> 
                        <input type="text" name="user_phone_number" class="input_field" />
                        <div class="cleaner_h10"></div>
                        <input type="submit" class="submit_btn" name="submit" id="submit" value="Send" />
                        <input type="reset" class="submit_btn" name="reset" id="reset" value="Reset" />
                    
                    </form>
                
                </div> 