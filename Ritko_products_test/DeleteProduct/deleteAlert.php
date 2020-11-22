<?php

  $deleteTitle = "Delete Product";
	$questionLabel = "Do you want to delete this product ?";
	$cancelLabel = "Cancel";
	$yesLabel = "Yes";
	
	function deleteProductWithId($idProduct){

    include("../dbConnect.php");

		$sqlDeleteProduct = $db->prepare('DELETE FROM products_description WHERE products_description_id = ?');

	   try{
        $sqlDeleteProduct->execute(array($idProduct));
    } catch(PDOException $e) {
        die($e->getMessage());
    }

    if(!$sqlDeleteProduct){
   			$message =" Invalid request : ".mysql_error(). "\n";
   			$message .= "complete request : " . $slqCreateProduct;
			   die($message);
   		}else {
			 echo "<div class='deleteConfirmation'>
               <div class='deleteText'>
                   You delete the product !!
               </div>
               <div class='returnButton'>
                 <a class='btn btn-secondary' href='../productsTest.php?language=".
                 htmlspecialchars($_COOKIE['language'])."'>
                   Return
                 </a>
               </div>
             </div>";
   		} 

      $sqlDeleteProduct->closeCursor();
	}
?>

<head>
  <?php 
    include("../headHtml.php");
  ?>
  <link rel="stylesheet" href="delete_style.css" />
</head>

<div class="deletePage">
  <div class="deleteTitle">
    <h1><?php echo $deleteTitle; ?></h1>
  </div>
  <div class="confirmQuestion">
    <p><?php echo $questionLabel; ?></p>
  </div>
  <div class="buttons">
    <?php
        include("../Buttons/cancelButton.php");
    ?>
    <div class="confirmButton">
      <form method="post" action="">
        <input type="submit" class="btn btn-primary" name="confirmDelete" value="<?php echo $yesLabel; ?>">
      </form>  
    </div>
  </div>
   <?php
          if(isset($_POST['confirmDelete'])){
            deleteProductWithId(htmlspecialchars($_GET['productId']));
          }
      ?>
</div>