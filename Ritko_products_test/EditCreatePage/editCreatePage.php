<head>
	<?php
		include("../headHtml.php");
	?>
	<link rel="stylesheet" href="edit_style.css" />
    
</head>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>

<script type="text/javascript">

    CKEDITOR.replace('myDescribeTextarea');
    CKEDITOR.replace('myShortTextarea');

</script>
<?php
	include("../dbConnect.php");
	
	$editPageTitle = "Edit Product";
	$nameLabel = "Name";
	$referenceLabel = "Reference";
	$priceLabel = "Price";
	$shortDescriptionLabel = "Short description";
	$descriptionLabel = "Description";
	$editLabel = "Edit";
	$languageLabel = "Language ";

	$language_id = '';

	function insertDbProductsDescriptionWithNewLanguage($productId, $languageId){
		
		include("../dbConnect.php");

		$sqlRequestInsertDb = 'INSERT INTO products_description (products_id, languages_id, products_description_name, products_description_short_description, products_description_description) VALUES (:productId, :languageId, :productName, :productShortDescription, :productDescription)';

		$null = '';
		$addNewLine = $db->prepare($sqlRequestInsertDb);
   		$addNewLine->bindParam(':productId', $productId);
   		$addNewLine->bindParam(':languageId', $languageId);
   		$addNewLine->bindParam(':productName', $null);
   		$addNewLine->bindParam(':productShortDescription', $null);
   		$addNewLine->bindParam(':productDescription', $null);

   		try {
    		$addNewLine->execute();
		}catch(PDOException $e) {
		    die($e->getMessage());
		}

		$addNewLine->closeCursor();
	}

	function checkLanguagesIdForProductId($productId){
		include("../dbConnect.php");

		$sqlRequestGetLanguagesIdForProductId = 'SELECT languages_id FROM products_description WHERE products_id ='.$productId;

		try{
			$getIdsFromProductId = $db->query($sqlRequestGetLanguagesIdForProductId);	
		}catch(PDOException $e) {
    	    die($e->getMessage());
    	}

		$languagesIdsArray = array();
		foreach  ($getIdsFromProductId as $row) {
		    $languagesIdsArray[] = $row['languages_id'];
		}

		$sqlLanguagesIdRequest = $db->query('SELECT languages_id FROM languages');

    	while($arrayLanguagesIds = $sqlLanguagesIdRequest->fetch()){
    		if(!(in_array($arrayLanguagesIds['languages_id'], $languagesIdsArray))){
    			insertDbProductsDescriptionWithNewLanguage($productId, $arrayLanguagesIds['languages_id']);
    		}
    	}

    	$getIdsFromProductId->closeCursor();
    	$sqlLanguagesIdRequest->closeCursor();
	}

?>
<div class="editPage">
	<div class="editPageTitle">
		<h1><?php echo $editPageTitle; ?></h1>
	</div>
	<form class="editForm container" method="post" action="">
	<?php

		$products_id = '';

		if(isset($_GET['id'])){

			$productDescriptionId = htmlspecialchars($_GET['id']);

			$sqlRequestGetPriceAndReference = 'SELECT products_reference, products_price, products.products_id FROM products_description, products WHERE products.products_id = products_description.products_id AND products_description.products_description_id = ?';
			$getProductPriceRefWithId = $db->prepare($sqlRequestGetPriceAndReference);

			try{
				$getProductPriceRefWithId->execute(array($productDescriptionId));	
			}catch(PDOException $e) {
    		    die($e->getMessage());
    		}
			
			while($productDetailsDatas = $getProductPriceRefWithId->fetch()){
		
					$referenceName = $productDetailsDatas['products_reference'];
					$price = $productDetailsDatas['products_price'];
					$products_id = $productDetailsDatas['products_id'];
		
					include("../PriceReference/priceReference.php");
			}
			$getProductPriceRefWithId->closeCursor();
			checkLanguagesIdForProductId($products_id);
		}else {
			$referenceName = '';
			$price = '';

			include("../PriceReference/priceReference.php");
		}
		
	?>
		<div class="productInformations row">
			<?php
				try{
					$languages = $db->query('SELECT * FROM languages');	
				}catch(PDOException $e) {
    			    die($e->getMessage());
    			}
				
				while($language = $languages->fetch()){
	        	    $langValue = $language['languages_name'];
	        	    $language_id = $language['languages_id'];

	        	    include('getValuesFromProductsLanguagesTable.php');
	        	}
	        	
	        	$languages->closeCursor();
	        ?>
	    </div>
		<div class="buttons">
			<?php
				if(isset($_GET['id'])){
					include('../Buttons/editButton.php');
				}else {
					include('../Buttons/createButton.php');
				}
			?>
		</form>
		<?php
			include("../Buttons/cancelButton.php");
		?>
	</div>
</div>