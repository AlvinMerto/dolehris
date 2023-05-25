<x-app-layout>
    <div class="pd-30"> <!-- main panel -->
        <h5> Employee Management </h5>
        <form method='post' action="{{route('uploademployees')}}" enctype='multipart/form-data'>
            @csrf
            <input type='file' name='thefile'/>
            <input type='submit' value='Upload Employees'/>
        </form>
        <?php
            if ($uploaded != null) {
                echo "<p>".$uploaded."</p>";
            }
        ?>
    </div>
</x-app-layout>