﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
	<meta http-equiv="Content-type" content="text/html; charset=UTF-8"/>
	<meta name="description" content="Distributed WPA PSK security audit environment"/>
	<meta name="keywords" content="free, audit, security, online, besside-ng, aircrack-ng, pyrit, wpa, wpa2, crack, cracker, distributed, wordlist, hashcat, online hashcat"/>

	<title>Distributed WPA auditor</title>

	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/login_page.css" rel="stylesheet" media="screen">
</head>

<body>
	<!-- script -->
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/login_page.js"></script>
	<!-- scripts end -->

	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
         		<span class="sr-only">Toggle navigation</span>
         		<span class="icon-bar"></span>
         		<span class="icon-bar"></span>
         		<span class="icon-bar"></span>
       		</button>
				<a class="navbar-brand" href="#">Distributed WPA auditor</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="#">Agents</a>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tasks <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#">Show Tasks</a>
							</li>
							<li><a href="#">New Task</a>
							</li>
							<li><a href="#">Pre-conf Tasks</a>
							</li>
						</ul>
					</li>
					<li><a href="#">Files</a>
					</li>
					<li><a href="#">Stats</a>
					</li>
				</ul>

				<ul class="nav navbar-nav navbar-right">

					<!-- LOGIN PAGE START -->
					<!-- Button HTML (to Trigger Modal) -->
					<?php
						if(!isset($_COOKIE['key'])) {
							echo '<a href="#myModal" class="btn btn-default navbar-btn" data-toggle="modal">Login</a>';
						}
						else {
							echo '<a href="#" class="btn btn-default navbar-btn" data-toggle="modal">Log out</a>';
						}
					?>

					<!-- Modal HTML -->
					<div id="myModal" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h4 class="modal-title">Login & Register</h4>
								</div>

								<div class="modal-body">
									<div class="col-md-6 col-sm-6 no-padng">
										<div class="model-l">
											<form method="post" id="logFrm" class="log-frm" name="logFrm">
												<ul>
													<li>Key</li>
													<li> <input type="text" placeholder="Your key" id="userName" name="userName" class="form-control" onfocus="checkNullProf();">
													</li>
													<li><br/><button type="button" onclick="userLogin();" id="logBtn" class="btn btn-default">Log in</button>
													</li>
													<div style="display:none;" id="loginFail" class="sign">
														<li>
															<font color="red"> Username or password is incorrect.</font>
														</li>
													</div>
												</ul>
											</form>
											<div class="clearfix"></div>
											<form method="post" id="logFrm1" class="log-frm" name="logFrm1">
												<ul>
													<li>
														<a class="for-got" onclick="ayantoggle();" href="javascript:;">Forgot your key?</a>
														<div class="forgot">
															<ul>
																<li>
																	<p>Enter your Email Address here to receive your key.</p>
																</li>
																<li>Email</li>
																<li><input type="text" placeholder="Your email id" id="forgetemailId" class="form-control" name="forgetemailId">
																</li>
																<li><button type="button" class="btn btn-default" onclick="forgot();">Send Mail</button>
																</li>
															</ul>
														</div>
													</li>
												</ul>
											</form>
										</div>
									</div>
									<div class="col-md-6 col-sm-6 no-padng">
										<div class="model-r">
											<div class="o-r">
												<span>OR</span>
											</div>
											<form method="post" id="userRegisterFrm" class="log-frm" name="userRegisterFrm">
												<ul>
													<li>Nickname</li>
													<li><input type="text" placeholder="Nickname" name="fName" class="form-control">
													</li>
													<li>Email</li>
													<li><input type="text" placeholder="Email" name="emailId" class="form-control">
													</li>
													<br>
													<li><button type="button" name="userRegBtn" class="btn btn-default">Signup Now</button>
													</li>
													<div style="display:none;" class="sign greenglow">
														<li> <i class="icon-check"></i><br>
															<font color="red">
																User registration successful.<br> Your key already send to your email.
															</font>
														</li>
													</div>
													<div style="display:none;" id="regnSuc11" class="sign redglow">
														<li> <i class="icon-mail"></i><br>
															<font color="red"> Email Exist.</font>
														</li>
													</div>
												</ul>
											</form>
										</div>
									</div>

									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						<!-- LOGIN PAGE END -->

				</ul>
				<form class="navbar-form navbar-right">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Search">
					</div>
					<button type="submit" class="btn btn-default">Submit</button>
				</form>

				</div>
				<!-- /.navbar-collapse -->
			</div>
			<!-- /.container-fluid -->
	</nav>

	<!-- nav bar end -->

	<div class="page-header">
		<h1>Как стать частью команды?</h1>
		<p>Нажимаем кнопку Sign up и регистрируемся</p>
	</div>
</body>

</html>