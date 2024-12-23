<?php
ob_start();
session_start();
$noNavbar = '';  // No Navbar in this page
$pageTitle = 'تسجيل طلب اشتراك ';  // this function to load page title

if (isset($_SESSION['user'])) {
	header('location: index');  // Redirct to index
}
include 'login_init.php';

 $settings = getSettingsToHomePage($con); 
// Check If User Coming from HTTP Post Reqest
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST['login'])) {
		$user = $_POST['username'];
		$pass = $_POST['password'];
		$hashedPass = sha1($pass);
		$role = $_POST['role'];
		// Check if the User Exist in Database	
		$stmt = $con->prepare("SELECT UserID, Username, Password FROM users WHERE Username = ? AND Password = ? AND role = 44 AND RegStatus = 1");
		$stmt->execute(array($user, $hashedPass));
		$get = $stmt->fetch();
		$count = $stmt->rowCount();
		// if count > 0 this mean the Database contain RECORD about Username 
		if ($count > 0) {
			$_SESSION['user'] = $user; // Register Session Name
			$_SESSION['uid'] = $get['UserID']; // Register Session User_ID

			header('location: school.php');  // Redirct to dashboard
			exit();
		}
	} else {
		$formErrors = array();
		$username  = $_POST['username'];
		$password  = $_POST['password'];
		$password2 = $_POST['password2'];
		$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

		$name = htmlspecialchars($_POST['full']);

		$country  = $_POST['country'];
		$phone  = $_POST['phone'];
		$whatsapp  = $_POST['whatsapp'];
		$wechat  = $_POST['wechat'];
		
		$user_avatarName = $_FILES['user_avatar']['name'];
		$user_avatarSize = $_FILES['user_avatar']['size'];
		$user_avatarTmp  = $_FILES['user_avatar']['tmp_name'];
		$user_avatarType = $_FILES['user_avatar']['type'];
		$user_avatarAllowedExtension = array("jpeg", "jpg", "png", "gif");
		$tmp = explode('.', $user_avatarName);
		$user_avatarExtension = end($tmp);
		
		$web_url  = $_POST['web_url'];

		$department  = filter_var($_POST['department'], FILTER_SANITIZE_NUMBER_INT);
		$role  = filter_var($_POST['role'], FILTER_SANITIZE_NUMBER_INT);


		if (isset($username)) {
			$filterdUser = filter_var($username, FILTER_SANITIZE_STRING);
			if (strlen($filterdUser) < 3) {
				$formErrors[] = "<div id='success-alert' class='alert alert-danger'> Username must be more than 3 characters </div>";
			}
			if (strlen($filterdUser) > 20) {
				$formErrors[] = "<div id='success-alert' class='alert alert-danger'> Username must be less than 20 characters. </div>";
			}
		}
		if (isset($password) && isset($password2)) {
			if (empty($password)) {
				$formErrors[] = "<div id='success-alert' class='alert alert-danger'> Password cannot be left blank. </div>";
			}
			$pass1 = sha1($_POST['password']);
			$pass2 = sha1($_POST['password2']);
			if ($pass1 !== $pass2) {
				$formErrors[] = "<div id='success-alert' class='alert alert-danger'> Password does not match </div>";
			}
		}
		if (isset($email)) {
			$filterdEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
			if (filter_var($filterdEmail, FILTER_VALIDATE_EMAIL) != true) {
				$formErrors[] = "<div id='success-alert' class='alert alert-danger'> Invalid email </div>";
			}
		}
		
		if (isset($role)) {
			if ($role == 0) {
					$formErrors[] = "<div id='success-alert' class='alert alert-danger'>  Choose who you re? </div>";
			}
		}
		if (isset($user_avatarName)) {
			if (! empty($user_avatarName) && ! in_array($user_avatarExtension, $user_avatarAllowedExtension)){
				$formErrors[] = "<div id='success-alert' class='alert alert-danger'> امتداد الصورة عير مسموح به</div>";
			}
			if (empty($user_avatarName)) {
					$formErrors[] = "<div id='success-alert' class='alert alert-danger'> يجب اختيار صور شخصية</div>";
			}
			if ($user_avatarSize > 2621440) {
					$formErrors[] = "<div id='success-alert' class='alert alert-danger'> حجم الصورة يجب ان يكون اقل من 2.5 ميجا بايت</div>";
			}
		}

		if (empty($formErrors)) {
								$user_avatar = rand(0, 1000000000)	. '_' . $user_avatarName;
                        move_uploaded_file($user_avatarTmp , "admin/nsharat_uploads/user_avatar//" . $user_avatar);

			$check = checkItem("Username", "users", $username);
			if ($check == 1) {
				$formErrors[] = "<div class='alert alert-danger'> اسم المستخدم موجود مسبقا</div>";
			} else {
				$stmt = $con->prepare("INSERT INTO users
										(Username, Password, Email, FullName,  
										country, phone, whatsapp, wechat, user_avatar, web_url, department, role, 
										RegStatus, Date)
									VALUES(:zuser, :zpass, :zmail, 
											:zname,  :zcountry, :zphone, :zwhatsapp, :zwechat, :zuser_avatar, :zweb_url,
											:zdepartment, :zrole,  
											0, now())");
				$stmt->execute(array(

					'zuser'  => $username,
					'zpass'  => sha1($password),
					'zmail' => $email,
					'zname' => $name,
					'zcountry' => $country,
					'zphone' => $phone,
					'zwhatsapp' => $whatsapp,
					'zwechat' => $wechat,
					'zuser_avatar' => $user_avatar,
					'zweb_url' => $web_url,
					'zdepartment' => $department,
					'zrole' => $role
				));
				//Echo Success Measage
				$succesMsg = 'Your data has been successfully registered <br> Your data is being reviewed... Please wait until the request is accepted by the administration';
				header('Refresh: 5; URL=index');
			}
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8"><meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'><meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>  New registration   - <?php echo $settings[0]; ?> </title>
  	<meta content="<?php echo $settings[1]; ?>" name="description">
	<meta name="Author" content="Alaa Amer">
	<meta name="Keywords" content="سمارت جيم" />
	<!-- <meta http-equiv="refresh" content="0; URL=underconstruction" /> -->
	<link rel="icon" href="../assets/img/favicon.png" type="image/x-icon" />
	<link rel="stylesheet" href="layout/plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="layout/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<link rel="stylesheet" href="layout/dist/css/adminlte.min.css">
	<link rel="stylesheet" href="layout/dist/css/new_style.css">
</head>

<body class="hold-transition register-page area">
	<ul class="circles"><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li></ul>
		<div class="container">
			<div class="row d-flex justify-content-center">
				<?php
				if (!empty($formErrors)) {
					foreach ($formErrors as $error) {
						echo '<div class="col text-center">';
						echo '<a href="signup" class="btn btn-warning btn-sm btn-block">' . 'عودة' . $error . '</a>';
						echo '</div>';
					}
				}
				if (isset($succesMsg)) {
					echo  "<div  class= 'alert alert-success'>" . '<a href="index" class="btn btn-success btn-sm btn-block">' . $succesMsg . '</a>' . "</div>";
				}?>
			</div>
		</div>
	<div class="register-box" style="width: 80%;">
		<div class="card">
			<div class="card-body register-card-body">
				<div class="login-logo d-flex justify-content-between" style="padding: 10px 5px;">
					<div class="input-group-append"><a href="../"><div class="input-group-text"><span class="fas fa-home"></span></div></a></div>
					<div class="input-group-append"><a href="../"><div class="input-group-text"> Moaddi  </div></a></div>
					<div class="input-group-append"><a href="./"><div class="input-group-text"><span class="fas fa-user"></span></div></a></div>
				</div>
				<p class="login-box-msg text-primary"> New registration  </p>
				<form action="#" method="POST" enctype="multipart/form-data">

					<label style="font-family: 'Changa', sans-serif;color:#0162e8;">  Username & Password </label>
						<div class="row">
							<div class="col-lg-4">
								<div class="input-group mb-3">
									<input class="form-control" type="text" name="username" id="username" autocomplete="off"  style="padding:0px;font-size:small;" placeholder="اسم المستخدم" required="required" onBlur="checkUsernameAvailability()"  value="<?php echo (rand(100000,999999));?>"/>
										<script> function checkUsernameAvailability() { $("#loaderIcon").show(); jQuery.ajax({ url: "check_availability", data: 'Username=' + $("#username").val(), type: "POST", success: function(data) { $("#username-availability-status").html(data); $("#loaderIcon").hide(); }, error: function() {} }); } </script>
									<div class="input-group-append"><div class="input-group-text"><span class="fas fa-user"></span></div></div>
									<center> <span id="username-availability-status" style="font-size:12px;"></span> </center>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="input-group mb-3">
									<input minlength="4" class="form-control" type="password" name="password" autocomplete="new-password" style="padding:0px;font-size:small;" placeholder="Password" required="required" />
									<div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="input-group mb-3">
									<input minlength="4" class="form-control" type="password" name="password2" autocomplete="new-password" style="padding:0px;font-size:small;" placeholder="Re-Password" required="required" />
									<div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>
								</div>
							</div>
						</div>
							<label style="font-family: 'Changa', sans-serif;color:#0162e8;"> Basic information </label>
							<div class="row">
								<div class="col-lg-4">
									<div class="input-group mb-3">
										<input class="form-control" type="text" name="full" style="padding:0px;font-size:small;" placeholder="Your Name" />
										<div class="input-group-append"><div class="input-group-text"><span class="fas fa-user"></span></div></div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="input-group mb-3">
										<input class="form-control" type="email" name="email" style="padding:0px;font-size:small;" placeholder="Your Email" />
										<div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>
									</div>
								</div>
								<div class="col-lg-4">
									<select name="country" class="form-control select2" style="width: 100%;">
										<option value="0">  -Select-  </option><option value="Afghanistan">Afghanistan</option><option value="Åland Islands">Åland Islands</option><option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option><option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Anguilla">Anguilla</option><option value="Antarctica">Antarctica</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Argentina">Argentina</option><option value="Armenia">Armenia</option><option value="Aruba">Aruba</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option><option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option><option value="Botswana">Botswana</option><option value="Bouvet Island">Bouvet Island</option><option value="Brazil">Brazil</option><option value="British Indian Ocean Territory">British Indian Ocean Territory</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option><option value="Burkina Faso">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option><option value="Cayman Islands">Cayman Islands</option><option value="Central African Republic">Central African Republic</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="China">China</option><option value="Christmas Island">Christmas Island</option><option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Congo">Congo</option><option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option><option value="Cook Islands">Cook Islands</option><option value="Costa Rica">Costa Rica</option><option value="Cote D'ivoire">Cote D'ivoire</option><option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option><option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option><option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option><option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Ethiopia">Ethiopia</option><option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option><option value="Faroe Islands">Faroe Islands</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France">France</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option><option value="French Southern Territories">French Southern Territories</option><option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Georgia">Georgia</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option><option value="Guernsey">Guernsey</option><option value="Guinea">Guinea</option><option value="Guinea-bissau">Guinea-bissau</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option><option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Isle of Man">Isle of Man</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Jersey">Jersey</option><option value="Jordan">Jordan</option><option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option><option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option><option value="Korea, Republic of">Korea, Republic of</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Liberia">Liberia</option><option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macao">Macao</option><option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Marshall Islands">Marshall Islands</option><option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mayotte">Mayotte</option><option value="Mexico">Mexico</option><option value="Micronesia, Federated States of">Micronesia, Federated States of</option><option value="Moldova, Republic of">Moldova, Republic of</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Montenegro">Montenegro</option><option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Myanmar">Myanmar</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option><option value="New Caledonia">New Caledonia</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option><option value="Norfolk Island">Norfolk Island</option><option value="Northern Mariana Islands">Northern Mariana Islands</option><option value="Norway">Norway</option><option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option><option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option><option value="Pitcairn">Pitcairn</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Reunion">Reunion</option><option value="Romania">Romania</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option><option value="Saint Helena">Saint Helena</option><option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option><option value="Saint Lucia">Saint Lucia</option><option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option><option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option><option value="Samoa">Samoa</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia">Serbia</option><option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Slovakia">Slovakia</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option><option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syrian Arab Republic">Syrian Arab Republic</option><option value="Taiwan">Taiwan</option><option value="Tajikistan">Tajikistan</option><option value="Tanzania, United Republic of">Tanzania, United Republic of</option><option value="Thailand">Thailand</option><option value="Timor-leste">Timor-leste</option><option value="Togo">Togo</option><option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Turks and Caicos Islands">Turks and Caicos Islands</option><option value="Tuvalu">Tuvalu</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option><option value="United Kingdom">United Kingdom</option><option value="United States">United States</option><option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option><option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option><option value="Venezuela">Venezuela</option><option value="Viet Nam">Viet Nam</option><option value="Virgin Islands, British">Virgin Islands, British</option><option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option><option value="Wallis and Futuna">Wallis and Futuna</option><option value="Western Sahara">Western Sahara</option><option value="Yemen">Yemen</option><option value="Zambia">Zambia</option><option value="Zimbabwe">Zimbabwe</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4">
									<div class="input-group mb-3">
										<input class="form-control" type="text" name="phone" style="padding:0px;font-size:small;" placeholder="Your Phone" />
										<div class="input-group-append"><div class="input-group-text"><span class="fas fa-phone"></span></div></div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="input-group mb-3">
										<input class="form-control" type="text" name="whatsapp" style="padding:0px;font-size:small;" placeholder="Your whatsapp" />
										<div class="input-group-append"><div class="input-group-text"><span class="fab fa-whatsapp"></span></div></div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="input-group mb-3">
										<input class="form-control" type="text" name="wechat" style="padding:0px;font-size:small;" placeholder="Your wechat" />
										<div class="input-group-append"><div class="input-group-text"><span class="fab fa-weixin"></span></div></div>
									</div>
								</div>
							</div>
							<label style="font-family: 'Changa', sans-serif;color:#0162e8;"> Logo image </label>
							<div class="row">
								<div class="col-lg-6">
									<div class="input-group mb-3">
										<input class="form-control" type="file" name="user_avatar"   required="required"/>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="input-group mb-3">
										<input class="form-control" type="text" name="web_url"  style="padding:0px;font-size:small;" placeholder="Your web_url" required="required"/>
										<div class="input-group-append"><div class="input-group-text"><span class="fas fa-globe"></span></div>
									</div>
								</div>
							</div>
								<label style="font-family: 'Changa', sans-serif;color:#0162e8;">  Who you are </label>
								<div class="input-group mb-3">
									<select name="role" class="form-control">
										<option value="0">  -Select-  </option>
										<option value="44"> Brand companies & Factories </option>
										<option value="45"> Advertising & Marketing </option>
									</select>
								</div>

						<input type="hidden" value="10" name="department" class="form-control" />
					<div class="row">
						<div class="col-12">
							<input type="submit" name="signup" class="btn btn-primary btn-block" value="Registr" />
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<a href="./" class="btn btn-info btn-block">  I already have account  </a>
			</div>
		</div>
	</div>

	<!-- jQuery -->
	<script src="layout/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="layout/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

	<style>
		* {
			font-family: 'Tajawal', sans-serif;;
		}

		.bg-primary-transparent {
			background-color: #3a5d8b !important;
		}
	</style>


	<?php
	// include 'template/footer.php';
	// include 'template/footer-scripts-login.php';
	ob_end_flush();
	?>

</body>

</html>