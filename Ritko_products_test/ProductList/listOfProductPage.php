<?php  
    
    $title = "List of products";
    $editButton = "Edit";
    $deleteButton = "Delete";
    $createButton = "Create";
    
    if(isset($_GET['language'])){
      $languageChoice = htmlspecialchars($_GET['language']);
      
    } else {
      $languageChoice = 'Danish';
    }


    $sqlRequestGetLangauageId = 'SELECT * FROM languages WHERE languages_name = ?';
    $getLanguageId = $db->prepare($sqlRequestGetLangauageId);


    try{
      $getLanguageId->execute(array($languageChoice));  
    }catch(PDOException $e) {
          die($e->getMessage());
    }

    while($languagesIds = $getLanguageId->fetch()){
      $languageId = htmlspecialchars($languagesIds['languages_id']);
    }

    $sqlRequestGetProductList = 'SELECT products_description_name, products_reference, products_price, products_description_id, languages_id FROM products,products_description WHERE products.products_id = products_description.products_id AND languages_id = ? AND products_description.products_description_name !="" ORDER BY products_description_id';

    $getProductListWithLanguageId = $db->prepare($sqlRequestGetProductList);

?>

<div class="productList">
  <div class="productListTitle">
      <h1><?php echo $title; ?></h1>
  </div>
  <div class="listOfProducts container">
    <div class="productDetail row">
      <?php
          try{
            $getProductListWithLanguageId->execute(array($languageId));
          }catch(PDOException $e) {
              die($e->getMessage());
          }

          while($datas = $getProductListWithLanguageId->fetch()){
              $productName = htmlspecialchars($datas['products_description_name']);
              $productPrice = htmlspecialchars($datas['products_price']);
              $productReference = htmlspecialchars($datas['products_reference']);
              $idProduct = htmlspecialchars($datas['products_description_id']);
      ?>
      <div class="product">
        <div class="productName col-md-3">
            <p>
                <?php
                   echo $productName;
                ?>
            </p>
        </div>
    <div class="productPrice col-md-2">
            <p>
                <?php
                   echo $productPrice;
                ?>
            </p>
        </div>
        <div class="referenceName col-md-3">
            <p>
                <?php
                   echo $productReference;
                ?>
            </p>
        </div>
        <div class="editButton col-md-2">
            <a class="btn btn-primary" href="EditCreatePage/editCreatePage.php?id=<?php echo $idProduct; ?>&language=<?php echo $languageChoice; ?>">
              <?php
                  echo $editButton;
              ?>
            </a>
        </div>
        <div class="deleteButton col-md-2">
          <form method="get" action="DeleteProduct/deleteAlert.php">
            <input type="hidden" name="productId" value="<?php echo $idProduct; ?>">
            <input type="hidden" name="language" value="<?php echo $languageChoice; ?>">
            <input class="btn btn-danger" type="submit" name="deleteButton" value="<?php echo $deleteButton; ?>">
          </form>     
        </div>
      </div>
        <?php
          }
          $getProductListWithLanguageId->closeCursor();  
        ?>
    </div>
    <div class="createButton">
      <a class="btn btn-info" href="EditCreatePage/editCreatePage.php?language=<?php echo $languageChoice; ?>">
        <?php 
          echo $createButton
        ?> 
      </a>
    </div>
  </div>  
</div>