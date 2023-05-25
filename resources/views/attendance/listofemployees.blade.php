<?php 
    
    foreach($personnel as $p) {
        $name = strtolower($p->lname.", ".$p->fname." ".$p->mname);
        echo "<tr>";
            echo "<td>";
               // echo "<label class='ckbox'>";
                    echo "<input type='checkbox' name='theids[]' class='list-of-emps-check' value='{$p->biometricid}' id='check_{$p->biometricid}'/>";
               // echo "</label>";
            echo "</td>";
            echo "<td>";
                echo "<label class='tbl_lbl' for='check_{$p->biometricid}'>".$name."</label>";
            echo "</td>";
            echo "<td>";
                echo "<span id='status_{$p->biometricid}'>  </span> ";
            echo "</td>";
        echo "</tr>";
    }

?>
