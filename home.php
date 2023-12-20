<?php

@include 'config.php';

if(isset($_POST['submit'])) {

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   // Check password complexity
   $uppercase = preg_match('@[A-Z]@', $_POST['password']);
   $lowercase = preg_match('@[a-z]@', $_POST['password']);
   $number = preg_match('@[0-9]@', $_POST['password']);

   $error = array();

   if(strlen($_POST['password']) < 8) {
      $error[] = 'Password must be at least 8 characters long.';
   }
   
   if(!$uppercase || !$lowercase || !$number) {
      $error[] = 'Password must contain at least one uppercase letter, one lowercase letter, and one number.';
   }

   if($pass != $cpass){
      $error[] = 'Passwords do not match.';
   }

   // Check if email already exists
   $selectEmail = "SELECT * FROM user_form WHERE email = '$email'";
   $resultEmail = mysqli_query($conn, $selectEmail);

   if(mysqli_num_rows($resultEmail) > 0){
      $error[] = 'User with this email already exists.';
   }

   // Check if username already exists
   $selectUsername = "SELECT * FROM user_form WHERE name = '$name'";
   $resultUsername = mysqli_query($conn, $selectUsername);

   if(mysqli_num_rows($resultUsername) > 0){
      $error[] = 'User with this username already exists.';
   }

   if(empty($error)) {
       $insert = "INSERT INTO user_form(name, email, password, user_type, coins) VALUES('$name','$email','$pass','$user_type', 0.00)";
      mysqli_query($conn, $insert);
      header('location:./account/new.php');
   }
}

?>

<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         header('location:./home.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
     	 $_SESSION['coins'] = $row['coins'];
         header('location:/account/new.php');

      }
     
   }else{
      $error[] = 'incorrect email or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="mobile.css">

    <title>TradeSmart</title>
	<script>console.log("%c!STOP!","font-size: 36px; color: #DE350B; font-weight: 600"),console.log('%cDo not send anyone your cookies or paste any code in here.\nAny "hacks" or "exploits" are a SCAM! They WILL steal all of your coins.',"background: #26383f; color: #33c16c; font-size: 18px; padding: 8px;")</script>
</head>
<body>
    <header>
        <div class="logo">
	<h2 class="logotext" >TradeSmart</h2>
	</div>
        <div class="coin-box">
<div class="coins">
       </div></div>


       <div class="button-container">
       <button class="sidebar-button" data-target="Features">
                Features
            </button>
            <button class="sidebar-button" data-target="Pricing">
                Pricing
            </button>
</div>


        <div class="login-register">
            <button class="button-login" role="button" id="login-button">Login</button>
            <button class="button-register" id="register-btn" role="button">Register</button>
        </div>
    </header>

<div id="loader">
    <div class="loader-content">
        <img src="load.gif" alt="Loading...">
    </div>
</div>

<div id="Features" class="content-container">

You have to <strong>Login</strong> or <strong>Register</strong> to view Features page.

</div>

<div id="Pricing" class="content-container">
    You have to <strong>Login</strong> or <strong>Register</strong> to view Pricing page.
</div>

<div id="Reviews" class="content-container">
     You have to <strong>Login</strong> or <strong>Register</strong> to view Reviews page.
</div>

<div id="Trades" class="content-container">
       You have to <strong>Login</strong> or <strong>Register</strong> to view Trades page.
</div>

<div id="Legal" class="content-container">
      You have to <strong>Login</strong> or <strong>Register</strong> to view Legal page.
</div>

<div id="Disclaimer" class="content-container">
       You have to <strong>Login</strong> or <strong>Register</strong> to view Disclaimer page.
</div>

<div id="/NA/" class="content-container">
      You have to <strong>Login</strong> or <strong>Register</strong> to view /NA/ page.
</div>

<div id="/NA/" class="content-container">
       You have to <strong>Login</strong> or <strong>Register</strong> to view /NA/ page.
</div>

<div id="affiliate" class="content-container">
       You have to <strong>Login</strong> or <strong>Register</strong> to view Affiliate page.
</div>

<div id="referral" class="content-container">
       You have to <strong>Login</strong> or <strong>Register</strong> to view Referral page.
</div>

<div id="promo" class="content-container">
       You have to <strong>Login</strong> or <strong>Register</strong> to view Promo page.
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const sidebarButtons = document.querySelectorAll('.sidebar-button');
  const contentContainers = document.querySelectorAll('.content-container');

  sidebarButtons.forEach(button => {
    button.addEventListener('click', () => {
      const target = button.getAttribute('data-target');

      contentContainers.forEach(container => {
        container.classList.remove('show');
      });

      sidebarButtons.forEach(btn => {
        btn.classList.remove('active-button');
      });

      const targetContainer = document.getElementById(target);
      targetContainer.classList.add('show');
      button.classList.add('active-button');
    });
  });
});

</script>

     <form action="" method="post">
             <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="notification" id="notification">'.$error.'</span>';
         };
      };
      ?>
<div class="popout" id="popout">
    <div class="popout-content">
        <div class="popout-header">
            <div class="popout-title" id="popout-title">Create an Account</div>
            <div class="popout-login-register"></div>
            <button class="popout-close" id="popout-close-button">x</button>
        </div>

        <div class="boxes">
            <h3>Username</h3>
            <input type="text" name="name" id="name" placeholder="username" required autocomplete="username">
            <h3>E-mail</h3>
            <input type="email" name="email" id="email" placeholder="your email here" required autocomplete="email">
            <h3>Password</h3>
            <input type="password" name="password" id="password" placeholder="minimum 8 characters" required autocomplete="password">
            <h3>Password</h3>
            <input type="password" name="cpassword" placeholder="password again" required>
            <select class="type" name="user_type" value="user">
                <option class="type" value="user">user</option>
                <option class="type" value="admin">admin</option>
            </select>
        </div>

        <div class="switch-container">
            <div class="switch-group">
                <label class="switch">
                    
                <div class="checkbox-wrapper-33">
                        <label class="checkbox">
                            <input class="checkbox__trigger visuallyhidden" type="checkbox" />
                            <span class="checkbox__symbol">
                                <svg aria-hidden="true" class="icon-checkbox" width="28px" height="28px" viewBox="0 0 28 28" version="1" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 14l8 7L24 7"></path>
                                </svg>
                            </span>
                        </label>
                    </div>
                </label>
                <span class="marketing">Accept Terms & Conditions</span>
            </div>


            <div class="switch-group">
                <label class="switch">
                    <div class="checkbox-wrapper-33">
                        <label class="checkbox">
                            <input class="checkbox__trigger visuallyhidden" type="checkbox" />
                            <span class="checkbox__symbol">
                                <svg aria-hidden="true" class="icon-checkbox" width="28px" height="28px" viewBox="0 0 28 28" version="1" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 14l8 7L24 7"></path>
                                </svg>
                            </span>
                        </label>
                    </div>
                </label>
                <span class="marketing">Subscribe to our Newsletter</span>
            </div>
        </div>
        <input type="submit" name="submit" value="Register" class="form-btn">
    </div>
</div>
</form>

    <style>
.password-container {
    position: relative;
}

svg {
    margin-right: 20px;
}

.toggle-password {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
}

/* Styling for hiding password */
#passwordField[type="password"] {
    -webkit-text-security: disc; /* Safari */
}
</style>

<form action="" method="post">
<?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="notification" id="notification">'.$error.'</span>';
         };
      };
      ?>
    <div class="popout2" id="popout2">
        <div class="popout-content2">
            <div class="popout-header2">
                <div class="popout-title2" id="popout-title2">Welcome back</div>
                <div class="popout-login-register2">
                </div>
                <button class="popout-close" id="popout-close-button2">x</button>
            </div>
    <div class="boxes">
        <h3>Email</h3>
        <input type="email" name="email" placeholder="your email here" required autocomplete="email">
        <h3>Password</h3>
        <div class="password-container">
            <input type="password" name="password" id="passwordField" placeholder="your password" required autocomplete="password">
            <span class="toggle-password" id="togglePassword"><svg width="15px" height="15px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M2 2L22 22" stroke="#797979" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M6.71277 6.7226C3.66479 8.79527 2 12 2 12C2 12 5.63636 19 12 19C14.0503 19 15.8174 18.2734 17.2711 17.2884M11 5.05822C11.3254 5.02013 11.6588 5 12 5C18.3636 5 22 12 22 12C22 12 21.3082 13.3317 20 14.8335" stroke="#797979" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M14 14.2362C13.4692 14.7112 12.7684 15.0001 12 15.0001C10.3431 15.0001 9 13.657 9 12.0001C9 11.1764 9.33193 10.4303 9.86932 9.88818" stroke="#797979" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

</span>
        </div>
    </div>
    <input type="submit" name="submit" value="Login" class="form-btn">
</form>

<script>
// Get references to the password field and the toggle button
const passwordField = document.getElementById('passwordField');
const togglePassword = document.getElementById('togglePassword');

// Function to toggle password visibility
function togglePasswordField() {
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
    } else {
        passwordField.type = 'password';
    }
}

// Toggle password visibility on click
togglePassword.addEventListener('click', function () {
    togglePasswordField();
});
</script>


<script src="script.js"></script>
</body>
</html>
