<?php  include('function.php'); ?>

				<div id="right-panel" class="right-panel">

		        <!-- Header-->
		        <header id="header" class="header">

		            <div class="header-menu">

		                <div class="col-sm-7">
		                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
		                    <div class="header-left">
													<div>
	 	 												<strong>I-READ</strong>&nbsp;&nbsp;
	 	 												<small><span id="date_time"></span></small>
 	 												</div>
		                    </div>
		                </div>

										<div class="col-sm-5">
		                    <div class="user-area dropdown float-right">
			                     <small>Welcome! <b><?php echo librarian(); ?></b></small>&nbsp;&nbsp;
		                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		                           <img class="user-avatar rounded-circle" src="../images/logo2.png" alt="User Avatar">
		                        </a>
		                        <div class="user-menu dropdown-menu">
															<a class="nav-link" href="manage_account_profile_edit.php?id=<?php echo $id; ?>"><i class="fa fa-user"></i>  Update Profile</a>
															<a class="nav-link" href="manage_account_password_change.php?id=<?php echo $id; ?>"><i class="fa fa-gear"></i>  New Password</a>
															<a class="nav-link" href="../logout.php"><i class="fa fa-sign-out"></i>  Log Out</a>
		                        </div>
		                    </div>

		                </div>
		            </div>

		        </header><!-- /header -->
