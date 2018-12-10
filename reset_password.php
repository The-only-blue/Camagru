<?php
    require_once "core/init.php";
    $db = DB::getInstance();

    if(isset($_GET['user_id']))
    {
        $password = Input::get('password');
        //echo $password."<br>";
        $password_again = Input::get('password_again');
        //echo $password_again."<br>";
        if (strcmp($password, $password_again) === 0)
        {
            $password_harsh = Hash::make(Input::get('password'));
            $user_id = $_GET['user_id'];
            
            $sql = "UPDATE users SET `password` = ? WHERE user_id = ?";

            $update = $db->query($sql, array("password" => $password_harsh, "user_id" => $user_id));
            $count = $db->count();
            if ($count == 1)
            {
                Session::flash('Reset', 'Your password has been updated.');
                Redirect::to('login.php');
            }
            //echo "Password Updated Now <a href = 'login.php'>Login</a>";
        }
        else
        {
            //echo "Sorry passwords dont match";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>New Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/w3.css">


    <style>
            /* The message box is shown when the user clicks on the password field */
            #message {
                display:none;
                background: #f1f1f1;
                color: #000;
                position: relative;
                padding: 20px;
                margin-top: 10px;
            }

            #message p {
                padding: 10px 35px;
                font-size: 18px;
            }

            /* Add a green text color and a checkmark when the requirements are right */
            .valid {
                color: green;
            }

            .valid:before {
                position: relative;
                left: -35px;
                content: "✔";
            }

            /* Add a red text color and an "x" when the requirements are wrong */
            .invalid {
                color: red;
            }

            .invalid:before {
                position: relative;
                left: -35px;
                content: "✖";
            }
        </style>

</head>
<body>
    <!-- START header -->
    <div class="top-bar">
        <div class="container">
            <div class="col-9 social">
              <p align = "center">OOPS YOU FORGOT YOUR PASSWORD TO :(</p>
              <!--<img src = "img/camera_icon.jpg" alt = "camera icon" height = "75px" width = "75px">-->
            </div>
        </div>
    </div>

    <h1 class="site-logo" align = "center">Camagru</h1>

    <div class="container">
        <hr>
    </div>
    <!-- END header -->

    <!-- START content area -->
    <div align = "center">
    <div class="field">
        <form method="post" class="w3-container w3-card-4 w3-animate-left">
            <label for="password">New Password</label></br>
            <input class="w3-input" type="password" name="password" id="password" style="width:90%" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required></br>
            <div id="message">
                <h3 style = "color:	#808080">Password must contain the following:</h3>
                    <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                    <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                    <p id="number" class="invalid">A <b>number</b></p>
                    <p id="length" class="invalid">Minimum <b>8 characters</b></p>
            </div>
            <label for="password">Verify New Password</label></br>
            <input class="w3-input" type="password" name="password_again" id="password_again" style="width:90%"></br>
            <input class="w3-button w3-section w3-teal w3-ripple" type="submit" value="Reset Password">
        </form>
    </div>
    
    <link rel="stylesheet" href="css/style.css">
    </div>

    <!-------------------------------------------------------------------------------------------------------->
    <!-------------------------------------PASSWORD VALIDATION SCRIPT ---------------------------------------->
    <!-------------------------------------------------------------------------------------------------------->
    <script>

        var myInput = document.getElementById("password");
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("number");
        var length = document.getElementById("length");

        // When the user clicks on the password field, show the message box
        myInput.onfocus = function() {
            document.getElementById("message").style.display = "block";
        }

        // When the user clicks outside of the password field, hide the message box
        myInput.onblur = function() {
            document.getElementById("message").style.display = "none";
        }

        // When the user starts to type something inside the password field
        myInput.onkeyup = function() {
          // Validate lowercase letters
          var lowerCaseLetters = /[a-z]/g;
          if(myInput.value.match(lowerCaseLetters)) {  
            letter.classList.remove("invalid");
            letter.classList.add("valid");
          } else {
            letter.classList.remove("valid");
            letter.classList.add("invalid");
          }

          // Validate capital letters
          var upperCaseLetters = /[A-Z]/g;
          if(myInput.value.match(upperCaseLetters)) {  
            capital.classList.remove("invalid");
            capital.classList.add("valid");
          } else {
            capital.classList.remove("valid");
            capital.classList.add("invalid");
          }
      
          // Validate numbers
          var numbers = /[0-9]/g;
          if(myInput.value.match(numbers)) {  
            number.classList.remove("invalid");
            number.classList.add("valid");
          } else {
            number.classList.remove("valid");
            number.classList.add("invalid");
          }

          // Validate length
          if(myInput.value.length >= 8) {
            length.classList.remove("invalid");
            length.classList.add("valid");
          } else {
            length.classList.remove("valid");
            length.classList.add("invalid");
          }
        }

    </script>


</body>
</html>