<nav class="pagination">
    <ul>
        <?php
            if(array_key_exists(($pageNumber - 1), $pagedArray)){
                $prevPage = $pageNumber - 1;
                echo "
                    
                        <input type=\"button\" class=\"page-link\" onclick=\"location.href='?page={$prevPage}'\" tabindex=\"-1\" value=\"Previous\" style=\"margin-left: 10px;\">
                 
                ";
            }
        ?>
        <?php
            if(array_key_exists(($pageNumber + 1), $pagedArray)){
                $nextPage = $pageNumber + 1;
                echo "
                         <input type=\"button\" id=\"\" class=\"page-link\" onclick=\"location.href='?page={$nextPage}'\" value=\"Next\" style=\"float:right; margin-right: 10px;\">
  
                ";
            }
        ?>
    </ul>
</nav>