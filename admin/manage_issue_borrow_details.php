<!-- modal-->
     <div class="modal fade" id="viewdetails<?php echo $borrow_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog modal-lg" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" class="modal-header">Manage Issue   <small>Borrow Details</small></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                  <?php

                    include "db_conn.php";

                      $stmt2 = $conn->prepare("SELECT c.borrow_date as borrow_date, c.due_date as due_date, e.member_fullname as member_fullname
                                               FROM borrow AS c
                                               JOIN member AS e ON c.member_id=e.member_id
                                               AND c.borrow_id =?;");

                      $stmt2->bind_param("s", $borrow_id);
                      $stmt2->execute();
                      $result2 = $stmt2->get_result();
                      $row2 = $result2->fetch_assoc();
                      $member_fullname = $row2['member_fullname'];
                      $borrow_date = date_format(date_create($row2['borrow_date']), 'd M Y');
                      $due_date = date_format(date_create($row2['due_date']), 'd M Y  ');

                  ?>
                  <div class="col-lg-6">
                  </div>
                  <div class="col-lg-6">
                    <aside class="profile-nav alt">
                        <section class="card">
                            <div class="card-header user-header alt bg-dark">
                                <div class="media">
                                    <div class="media-body">
                                        <h4 class="text-light display-6"><?php echo $member_fullname ; ?></h4>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <p><i class="fa fa-calendar"></i> Borrow Date : &nbsp;<span class="badge badge-success"><?php echo $borrow_date ; ?></span></p>
                                </li>
                                <li class="list-group-item">
                                    <p><i class="fa fa-calendar"></i> Due Date : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-warning"><?php echo $due_date ; ?></span></p>
                                </li>
                            </ul>
                        </section>
                    </aside>
                  </div>
                  <div class="col-lg-12">
                    <table>
                      <tr align="center">
                        <th>Book Code</th>
                        <th>Book Title</th>
                        <th>Book Category</th>
                        <th>Book Author</th>
                        <th>Return Info</th>
                      </tr>
                      <?php

                        include "db_conn.php";

                          $stmt3 = $conn->prepare("SELECT b.book_code as book_code, b.book_tittle as book_tittle, b.book_author as book_author, d.category_name as book_category, a.return_status as return_status, c.due_date as due_date
            						 	 												 FROM `return` AS a
            						 	 		 										 JOIN book AS b ON a.book_id=b.book_id
            						 	 		 										 JOIN category AS d ON b.category_id=d.category_id
            						 	 		 										 JOIN borrow AS c ON a.borrow_id=c.borrow_id
            						 	 												 AND c.borrow_id =?");
                            $stmt3->bind_param("s", $borrow_id);
                            $stmt3->execute();
                            $result3 = $stmt3->get_result();

                            while($row3 = $result3->fetch_assoc())
                            {

                              $book_code = $row3['book_code'];
        				              $book_tittle = $row3['book_tittle'];
        				              $book_category = $row3['book_category'];
        				              $book_author = $row3['book_author'];
                              $return_status = $row3['return_status'];
                              $due_date = date_format(date_create($row3['due_date']), 'Y-m-d');

                              date_default_timezone_set("Asia/Kuala_Lumpur");
                          		$now_date = date("Y-m-d");

                               $date1 = new DateTime($now_date);
                               $date2 = new DateTime($due_date);

                               $diff = $date2->diff($date1)->format("%a");
                               $days = intval($diff);

                        ?>
                       <tr>
                         <td><?php echo $book_code ;?></td>
                         <td><?php echo $book_tittle ;?></td>
                         <td><?php echo $book_category ;?></td>
                         <td><?php echo $book_author ;?></td>
                          <td align="center">
                            <?php

                                if($return_status == 1){
                                  echo "<b><i> <i class='fa fa-check'></i></b>";
                                }
                                else{
                                  echo "<b>".$days." Left!</b>";
                                }

                              ?>
                          </td>
                       </tr>
                       <?php }?>
                    </table>
                  </div>
        				</div>
                <div class="modal-footer">
                </div>
			      </div>
        </div>
    </div>
<!-- /.modal -->
