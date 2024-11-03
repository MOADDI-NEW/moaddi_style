<?php 
ob_start();
session_start();
$noNavbar = '';
$main_header_school = '';
$main_sidebar_school = '';
$pageTitle = ' الاسئلة  ';  // this function to load page title
include 'init.php';   //  Dirctory page

if (isset($_SESSION['user'])){
$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
$getUser->execute(array($sessionUseer));
$info = $getUser->fetch(); ?>

		<!-- breadcrumb -->
		<?php include 'breadcrumb.php';

$do = isset($_GET['do']) ? $_GET['do'] : 'View';  // shor if 
	// Statr Manage Page
	if($do == 'View'){  //==== Manage Page ==  ?>
      <div class="container-fluid">
         <div class="row row-sm row-deck">
            <div class="col-md-12">
               <div class="card card-primary card-outline">
               <?php
                     $quetionid = isset($_GET['quetionid']) && is_numeric($_GET['quetionid']) ? intval($_GET['quetionid']) : 0;
                     // جلب السؤال الحالي
                     $stmt = $con->prepare("SELECT * FROM questions WHERE id = ? LIMIT 1");
                     $stmt->execute(array($quetionid));
                     $question = $stmt->fetch();

                     if ($question) {
                        // تحقق مما إذا كان المستخدم قد أجاب مسبقًا
                        $_SESSION['user_id'] = $info['UserID'];
                        $stmt = $con->prepare("SELECT * FROM user_answers WHERE user_id = ? AND question_id = ?");
                        $stmt->execute(array($_SESSION['user_id'], $quetionid)); // Use user_id from the session
                        $answer = $stmt->fetch();

                        if ($answer) {
                           echo "<div class='nice-message'>لقد أجبت بالفعل على هذا السؤال</div>";
                        } else { 
                           ?>
<script>
    window.onload = function () {
        var totalDuration = 60 * 2; // Total timer duration in seconds (3 minutes)
        var display = document.querySelector('#time');
        var form = document.getElementById('questionForm');

        // Retrieve remaining time from localStorage or set it to the full duration if not present
        var savedTime = localStorage.getItem('remainingTime');
        var startTime = savedTime ? parseInt(savedTime, 10) : totalDuration;

        startTimer(startTime, totalDuration, display, form);

        form.addEventListener('submit', function (event) {
            var checkedAnswer = document.querySelector('input[name="answer"]:checked');
            if (!checkedAnswer) {
                alert('Please select an answer before submitting.');
                event.preventDefault(); // Prevent form submission if no answer is selected
            } else {
                clearInterval(timerInterval); // Stop the timer once the form is submitted
                localStorage.removeItem('remainingTime'); // Clear timer data on form submission
            }
        });
    };

    var timerInterval; // Declare timerInterval globally

    function startTimer(duration, totalDuration, display, form) {
        var timer = duration, minutes, seconds;
        timerInterval = setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                clearInterval(timerInterval); // Stop the timer once it reaches 0
                localStorage.removeItem('remainingTime'); // Clear saved time when timer ends

                var checkedAnswer = document.querySelector('input[name="answer"]:checked');
                if (!checkedAnswer) {
                    // Assign default answer '5' if no answer is selected
                    var defaultAnswer = document.createElement("input");
                    defaultAnswer.setAttribute("type", "hidden");
                    defaultAnswer.setAttribute("name", "answer");
                    defaultAnswer.setAttribute("value", "5");
                    form.appendChild(defaultAnswer); // Append the hidden input with the default answer
                }
                form.submit(); // Submit the form once
            } else {
                // Save the remaining time in localStorage on each tick
                localStorage.setItem('remainingTime', timer);
            }
        }, 1000);
    }
</script>

                           <div class="container">
                              <form id="questionForm" action="?do=Insert" method="POST">
                                <div class="col-md-12">
                                    <div class="form-group has-danger" style="text-align: right;">
                                        <label class="control-label">  نص السؤال  </label>
                                        <p style="padding: 5px;background-color: #3b6e9b;border-radius: 5px;color: #fff;">  
                                            <?php echo $question['question'];?>   
                                        </p>                                    
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-radio mb-3">
                                            <input class="custom-control-input" type="radio" id="customRadio1" name="answer" value="1">
                                            <label for="customRadio1" class="custom-control-label"><?php echo $question['option1'];?> </label>
                                        </div>
                                        <div class="custom-control custom-radio mb-3">
                                            <input class="custom-control-input" type="radio" id="customRadio2" name="answer" value="2">
                                            <label for="customRadio2" class="custom-control-label"><?php echo $question['option2'];?> </label>
                                        </div>
                                        <div class="custom-control custom-radio mb-3">
                                            <input class="custom-control-input" type="radio" id="customRadio3" name="answer" value="3">
                                            <label for="customRadio3" class="custom-control-label"><?php echo $question['option3'];?> </label>
                                        </div>
                                        <div class="custom-control custom-radio mb-3">
                                            <input class="custom-control-input" type="radio" id="customRadio4" name="answer" value="4">
                                            <label for="customRadio4" class="custom-control-label"><?php echo $question['option4'];?> </label>
                                        </div>
                                        <div class="custom-control custom-radio mb-3">
                                            <input class="custom-control-input" type="radio" id="customRadio5" name="answer" value="5" checked="">
                                            <label for="customRadio5" class="custom-control-label"> لا اعرف الاجابة </label>
                                        </div>
                                    </div>
                                </div>
                                 <input type="hidden" name="question_id" value="<?php echo $question['id'];?>">
                                 <input type="hidden" name="user_id" value="<?php echo $info['UserID'];?>">
                                 <hr>
                                 <input type="submit" class="btn btn-sm btn-success" value="إجابة">
                              </form>
                              <div class="timer-container">
                                <div class="timer-text">
                                    الوقت المتبقي: <span id="time">02:00</span>
                                </div>
                            </div>
                           </div>
                          <?php
                        }
                     } else {
                        echo "لا يوجد سؤال حالي.";
                     }
                     ?>
               </div>
            </div>
         </div>
      </div><br><br><br><br><br><br><br><br><br><?php 
			
	
	}elseif($do == 'Insert'){      
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
         $quetionid = isset($_POST['question_id']) ? intval($_POST['question_id']) : 0;

         $stmt = $con->prepare("SELECT * FROM user_answers WHERE user_id = ? AND question_id = ?");
         $stmt->execute(array($_SESSION['user'], $quetionid));
         $existing_answer = $stmt->fetch();
         
         if ($existing_answer) {
             echo "لقد أجبت بالفعل على هذا السؤال.";
             exit;
         }

               $user_id  = $_POST['user_id'];
               $question_id  = $_POST['question_id'];
               $answer  = isset($_POST['answer']) ? $_POST['answer'] : 5;

               $formErrors = array();
              
               if (empty($user_id)) {
                   $formErrors[] = '<span> لا يمكنك ترك اسم المستخدم فارغا</span> </i>';
               }
               ?>
                
                <div class ="container-fluid" style="direction:rtl;">	
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-default">
                                <div class="card-body">
                                    <div class="table-responsive export-table">
                                        <table class="table table-bordered table-sm" style= "width:98%; direction:rtl;">
                                            <thead><?php
                                                foreach ($formErrors as $error) { ?> 
                                                    <tr>
                                                        <th class="bg-danger" style="width:90%;vertical-align:middle;font-size:small;"><?php echo $error ;?></th>
                                                        <th><a type="button" class="btn btn-block btn-sm bg-navy"  href="javascript:history.go(-1)">عودة</a></th>
                                                    </tr><?php 
                                                }?>	
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><?php
               
               if (empty($formErrors)){
                        // Inser Info to database *** مهم *** 
                        $stmt = $con->prepare("INSERT INTO 
                                                user_answers
                                                    (user_id, question_id, answer)
                                                VALUES
                                                    (:zuser_id, :zquestion_id, :zanswer)"); 
                        $stmt->execute(array(
                            'zuser_id'  => $user_id,
                            'zquestion_id'  => $question_id,
                            'zanswer' => $answer
                        ));
                        //Echo Success Measage
                        if ($stmt) { // if it's true
                            sleep(1);?>
                            <script src="../layout/dist/js/sweetalert2.min.js"></script>
                            <script>
                                Swal.fire({
                                    title: 'تم إضافة الاجابة بنجاح',
                                    width: 600, icon: 'success',  padding: '4em',
                                    color: '#716add', showConfirmButton: false,
                                    background: '#fff',  backdrop: `rgba(0,80,123,0.8)`
                                });
                            </script>
                            <?php
                            $theMsg = isset($theMsg) ? $theMsg : '';
                            redirectHome($theMsg);
                        }
                }

         }
   }
	
}else{
	header ('location: index');
	exit();
}
include   $tpl . 'footer.php';
include   $tpl . 'footer-scripts.php';
ob_end_flush();
?>