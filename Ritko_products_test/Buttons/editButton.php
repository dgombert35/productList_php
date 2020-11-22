<div class="editButton">
	<input class="btn btn-primary" type="submit" name="submit" value="<?php echo $editLabel; ?>"/>
	<?php
	
	 	if(isset($_POST['submit'])) {
	
			$languages = $db->query('SELECT * FROM languages');
	
			while($language = $languages->fetch()){
			    $language_id = $language['languages_id'];

			    $updateProductDescriptionInformations = 'UPDATE products_description SET products_description_name = :productName, products_description_short_description 	= :productShortDescription, products_description_description = :productDescription WHERE products_id = :id AND languages_id = :languageId';
			    $updateProduct = $db->prepare($updateProductDescriptionInformations);
   				$updateProduct->bindParam(':productName', $_POST['productName'.$language_id]);
   				$updateProduct->bindParam(':productShortDescription', $_POST['productShortDescription'.$language_id]);
   				$updateProduct->bindParam(':productDescription', $_POST['productDescription'.$language_id]);
   				$updateProduct->bindParam(':id', $products_id);
   				$updateProduct->bindParam(':languageId', $language_id);

   				try{	
			    	$updateProduct->execute();
	 	   		} catch(PDOException $e) {
	 	   		    die($e->getMessage());
	 	   		}

	 	   		if(!$updateProduct){
   					$message =" Invalid request : ".mysql_error(). "\n";
   					$message .= "complete request : " . $slqCreateProduct;
					die($message);
   				}else {
					echo "<script type='text/javascript'>
        		    $(document).ready(function(){
        		    $('#exampleModal').modal('show');
        		    });
        		    </script>";
		
	 	   			$updateProduct->closeCursor();
			    }
	 	   	}
	
			$languages->closeCursor();
	 	}
	?>	
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php 
    	include("../Alerts/popupProductEdit.php");
    ?>
</div>