<?php 
    $languageChoice = "Choose your language : ";

    if(isset($_GET['language'])){
    	$languageSelect = htmlspecialchars($_GET['language']);
    }else {
    	$languageSelect = 'Danish';
    }

?>
<script type="text/javascript">

    function load_new_content($value){
        window.location.href = "productsTest.php?language=" + $value;
    }

</script>

<div class="languageChoice">
    <label class="languageLabel">
    <?php
        echo $languageChoice;
    ?>
    </label>
    <select class="languageSelect" name="selectLanguage" id="selectLanguage" onchange='load_new_content(this.value)' value="<?php echo $languageSelect; ?>">
        <?php

            $languages = $db->query('SELECT * FROM languages');

            if(isset($languageSelect)){
                echo "<option id='lang'>".$languageSelect."</option>";
                 while($language = $languages->fetch()){
                    $langValue = $language['languages_name'];
                    if($langValue !== $languageSelect){
                        echo "<option id='lang'>".$langValue."</option>";
                    }
                }
                $languages->closeCursor();
            } else {
                
                while($language = $languages->fetch()){
                    $langValue = $language['languages_name'];
                    echo "<option id='lang'>".$langValue."</option>";
                
                }
            $languages->closeCursor();
            }
        ?>
    </select>
</div>