<?php
  $noCompleteForm = "Form is not complete";
  $cancelButton = "Cancel";
  $okButton = "Ok";
?>  

<div class="modal-dialog" role="document">
	<div class="modal-content">	
	  <div class="modal-body" id="product">
	  	<?php echo $noCompleteForm; ?>
	  </div>
	  <div class="modal-footer">
	  	<form method="post">
	    		<input type="button" 
	               class="btn btn-secondary" 
	               data-dismiss="modal" 
	               value="<?php echo $cancelButton; ?>" />
	
	        <input type="submit"
	    		       name="ok" 
	    		       class="btn btn-primary"
	    		       value="<?php echo $okButton; ?>" />
	    	<?php
	        
		    	if(isset($_POST['ok'])){
		    		header('Location: ../EditCreatePage/editCreatePage.php');
            		exit;
		    	}
		    ?>
	   	</form>
	  </div>
	</div>
</div>