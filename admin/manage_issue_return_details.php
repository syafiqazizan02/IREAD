<!-- modal-->
     <div class="modal fade" id="viewdetails<?php echo $done_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog modal-lg" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" class="modal-header">Manage Issue   <small>Return Details</small></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                  <?php

                    include "db_conn.php";

                      $stmt2 = $conn->prepare(" SELECT g.done_date as done_date, e.member_fullname as member_fullname
                                                FROM done AS g
                                                JOIN member AS e ON g.member_id=e.member_id
                                               AND g.done_id =?;");

                      $stmt2->bind_param("s", $done_id);
                      $stmt2->execute();
                      $result2 = $stmt2->get_result();
                      $row2 = $result2->fetch_assoc();
                      $member_fullname = $row2['member_fullname'];
                      $done_date = date_format(date_create($row2['done_date']), 'd M Y');
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
                                    <p><i class="fa fa-calendar"></i> Return Date : &nbsp;<span class="badge badge-info"><?php echo $done_date ; ?></span></p>
                                </li>
                            </ul>
                        </section>
                    </aside>
                  </div>
                  <div class="col-lg-12">
                    <table>
                      <tr>
                        <th>Book Code</th>
                        <th>Book Title</th>
                        <th>Borrow Date</th>
                        <th>Return Date</th>
                        <th>Penalty Days</th>
                        <th>Penalty Amount</th>
                      </tr>
                      <?php

                        include "db_conn.php";

                          $penaltyAmount = 0;

                          $stmt3 = $conn->prepare("SELECT a.penalty_day as penalty_day, a.penalty_amount as penalty_amount, b.book_code as book_code, b.book_tittle as book_tittle, c.borrow_date as borrow_date, c.due_date as due_date
                                                   FROM `return` AS a
                                                   JOIN book AS b ON a.book_id=b.book_id
                                                   JOIN borrow AS c ON a.borrow_id=c.borrow_id
                                                   JOIN done AS g ON a.done_id=g.done_id
                                                   AND g.done_id =?");

                            $stmt3->bind_param("s", $done_id);
                            $stmt3->execute();
                            $result3 = $stmt3->get_result();

                            while($row3 = $result3->fetch_assoc())
                            {

                              $book_code = $row3['book_code'];
        				              $book_tittle = $row3['book_tittle'];
                              $borrow_date = date_format(date_create($row3['borrow_date']), 'd M Y');
                              $due_date = date_format(date_create($row3['due_date']), 'd M Y  ');
                              $penalty_day= $row3['penalty_day'];
        				              $penalty_amount = $row3['penalty_amount'];
                        ?>
                       <tr>
                         <td><?php echo $book_code ;?></td>
                         <td><?php echo $book_tittle ;?></td>
                         <td><?php echo $borrow_date ;?></td>
                         <td><?php echo $due_date ;?></td>
                         <td align="center">
                           <?php

                              if ($penalty_day == 0){

                                echo "No Penalty";

                              }else {

                                echo $penalty_day." Days";

                              }
                           ?>
                         </td>
                         <td  align="center">
                           <?php

                               if ($penalty_amount == 0){

                                 echo "No Penalty";

                               }else {

                                 echo "RM ".$penalty_amount;

                               }
                           ?>
                         </td>
                       </tr>
                       <?php

                       $penaltyAmount += $penalty_amount;

                      }?>
                      <tr>
                       <td colspan="5"><p align="right" style="font-weight: bold; color:#000000;">Total :</p></td>
                       <td  align="center">
                         <?php

                           if ($penalty_amount == 0){

                             echo "<b> 0 </b>";

                           }else {

                             echo "<b> RM ".$penaltyAmount."</b>";

                           }
                         ?>
                       </td>
                     </tr>
                    </table>
                  </div>
        				</div>
                <div class="modal-footer">
                </div>
			      </div>
        </div>
    </div>
<!-- /.modal -->
