<?php
  $productCreate = "You edit the product !!";
  $okButton = "Ok";
?>  

<div class="modal-dialog" role="document">
	<div class="modal-content">	
	  <div class="modal-body" id="product">
	  	<?php echo $productCreate; ?>
	  </div>
	  <div class="modal-footer">
	  	<a class="btn btn-primary" href="../productsTest.php?language=<?php echo htmlspecialchars($_COOKIE['language']); ?>">
	  		<?php echo $okButton; ?>
	  	</a>
	  </div>
	</div>
</div>