<?php

		include('librarian/db_conn.php');

			if(isset($_POST['login']))
			{
				$username = $_POST['username'];
				$password= md5 ($_POST['password']);

				if($username!=''&& $password!='')
				{
					$stmt = $conn->prepare("SELECT * FROM librarian WHERE librarian_username=? AND librarian_password=?");
					$stmt->bind_param("ss", $username, $password);
					$stmt->execute();

					if($stmt->fetch())
					{

						$librarian_username = $username;
						$librarian_password = $password;

						include('librarian/db_conn.php');

						$stmt1 = $conn->prepare("SELECT * FROM librarian WHERE librarian_username=? AND librarian_password=?");
						$stmt1->bind_param("ss", $librarian_username, $librarian_password);
						$stmt1->execute();
						$result1 = $stmt1->get_result();
						$row1 = $result1->fetch_assoc();
						$id = $row1 ['librarian_id'];

							if($id!='')
							{
								if($row1['librarian_status']==0){

										session_start();

										$_SESSION['id'] = $id;

											echo "<script>alert('Welcome... Login is Successfull!')</script>";
											echo "<script>window.location.href='librarian/dashboard.php?id=$id';</script>";

								}else{

									echo "<script>alert('Your account is Inactive!');</script>";
									echo "<script>window.location.href='index.php';</script>";

								}
						}else{

								echo "<script>alert('login is Failed!')</script>";
								echo "<script>window.location.href='index.php';</script>";

						}
					}
					else
					{
						$stmt2 = $conn->prepare("SELECT * FROM admin WHERE admin_username=? AND admin_password=?");
						$stmt2->bind_param("ss", $username, $password);
						$stmt2->execute();

						if($stmt2->fetch())
						{

								session_start();

								 $_SESSION['id']= "1";

									echo "<script>alert('Welcome... Login is Successfull!')</script>";
									echo "<script>window.location.href='admin/index.php';</script>";

						}
						else
						{
							$stmt3 = $conn->prepare("SELECT * FROM member WHERE member_ic=? AND member_password=?");
							$stmt3->bind_param("ss", $username, $password);
							$stmt3->execute();
							$result3 = $stmt3->get_result();
							$row3 = $result3->fetch_assoc();
							$id = $row3 ['member_ic'];

							if($id != '')
							{
								session_start();

								$_SESSION['username']=$id;

									 	echo "<script>alert('Welcome... Login is Successfull!')</script>";
										echo "<script>window.location.href='memberMainPage.php';</script>";

							}
							else
							{
								echo "<script>alert('Your Email or Password is Incorrect!')</script>";
								echo "<script>window.location.href='index.php';</script>";
							}
						}
					}
				}
				else
				{
					echo "<script>alert('Please enter your Email and Password!')</script>";
					echo "<script>window.location.href='index.php';</script>";
				}
			}

?>
