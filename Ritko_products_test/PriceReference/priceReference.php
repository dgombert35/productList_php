<script type="text/javascript">

	$(document).ready(function() {
    $("#price").keyup(function (event) {
                var value = jQuery(this).val();
                value = value.replace(/[^0-9]+/g, '');
                jQuery(this).val(value);
            });
	});
</script>
		
<div class="reference row">
	<label class="referenceLabel col-md-4">
		<?php
			echo $referenceLabel;
		?>
	</label>
	<?php
		if(isset($_GET['id'])){
			echo '<p class="col-md-4 priceRefInformations">'.$referenceName.'</p>';
		}else {
			echo "<input type='text' name='reference' id='reference' class='col-md-4 createPriceReference' />";
		}
	?>
</div>
<div class="price row">
	<label class="priceLabel col-md-4">
		<?php
			echo $priceLabel;
		?>
	</label>
	<?php
		if(isset($_GET['id'])){
			echo '<p class="col-md-4 priceRefInformations">'.$price.'</p>';
		}else {
	?>
	<input name="price" id="price" class="col-md-4 createPriceReference" />
	<?php
		}
	?>
	
</div>