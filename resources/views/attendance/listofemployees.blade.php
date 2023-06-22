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
                echo "&nbsp;&nbsp;&nbsp;&nbsp;";
                // http://127.0.0.1/personnel/administration/940
                echo "<a href='".route('personneladministration')."/{$p->perid}' target='_blank'> <i class='fa fa-pencil' aria-hidden='true'></i> </a>";
            echo "</td>";
            echo "<td>";
                echo "<span id='status_{$p->biometricid}'>  </span> ";
            echo "</td>";
        echo "</tr>";
    }

?>
