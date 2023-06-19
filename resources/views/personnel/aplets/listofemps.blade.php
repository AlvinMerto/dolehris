                        <table id='nametbl' class='table table-striped'>
                            <thead>
                                <th style='width:0px;'> # </th>
                                <th> Name </th>
                            </thead>
                            <tbody>
                                <?php 
                                    $count   = 1;
                                    $thename = null;
                                    foreach($employees as $e) {
                                        $thename = strtolower(html_entity_decode($e->lname).", ".html_entity_decode($e->fname)." ".html_entity_decode($e->mname));
                                        echo "<tr>";
                                            echo "<td>";
                                                echo $count;
                                            echo "</td>";
                                            echo "<td>";
                                                echo "<a class='dolehref capitalize' href='".route('personneladministration')."/{$e->perid}'/>".$thename."</a>";
                                            echo "</td>";
                                        echo "</tr>";
                                        $count++;
                                    }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style='width:0px;'> # </th>
                                    <th> Name </th>
                                </tr>
                            </tfoot>
                        </table>

<script>
        $('#nametbl').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
            },
            lengthMenu: [
                    [ 50, 100, -1],
                    [ 50, 100, 'All'],
            ],
            "dom": 'frtip'
        });
</script>