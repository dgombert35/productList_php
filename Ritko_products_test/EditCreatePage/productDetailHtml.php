<div class="productInformationsDetails col-md-4">
	<div class="languageChoice row">
		<label class="languageLabel col-md-4">
			<?php
			    echo $languageLabel;
			?>
		</label>
		<input class="col-md-8 languageValue" type="text" name="language" value="<?php echo $langValue; ?>" readonly/>
	</div>
	<div class="productName row">
		<label class="nameLabel col-md-4">
			<?php
				echo $nameLabel;
			?>
		</label>
		<input class="col-md-8" type="text" name="productName<?php echo $language_id; ?>" value="<?php echo $productName; ?>"/>	
	</div>
	<div class="shortDescription row">
		<label class="shortDescriptionLabel">
			<?php
				echo $shortDescriptionLabel;
			?>
		</label>
		<textarea class="ckeditor" name="productShortDescription<?php echo $language_id; ?>" id="myShortTextarea">
			<?php echo $productShortDescription; ?>
		</textarea>
	</div>
	<div class="description row">
		<label class="descriptionLabel">
			<?php
				echo $descriptionLabel;
			?>
		</label>
		<textarea class="ckeditor" name="productDescription<?php echo $language_id; ?>" id="myDescribeTextarea">
			<?php echo $productDescription; ?>
	</textarea>
	</div>
</div>