
<?php include('header.php'); ?>
<?php //include('left-panel.php'); ?>
<?php include('sidebar.php'); ?>
<?php include('navbar.php'); ?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Manage Issue</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Manage Isuue</a></li>
                            <li class="active">Return Book</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
					          <div class="col-md-12">
						           <div class="card">
            							<div class="card-header">
            								<small>Return Book</small>
            							</div>
            							<div class="card-body">
            									<!-- MODAL BOX-->
            									<?php include('manage_issue_return_book.php'); ?>
            									<a href="#return" data-toggle="modal" class="btn btn-info btn-xs"><i class='fa fa-plus-circle'></i>&nbsp;&nbsp;Book</a><br><br
            									<!-- MODAL BOX-->
            									<!-- TABLE DISPLAY-->
                              <form method="post" id="checked">
            										<div class="table-responsive">
            											<table class="table table-striped table-bordered" id="return_data">
            												<tr>
            													<th>Book Code</th>
            													<th>Book Title</th>
            													<th>Borrow Date</th>
            													<th>Due Date</th>
                                      <th>Return Date</th>
                                      <th>Penalty Day</th>
                                      <th>Penalty Amount</th>
                                      <th>Done</th>
            													<th>Remove</th>
            												</tr>
            											</table>
            										</div>
                                <div align="center">
                      						<button type="submit" name="checked" id="checked" class="btn btn-success"><i class='fa fa-check-square-o'></i>&nbsp;&nbsp;Done</button>
                      					</div>
            								  </form>
                              <!-- TABLE DISPLAY-->

                              <?php

                                if(isset($_POST['checked']))
                    						{

                    							if(!empty($_POST["checklist"]))
                    							{

                                    include "db_conn.php";
                                    include "../php-mailer-master/PHPMailerAutoload.php";

                                      $returnID = $_POST["returnID"];
                                      $doneDate = $_POST["doneDate"];

                                      //Select from TABLE RETURN, BORROW, MEMBER (Geting member_id back)
                                      $stmt = $conn->prepare("SELECT e.member_id as member_id
                                                               FROM `return` AS a
                                                               JOIN borrow AS c ON a.borrow_id=c.borrow_id
                                                               JOIN member AS e ON c.member_id=e.member_id
                                                               AND a.return_id =?");

                                      $stmt->bind_param("s", $returnID);
                                      $stmt->execute();
                                      $result = $stmt->get_result();
                                      $row = $result->fetch_assoc();
                                          $member_id= $row ['member_id'];

                                      //Insert into TABLE DONE
                                      $stmt1 = $conn->prepare("INSERT INTO `done` (member_id, done_date) VALUES (?, ?)");
                                      $stmt1->bind_param("ss", $member_id, $doneDate);
                                      $stmt1->execute();

                                      //Select from TABLE DONE (Geting done_id back)
                                      $stmt2 = $conn->prepare("SELECT * FROM `done` ORDER BY done_id DESC");
                                      $stmt2->execute();
                                      $result2 = $stmt2->get_result();
                                      $row2 = $result2->fetch_assoc();
                                          $done_id = $row2 ['done_id'];

                                    $c = 0;

                    								foreach($_POST["checklist"] as $book_id)
                    								{

                    									include('db_conn.php');

                                        $c++;

                                        //Getting Return ID, Penalty Day, Penalty Amount
                                        $return_id = $_POST["hidden_return_id".$c];
                                        $penalty_day = $_POST["hidden_penalty_day".$c];
                                        $penalty_amount = $_POST["hidden_penalty_amount".$c];

                                        $return_status = 0;
                                        $return_value = 1;

                                        //Update into TABLE RETURN
                                        $stmt3 = $conn->prepare("UPDATE `return` SET return_status=?, done_id=?, penalty_day=?, penalty_amount=? WHERE book_id=? AND return_status=?");
                                        $stmt3->bind_param("ssssss", $return_value, $done_id, $penalty_day, $penalty_amount, $book_id, $return_status);
                                        $stmt3->execute();

                                        $book_status = 0;

                                        $stmt4 = $conn->prepare("UPDATE `book` SET `book_status`= ? WHERE book_id =?");
                                        $stmt4->bind_param("ss", $book_status, $book_id);
                                      	$stmt4->execute();

                    									}

                                        //Get Previous Member Book Limit
                                        $stmt7 = $conn->prepare("SELECT member_limit FROM member WHERE member_id=?");
                                    		$stmt7->bind_param("s", $member_id);
                                    		$stmt7->execute();
                                    		$result7 = $stmt7->get_result();
                                    		$row7 = $result7->fetch_assoc();
                                    			$member_limit= $row7 ['member_limit'];

                                    		//Calculate Borrow Limit Left (Previous Limit + Book Amount)
                                    		$new_limit = ($member_limit + $c);

                                    		//Update New Book Limit
                                    		$stmt8 = $conn->prepare("UPDATE `member` SET `member_limit`= ? WHERE member_id =?");
                                    		$stmt8->bind_param("ss", $new_limit, $member_id);
                                    		$stmt8->execute();

                                        $stmt9 = $conn->prepare("SELECT a.penalty_day as penalty_day, a.penalty_amount as penalty_amount, c.borrow_date as borrow_date, c.due_date as due_date, e.member_fullname as member_fullname, e.member_email as member_email, g.done_id as  done_id, g.done_date as done_date
                                                                 FROM `return` AS a
                                                                 JOIN borrow AS c ON a.borrow_id=c.borrow_id
                                                                 JOIN member AS e ON c.member_id=e.member_id
                                                                 JOIN done AS g ON a.done_id=g.done_id
                                                                 AND g.done_id=?");
                                        $stmt9->bind_param("s", $done_id);
                                        $stmt9->execute();
                                        $result9 = $stmt9->get_result();
                                        $row9 = $result9->fetch_assoc();
                                          $done_id = $row9 ['done_id'];
                                          $borrow_date = date_format(date_create($row9['borrow_date']), 'd F Y');
                                          $due_date = date_format(date_create($row9['due_date']), 'd F Y');
                                          $done_date = date_format(date_create($row9['done_date']), 'd F Y');
                                          $penalty_day = $row9 ['penalty_day'];
                                          $penalty_amount = $row9 ['penalty_amount'];
                                          $member_fullname = $row9 ['member_fullname'];
                                          $member_email = $row9 ['member_email'];

                                        //PHPMailerAutoload to Gmail
                                        $mail = new PHPMailer;
                                        $mail->isSMTP();
                                        $mail->Host = 'smtp.gmail.com';
                                        $mail->SMTPAuth = true;
                                        $mail->Username = 'skpmlibrary@gmail.com';
                                        $mail->Password = 'skpm2018';
                                        $mail->SMTPSecure = false;
                                        $mail->Port = 587;
                                        $mail->setFrom('skpmlibrary@gmail.com', 'SKPM Library');
                                        $mail->addAddress($member_email);
                                        $mail->isHTML(true);
                                        $mail->Subject = 'Return Book Transaction';
                                        $mail->Body    = '<p><h3>Congratulation!</h3><b>Your transaction is Successful. Return IDR'.$done_id.'</b></p>
                                         								  <p>Member Name: '.$member_fullname.'<br>
                                         									Borrow Date: '.$borrow_date.'<br>
                                         									Due Date: '.$due_date.'<br>
                                                          Return Date: '.$done_date.'<br>
                                                          Penalty Days: '.$penalty_day.' Days<br>
                                                          Penalty Amount: RM '.$penalty_amount.'<br></p>
                                         								 <p>More information please contact : +606-553 2499.</p>';
                                        $mail->AltBody = '<p><h3>Congratulation!</h3><b>Your transaction is Successful. Return IDR'.$done_id.'</b></p>
                                         								  <p>Member Name: '.$member_fullname.'<br>
                                         									Borrow Date: '.$borrow_date.'<br>
                                         									Due Date: '.$due_date.'<br>
                                                          Return Date: '.$done_date.'<br>
                                                          Penalty Days: '.$penalty_day.' Days<br>
                                                          Penalty Amount: RM '.$penalty_amount.'<br></p>
                                         								 <p>More information please contact : +606-553 2499.</p>';
                                        $mail->send();

                                        echo "<script>alert('Return Book is Successful!')</script>";

                    								}
                                    else
                                    {
                                      echo "<script> alert('No Book Selected!')</script>";
                                    }
                    							}
            								  ?>
							          </div>
						         </div>
					          </div>
                  </div>
                </div>
            </div>

   </div>

<?php include('footer.php'); ?>
