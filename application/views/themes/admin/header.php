<header id="header">
    <div id="logo-group">

        <span id="logo"> Babes Direct
            <!--<img src="<?php //echo base_url(); ?>assets/admin/img/logo.png" alt="SmartAdmin">--> 
        </span>
        
    </div>


    <!-- pulled right: nav area -->
    <div class="pull-right">

        <!-- collapse menu button -->
        <div id="hide-menu" class="btn-header pull-right">
            <span>
				<a href="javascript:void(0);" title="Collapse Menu" data-action="toggleMenu">
					<i class="fa fa-reorder"></i>
				</a>
			</span>
        </div>

        <!-- logout button -->
        <div id="logout" class="btn-header transparent pull-right">
            <span>
                <!--<a href="<?php //echo base_url(); ?>auth/logout" title="Sign Out"><i class="fa fa-sign-out"></i></a>--> 
                <a data-logout-msg="You can improve your security further after logging out by closing this opened browser" data-action="userLogout" title="Sign Out" href="<?php echo base_url('admin/auth/logout'); ?>" title="Sign Out"><i class="fa fa-sign-out"></i></a>
            </span>
        </div>
        <!-- end logout button -->

        <!-- search mobile button (this is hidden till mobile view port) -->
        <div id="search-mobile" class="btn-header transparent pull-right">
            <span> <a href="javascript:void(0)" title="Search"><i class="fa fa-search"></i></a> </span>
        </div>
        <!-- end search mobile button -->

        <!-- input: search field -->
        
        <!-- end input: search field -->

        <!-- fullscreen button -->
        <div id="fullscreen" class="btn-header transparent pull-right">
            <span>
				<a href="javascript:void(0);" title="Full Screen" data-action="launchFullscreen">
					<i class="fa fa-arrows-alt"></i>
				</a>
			</span>
        </div>
        <!-- end fullscreen button -->

        <!-- #Voice Command: Start Speech -->
        <!-- end voice command -->


    </div>
    <!-- end pulled right: nav area -->

</header>
