<?php
	echo "<table>";
		for($i=0;$i<=count($body)-1;$i++) {
		    echo "<tr>";
		        echo "<td>";
		            echo $headers[$i];
		        echo "</td>";
		        echo "<td>";
		            echo $body[$i];
		        echo "</td>";
		    echo "</tr>";
		}
	echo "</table>";
?>