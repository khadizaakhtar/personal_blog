<div id="contact_form">
                
                <h3>Contact Form</h3>
                
                <form method="post" name="contact" action="#">
                    
                        <input type="hidden" name="post" value="Send" />
                        <label for="author">Name:</label>
                        <input type="text" id="author" name="author" class="required input_field" />
                        <div class="cleaner_h10"></div>
                        
                        <label for="email">Email:</label> 
                        <input type="text" id="email" name="email" class="validate-email required input_field" />
                        <div class="cleaner_h10"></div>
                        
                        <label for="phone">Phone:</label> 
                        <input type="text" name="phone" id="phone" class="input_field" />
                        <div class="cleaner_h10"></div>
                        
                        <label for="text">Message:</label> 
                        <textarea id="text" name="text" rows="0" cols="0" class="required"></textarea>
                        <div class="cleaner_h10"></div>
                        
                        <input type="submit" class="submit_btn" name="submit" id="submit" value="Send" />
                        <input type="reset" class="submit_btn" name="reset" id="reset" value="Reset" />
                    
                    </form>
                
                </div> 