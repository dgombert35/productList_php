<?php
	$createButtonName = "Create";

	function addReferencePriceInDb(){
		
		include("../dbConnect.php");

		$sqlRequestInsertIntoProduct = 'INSERT INTO products (products_reference, products_price) VALUES (:productReference, :productPrice)';
		$addPriceRef = $db->prepare($sqlRequestInsertIntoProduct);
   		$addPriceRef->bindParam(':productReference', $_POST['reference']);
   		$addPriceRef->bindParam(':productPrice', $_POST['price']);

   		try {
    		$addPriceRef->execute();
		}catch(PDOException $e) {
		    die($e->getMessage());
		}

		$addPriceRef->closeCursor();
	}

	function getProductId(){
		
		include("../dbConnect.php");

		$newProductId = '';

		$sqlRequestGetProductId = 'SELECT products_id FROM products WHERE products_reference = ? AND products_price = ?';
		$getProdcutId = $db->prepare($sqlRequestGetProductId);

		try{
			$getProdcutId->execute(array(htmlspecialchars($_POST['reference']), htmlspecialchars($_POST['price'])));
		} catch(PDOException $e) {
		    die($e->getMessage());
		}

		while ($getNewProductId = $getProdcutId->fetch()){
			$newProductId = $getNewProductId['products_id'];
		}

		$getProdcutId->closeCursor();

		return $newProductId;
	}

	function productCreate($isLanguageId){

		$isProductId = getProductId();

		include("../dbConnect.php");

		$slqCreateProduct = 'INSERT INTO products_description (products_id, languages_id, products_description_name, products_description_short_description, products_description_description)	VALUES (:productId, :languageId, :productName, :productShortDescription, :productDescription)';

		$addProduct = $db->prepare($slqCreateProduct);
   		$addProduct->bindParam(':productId', $isProductId);
   		$addProduct->bindParam(':languageId', $isLanguageId);
   		$addProduct->bindParam(':productName', $_POST['productName'.$isLanguageId]);
		$addProduct->bindParam(':productShortDescription', $_POST['productShortDescription'.$isLanguageId]);
		$addProduct->bindParam(':productDescription', $_POST['productDescription'.$isLanguageId]);
		
   		try {
    		$addProduct->execute();
		}catch(PDOException $e) {
		    die($e->getMessage());
		}

   		if(!$addProduct){
   			$message =" Invalid request : ".mysql_error(). "\n";
   			$message .= "complete request : " . $slqCreateProduct;
			die($message);
   		}else {
			echo "<script type='text/javascript'>
            $(document).ready(function(){
            $('#exampleModal').modal('show');
            });
            </script>";
   		}  

   		$addProduct->closeCursor();
    }
?>

<div class="editButton">
	<input class="btn btn-success" type="submit" name="createProduct" class="submit" value="<?php echo $createButtonName ?>"/>
	<?php 
		if(isset($_POST['createProduct'])){
			addReferencePriceInDb();

			$sqlGetIdsLanguages =$db->prepare('SELECT languages_id FROM languages');

			try{
				$sqlGetIdsLanguages->execute();
			}catch(PDOException $e) {
				    die($e->getMessage());
			}
			$producNotCreate = true;
			while(($getId = $sqlGetIdsLanguages->fetch()) && $producNotCreate){
				$languagesId = $getId['languages_id'];

				if(!empty($_POST['productName'.$languagesId]) && !empty($_POST['productShortDescription'.$languagesId]) && !empty($_POST['productDescription'.$languagesId])){
					productCreate($languagesId);
					$producNotCreate = false;
				} else {
					echo "<script type='text/javascript'>
					$(document).ready(function(){
					$('#emptyForm').modal('show');
					});
					</script>";
				}
			}
			$sqlGetIdsLanguages->closeCursor();	
			
		}
	?>
</div>
<div class="modal fade" id="emptyForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php 
    	include("../Alerts/alertEmptyCreateForm.php");
    ?>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php 
    	include("../Alerts/popupProductCreate.php");
    ?>
</div>