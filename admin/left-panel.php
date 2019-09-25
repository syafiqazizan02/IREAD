<?php include('session.php'); ?>

<aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src="../images/logo.png" width="100px" height="100px" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="../images/logo.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <h3 class="menu-title">DASHBOARD</h3>
                    </li>
                    <li class="menu-item-has-children dropdown">
                      <li>
                          <a href="."> <i class="menu-icon fa fa-dashboard"></i>Dashboard</a>
                      </li>
                    </li>
                    <h3 class="menu-title">MANAGE</h3>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Manage Setting</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-gears"></i><a href="manageSetting.php">Setup Position</a></li>
                            <li><i class="fa fa-plus-square"></i><a href="addMemberType.php">New Position</a></li>
                            <li><i class="fa fa-list-ul"></i><a href="manageCategory.php">View Category</a></li>
                            <li><i class="fa fa-plus-circle"></i><a href="addCategory.php">New Category</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Manage Librarian</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus-circle"></i><a href="addLibrarian.php">New Librarian</a></li>
                            <li><i class="fa fa-users"></i><a href="manageLibrarian.php">View Librarian</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Manage Member</a>
                        <ul class="sub-menu children dropdown-menu">
													<li><i class="fa fa-plus-square"></i><a href="manage_member_register_new.php?id=<?php echo $id; ?>">New Member</a></li>
	                        <li><i class="fa fa-users"></i><a href="manage_member_list_view.php?id=<?php echo $id; ?>">View Member</a></li>
                        </ul>
                    </li>
										<li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Manage Book</a>
                        <ul class="sub-menu children dropdown-menu">
														<li><i class="fa fa-plus-circle"></i><a href="manage_book_register_new.php?id=<?php echo $id; ?>">New Book</a></li>
														<li><i class="fa fa-book"></i><a href="manage_book_list_view.php?id=<?php echo $id; ?>">View Book</a></li>
														<li><i class="fa fa-barcode"></i><a href="manage_book_barcode_info.php?id=<?php echo $id; ?>">Barcode Book</a></li>
														<li><i class="fa fa-warning"></i><a href="manage_book_damage_list.php?id=<?php echo $id; ?>">Damage Book</a></li>
							           </ul>
                    </li>
										<li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Manage Issue</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-share-square"></i><a href="manage_issue_borrow_view.php?id=<?php echo $id; ?>">Borrow Book</a></li>
														<li><i class="fa fa- fa-print"></i><a href="manage_issue_borrow_receipts.php?id=<?php echo $id; ?>">Borrow Receipts</a></li>
														<li><i class="fa fa-refresh"></i><a href="manage_issue_return_view.php?id=<?php echo $id; ?>">Return Book</a></li>
														<li><i class="fa fa-file-text-o"></i><a href="manage_issue_return_receipts.php?id=<?php echo $id; ?>">Return Receipts</a></li>
														<li><i class="fa fa-exchange"></i><a href="manage_issue_list_view.php?id=<?php echo $id; ?>">Transaction Book</a></li>
                        </ul>
                    </li>
                    <h3 class="menu-title">Report</h3>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Book Report</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-bar-chart-o"></i><a href="reportTotalNewBook.php">Total Book Registered</a></li>
                            <li><i class="fa fa-bar-chart-o"></i><a href="reportTotalBookDamaged.php">Total Book Damaged</a></li>
                            <li><i class="fa fa-bar-chart-o"></i><a href="reportTotalBookBorrow.php">Total Book Borrowed</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Member Report</a>
                        <ul class="sub-menu children dropdown-menu">
                          <li><i class="fa fa-bar-chart-o"></i><a href="reportTotalMemberRegister.php">Total Member Register</a></li>
                          <li><i class="fa fa-bar-chart-o"></i><a href="reportMemberView.php">Individual Member Report</a></li>
                          <li><i class="fa fa-bar-chart-o"></i><a href="reportAchievement.php">Top 10 Member Nilam</a></li>
                          <li><i class="fa fa-bar-chart-o"></i><a href="reportTotalNilam.php">Total Nilam Report</a></li>
                        </ul>
                    </li>
                    <!-- <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Librarian Report</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-bar-chart-o"></i><a href="reportTotalLibrarianRegister.php">Total Librarian Register</a></li>
                        </ul>
                    </li> -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Penalty Report</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-bar-chart-o"></i><a href="reportTotalPenaltyCharged.php">Total Penalty Charged</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>
    </aside>
