    <!-- ########## START: HEAD PANEL ########## -->
    <div class="br-header">
      <div class="br-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
        <!-- <div class="input-group hidden-xs-down wd-170 transition"> -->
          <!-- <input id="searchbox" type="text" class="form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button>
          </span> -->
          
        <!--/div--><!-- input-group -->
        <?php
          $path_info = $_SERVER["REQUEST_URI"];
          $firstpath = explode("/",$path_info)[1];
        ?>
        
        <div class='withnavigation'>
          <a href="" style='color: #535353;'>
            <div class="navicon-left w-auto navtopbtn">
              <i class="fa fa-briefcase dsitxt" aria-hidden="true"></i> &nbsp; HR Tools
            </div>
          </a>
          <ul class='hrnav'>
            <li> Applicant Administration </li>
            <li> Attendance <i class="fa fa-angle-right" aria-hidden="true"></i> &nbsp;
                 <ul>
                    <li> <a href="{{url('attendance/upload')}}"/> Upload Attendance </a> </li>
                    <li> <a href="{{url('attendance/generate')}}"/> Generate DTR </a> </li>
                 </ul>
            </li>
            <li> Holiday Administration </li>
            <li> Leave Administration </li>
            <li> Learning and Development </li>
            <li> Offices </li>
            <li> Summary Reports </li>
            <li> Payroll </li>
            <li> PDS Adminstration </li>
            <li> <a href="{{ route('personneladministration') }}"> Personnel Records </a> </li>
            <li> <a href="{{ route('signatories') }}"/> Signatories </a> </li>
            <!-- <li> <a href="{{ route('sendpayslip') }}"/>Send Payslip </a> </li> -->
          </ul>
        </div>
        <!-- 

                    Employee Information
                    Service Record
                    Directory of Personnel
                    Reporting and Analytics

        <a href="#" style='color: #858484;'>
          <div class="navicon-left w-auto navtopbtn">
            <i class="fa fa-usd dsitxt" aria-hidden="true"></i> &nbsp; All Opportunities
          </div>
        </a>
        <a href="" style='color: #858484;'>
          <div class="navicon-left w-auto navtopbtn <?php //if ($firstpath == "orders") { echo "selectednavtop"; } ?>">
            <i class="fa fa-shopping-cart dsitxt" aria-hidden="true"></i> &nbsp; Orders
          </div>
        </a>
        <?php //if ($firstpath == "processed") { ?>
          <a href="" style='color: #858484;'>
            <div class="navicon-left w-auto navtopbtn selectednavtop">
              <i class="fa fa-check dsitxt" aria-hidden="true"></i> &nbsp; Processed Order
            </div>
          </a>
        <?php //} ?> -->
      </div><!-- br-header-left -->
      <div class="br-header-right">
        <nav class="nav">
          <div class="dropdown">         
          <div class="dropdown">
            <!--a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
              <span class="logged-name hidden-md-down">Welcome, Katherine</span>
            </a-->
            <div class="dropdown-menu dropdown-menu-header wd-200">
              <ul class="list-unstyled user-profile-nav">
                <li><a href=""><i class="icon ion-ios-person"></i> Edit Profile</a></li>
                <li><a href=""><i class="icon ion-ios-gear"></i> Settings</a></li>
                <li><a href=""><i class="icon ion-ios-download"></i> Downloads</a></li>
                <li><a href=""><i class="icon ion-ios-star"></i> Favorites</a></li>
                <li><a href=""><i class="icon ion-ios-folder"></i> Collections</a></li>
                <li><a href=""><i class="icon ion-power"></i> Sign Out</a></li>
              </ul>
            </div><!-- dropdown-menu -->

          </div><!-- dropdown -->
          </div>
          <div class="navicon-right">
          <a id="btnRightMenu" href="" class="pos-relative">
            <i class="fa fa-list-ol" aria-hidden="true"></i>
            <!-- start: if statement -->
            <!-- <span class="square-8 bg-danger pos-absolute t-10 r--5 rounded-circle"></span> -->
            <!-- end: if statement -->
          </a>
        </div><!-- navicon-right -->
        </nav>
        </div><!-- br-header-right -->
    </div><!-- br-header -->
    <!-- ########## END: HEAD PANEL ########## -->