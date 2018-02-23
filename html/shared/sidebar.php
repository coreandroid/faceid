  <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3>
                </div>
                <ul class="nav" id="side-menu">
                    <li style="padding: 70px 0 0;">
                     </li>
                   
                    <li>
                        <a href="section.php" class="waves-effect"><i class="fa fa-table fa-fw" aria-hidden="true"></i>Sections</a>
                    </li>
                    <li>
                        <a href="attendance.php" class="waves-effect"><i class="fa fa-table fa-fw" aria-hidden="true"></i>Attendances</a>
                    </li>
                     <li>
                        <a href="checknow.php" class="waves-effect"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i>Check Attendance</a>
                    </li>
                     
                     <?php  if($_SESSION['LogRole'] == "admin") { ?>
                      <li>
                        <a href="user.php" class="waves-effect"><i class="fa fa-users fa-fw" aria-hidden="true"></i>User account</a>
                    </li>
              
                    <?php } ?>
                </ul>
                
            </div>
        </div>