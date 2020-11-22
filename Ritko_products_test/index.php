<!DOCTYPE html>
    <?php
        include("dbConnect.php");
    ?>

<html>
    <head>
        <?php
            include("headHtml.php");
        ?>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="LanguagesList/language_style.css" />
        <link rel="stylesheet" href="ProductList/productsList_style.css" />
    </head>
    <body>
        <?php 
            include("LanguagesList/languageList.php");
            include("ProductList/listOfProductPage.php"); 
        ?>
    </body>
</html>

