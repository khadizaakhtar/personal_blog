<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Ajax Search</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript">
<!--
//Create a boolean variable to check for a valid Internet Explorer instance.
var xmlhttp = false;
//Check if we are using IE.
try {
//If the Javascript version is greater than 5.
xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");

//alert ("You are using Microsoft Internet Explorer.");
} catch (e) {
    
//If not, then use the older active x object.
try {
//If we are using Internet Explorer.
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
//alert ("You are using Microsoft Internet Explorer");
} catch (E) {
//Else we must be using a non-IE browser.
xmlhttp = false;
}
}
//If we are using a non-IE browser, create a javascript instance of the object.
if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
xmlhttp = new XMLHttpRequest();
//alert ("You are not using Microsoft Internet Explorer");
}

function makerequest(given_email,objID)
 {
	//alert(given_text);
        //var obj = document.getElementById(objID);
        serverPage='<?php echo base_url();?>welcome/check_ajax_email/'+given_email;
	xmlhttp.open("GET", serverPage);
	xmlhttp.onreadystatechange = function()
	 {
	//alert(xmlhttp.readyState);
	//alert(xmlhttp.status);
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
		 {
			//alert(xmlhttp.responseText);
                        document.getElementById(objID).innerHTML = xmlhttp.responseText;
                        if(xmlhttp.responseText=='Already Exists !'){
                          document.getElementById('cbutton').disabled=true;  
                        }
                        if(xmlhttp.responseText=='Avaiable !'){
                          document.getElementById('cbutton').disabled=false;  
                        }
			//document.getElementById(objcw).innerHTML = xmlhttp.responseText;
		 }
	}
xmlhttp.send(null);
}
</script>
               
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
                <form method="post" action="<?php echo base_url();?>welcome/save_register" onsubmit="return validateStandard(this)">
                    
                        <input type="hidden" name="post" value="Send" />
                        <label for="author">Name:</label>
                        <input type="text" id="author" name="user_name" required="1" regexp="JSVAL_RX_ALPHA" class="required input_field"/><span class="required"><font color="red">*</font></span>
                        <div class="cleaner_h10"></div>
                        
                        <label for="email">Email:</label>
            <input type="email" id="email" name="user_email_address" class="validate-email required input_field" required="1" regexp="JSVAL_RX_EMAIL" onblur="makerequest(this.value,'res')"/><span id="res"></span><span class="required"><font color="red">*</font></span>
                        <div class="cleaner_h10"></div>
                        
                        <label for="phone">Password:</label> 
                        <input type="password" name="user_password" id="password" required="1" regexp="JSVAL_RX_ALPHA_NUMERIC_WITHOUT_HIFANE" class="input_field" /><span class="required"><font color="red">*</font></span>
                        <div class="cleaner_h10"></div>
                        <label for="phone">Phone Number:</label> 
                        <input type="text" name="user_phone_number" class="input_field" />
                        <div class="cleaner_h10"></div>
                        <input type="submit" class="submit_btn" name="submit" id="cbutton" value="Send" />
                    
                    </form>
                
                </div> 