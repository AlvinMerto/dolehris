<x-app-layout>
    <?php
        if ($displaytabs == true) {
            echo "<input type='hidden' value='showdef' id='displaytabs'/>";
        }
    ?>
    <div class="pd-30"> <!-- main panel -->
        <!-- <h5 class='mg-b-20'> Employee Management  </h5> -->
            <div class='row add-shadow'> <!-- start row -->
                <div class='col-md-3 gray-it pd-0'>
                    <div class='pd-10'>
                        <div class='flex space-between pd-b-10 mg-b-10 border-bottom'>
                            <!-- <button class='btn btn-default'> Add New </button>  -->
                            <a href="{{route('personneladministration')}}/new" class='btn btn-default' style='background: #e8e8e8;'> Add New </a>
                            <a href="{{route('uploademployees')}}" class='btn btn-info'> Upload Employees </a>
                        </div>
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
                           <!--  <tfoot>
                                <tr>
                                    <th style='width:0px;'> # </th>
                                    <th> Name </th>
                                </tr>
                            </tfoot> -->
                        </table>
                    </div>
                </div>
                <div class='col-md-9 white-it mg-0 pd-0' id='theprofileinput'> <!-- col-md-9 -->

                </div> <!-- end of col-md-9 -->
            </div> <!-- end row -->
    </div> <!-- end main panel -->
</x-app-layout>

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