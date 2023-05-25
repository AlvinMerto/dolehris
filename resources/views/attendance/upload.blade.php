<x-app-layout>
    <!-- <div class="br-mainpanel"> -->
        <div class="pd-30">
            <h4 class="tx-gray-800 mg-b-5">Upload Attendance</h4>
            <!-- <p class="mg-b-0">Do big things with Bracket, the responsive bootstrap 4 admin template.</p> -->
            <div id="slWrapper2" class="parsley-select wd-250 mg-t-30">
                <form method='post' action="{{ route('uploadtimelog') }}"  enctype='multipart/form-data'>
                    @csrf
                    <!-- <select class="form-control select2 mg-b-5" name='officearea'>
                        <option label="Choose one"></option>
                        <option value="davaocentral">Davao Central</option>
                        <option value="mati">Mati</option>
                    </select> -->
                    <input type="file" id="file" name='employeetimelog'/>
                    <!-- <label class="custom-file mg-b-5">
                        class="custom-file-input"
                        <span class="custom-file-control"></span>
                    </label> -->
                    <input type='submit' class='btn btn-info mg-b-5 mg-t-10' name='uploadtimelog' value='Upload'/>
                </form>
            </div>
        </div>
    <!-- </div> -->
</x-app-layout>