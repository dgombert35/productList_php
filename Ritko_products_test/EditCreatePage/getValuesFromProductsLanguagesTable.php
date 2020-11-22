<?php

    $productName = '';
    $productShortDescription = '';
    $productDescription = '';

    if($products_id != ''){
        $sqlRequestGetDetailsProductWithLanguage = 'SELECT products_description_short_description, products_description_description, products_description_name, languages_id FROM products_description WHERE products_id = ?';
        $getDetailsInfosProduct = $db->prepare($sqlRequestGetDetailsProductWithLanguage);

        try{
            $getDetailsInfosProduct->execute(array($products_id));
    
        }catch(PDOException $e) {
            die($e->getMessage());
        }

        while($getProductInfos = $getDetailsInfosProduct->fetch()){
    
            if($language_id === htmlspecialchars($getProductInfos['languages_id'])){
                $productName = htmlspecialchars($getProductInfos['products_description_name']);
                $productShortDescription = htmlspecialchars($getProductInfos['products_description_short_description']);
                $productDescription = htmlspecialchars($getProductInfos['products_description_description']); 
            }
        }

        include("productDetailHtml.php");
        $getDetailsInfosProduct->closeCursor();
    }else {
        include("productDetailHtml.php");
    }
    
?>