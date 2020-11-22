<?php
	$cancelButton = "Cancel";
?>
<div class="cancelButton">
	<a class="btn btn-secondary" href="../productsTest.php?language=<?php echo htmlspecialchars($_COOKIE['language']); ?>">
      	<?php
      	    echo $cancelButton
      	?>
    </a>
</div>