    <!-- ########## START: LEFT PANEL ########## -->
    <div class="br-logo"><a href=""></a></div>
    <div class="br-sideleft overflow-y-auto sidepanel">

        <!-- <div style='text-align:center;' class='disapprof'>
            <div class='profileimg'> <img src=""/> </div>
            <p class='profilename'> <?php // echo Auth::user()['name']; ?> </p>
            <small class='usertype'> Admin </small>
        </div> -->

      <?php
        $path_info  = $_SERVER["REQUEST_URI"];

        $thepath    = explode("/",$path_info);

        $firstpath  = $thepath[1];

        $secondpath = null;

        if (count($thepath) > 2) {
          $secondpath = $thepath[2];
        }
        
        if (strlen($firstpath) == 0) {
          $firstpath = "dashboard";
        }
        // echo $secondpath;
        // echo $firstpath;
      ?>
      
      <div class="br-sideleft-menu">
        <label class="sidebar-label pd-x-15 mg-t-20">Personal Spaces</label>
        <a href="{{route('dashboard')}}" class="br-menu-link <?php echo ($firstpath=="dashboard")?"active":null; ?>"> <!-- active -->
          <div class="br-menu-item">
            <!-- <i class="  " aria-hidden="true"></i> -->
            <i class="fa fa-home tx-22"></i>
            <span class="menu-item-label">Profile</span>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->

        <label class="sidebar-label pd-x-15 mg-t-20">Leave Cabinet</label>
        <!-- <a href="{{route('leavecabinet')}}" class="br-menu-link <?php // echo ($firstpath=="leavecabinet")?"active":null; ?>"> 
          <div class="br-menu-item">
            <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
            <span class="menu-item-label">Leave Cabinet</span>
          </div>
        </a> -->

        <!-- <a href="{{route('leavecabinet')}}" class="br-menu-link <?php //echo ($firstpath=="leavecabinet")?"active":null; ?>">
          <div class="br-menu-item">
            <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
            <span class="menu-item-label">Leave Applications</span>
          </div>
        </a> -->

        <a href="{{route('leavecabinet')}}" class="br-menu-link <?php echo ($firstpath=="leavecards")?"active":null; ?>"> <!-- active -->
          <div class="br-menu-item">
            <i class="fa fa-sticky-note-o" aria-hidden="true"></i>
            <span class="menu-item-label">Leave Cards</span>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->

        <label class="sidebar-label pd-x-15 mg-t-20">Documents</label>
        <a href="{{route('leavecabinet')}}" class="br-menu-link <?php echo ($firstpath=="pds")?"active":null; ?>"> <!-- active -->
          <div class="br-menu-item">
            <i class="fa fa-file-text-o" aria-hidden="true"></i>
            <span class="menu-item-label">201 Files</span>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->

        <a href="{{route('leavecabinet')}}" class="br-menu-link <?php echo ($firstpath=="pds")?"active":null; ?>"> <!-- active -->
          <div class="br-menu-item">
            <i class="fa fa-file-powerpoint-o" aria-hidden="true"></i>
            <span class="menu-item-label">PDS</span>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->

        <a href="{{route('leavecabinet')}}" class="br-menu-link <?php echo ($firstpath=="pds")?"active":null; ?>"> <!-- active -->
          <div class="br-menu-item">
            <i class="fa fa-file-archive-o" aria-hidden="true"></i>
            <span class="menu-item-label">SALN</span>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->

        <a href="{{route('leavecabinet')}}" class="br-menu-link <?php echo ($firstpath=="pds")?"active":null; ?>"> <!-- active -->
          <div class="br-menu-item">
            <i class="fa fa-files-o" aria-hidden="true"></i>
            <span class="menu-item-label">Service Records</span>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        
        <label class="sidebar-label pd-x-15 mg-t-20">Agency Wide</label>
        <a href="{{route('leavecabinet')}}" class="br-menu-link <?php echo ($firstpath=="pds")?"active":null; ?>"> <!-- active -->
          <div class="br-menu-item">
            <i class="fa fa-pencil" aria-hidden="true"></i>
            <span class="menu-item-label">Memos</span>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->

        <a href="{{route('leavecabinet')}}" class="br-menu-link <?php echo ($firstpath=="pds")?"active":null; ?>"> <!-- active -->
          <div class="br-menu-item">
            <i class="fa fa-gavel" aria-hidden="true"></i>
            <span class="menu-item-label">Special Orders</span>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->

      </div><!-- br-sideleft-menu -->


      <br>
    </div><!-- br-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->