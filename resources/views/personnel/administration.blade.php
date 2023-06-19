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
                    <div class='pd-10 pd-l-15 pd-r-15'>
                        <div class='flex space-between pd-b-10 mg-b-10 border-bottom'>
                            <!-- <button class='btn btn-default'> Add New </button>  -->
                            <a href="{{route('personneladministration')}}/new" class='btn btn-default' style='background: #e8e8e8;'> Add New </a>
                            <a href="{{route('uploademployees')}}" class='btn btn-info'> Upload Employees </a>
                        </div>
                        <select class='form-control mg-b-5' id='officechange'>
                            <?php
                                echo "<option value='all'> All </option>";
                                foreach($areas as $a) {
                                    echo "<option value='{$a->areaofficepk}'>";
                                        echo $a->theareaoffice;
                                    echo "</option>";
                                }
                            ?>
                        </select>
                        <span id='loadempshere'>Loading...</span>
                    </div>
                </div>
                <div class='col-md-9 white-it mg-0 pd-0' id='theprofileinput'> <!-- col-md-9 -->

                </div> <!-- end of col-md-9 -->
            </div> <!-- end row -->
    </div> <!-- end main panel -->
</x-app-layout>

