          <div id="contact_form">
                
                <h3>Log_In Form</h3>
                <div>
                    <h3 style="color:red">
                        <?php 
                        $exc=$this->session->userdata('exception');
                        if(isset($exc)){
                          echo $exc;
                          $this->session->unset_userdata('exception');
                        }
                        ?>
                    </h3>
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
                <form method="post" action="<?php echo base_url();?>welcome/save_login">
                        <label for="email">Email:</label>
              <input type="email" id="email" name="user_email_address" required="1" regexp="JSVAL_RX_EMAIL" class="validate-email required input_field" /><span class="required"><font color="red">*</font></span>
                        <div class="cleaner_h10"></div>
                        <input type="hidden" name="post" value="Send" />
                        <label for="author">Password:</label> 
                        <input type="password" id="password" name="user_password" class="required input_field" required="1" regexp="JSVAL_RX_ALPHA_NUMERIC_WITHOUT_HIFANE"/><span class="required"><font color="red">*</font></span>
                        <div class="cleaner_h10"></div>
                        <input type="submit" class="submit_btn" name="submit" id="submit" value="Send" />
                    
                    </form>
                
                </div> 