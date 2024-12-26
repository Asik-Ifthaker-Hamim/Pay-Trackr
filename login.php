<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Admin | Pay-Trackr</title>
  
  <?php include('./header.php'); ?>
  <?php include('./db_connect.php'); ?>
  <?php 
    session_start();
    if(isset($_SESSION['login_id']))
      header("location:index.php?page=home");
  ?>
  
  <style>
    /* Body Styling */
    body {
      width: 100%;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #001f3f; /* Navy blue background */
      overflow: hidden; /* Prevent scrolling */
    }

    main#main {
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
    }

    /* Left Section (Login Background Image) */
    #login-left {
      position: absolute;
      left: 0;
      width: 100%;
      height: 100%;
      background: url('assets/img/1.webp') center center no-repeat;
      background-size: cover;
      z-index: 1;
    }

    /* Right Section (Login Form) */
    #login-right {
      position: absolute;
      right: 0;
      width: 100%;
      height: 90%;
      z-index: 2;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    /* Card Styling (Login Box) */
    .card {
      background: rgba(255, 255, 255, 0.2); /* Semi-transparent white background */
      color:rgb(255, 255, 255); /* Dodger blue for text */
      opacity: 1;
      width: 90%;
      max-width: 400px;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0px 14px 28px rgba(0, 0, 0, 0.25), 0px 10px 10px rgba(0, 0, 0, 0.22);
    }

    .logo {
      margin: auto;
      font-size: 4rem;
      padding: 1.5rem;
      border-radius: 50%;
      color: #1e90ff; /* Blue color for logo */
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .form-group input {
      font-size: 16px;
      padding: 12px;
      width: 100%;
      border: none;
      border-bottom: 2px solid #1e90ff; /* Blue border */
      outline: none;
      margin-bottom: 20px;
      background-color: rgba(189, 149, 149, 0.1); /* Transparent input background */
      color:rgb(17, 3, 3); /* Blue text color */
      transition: all 0.3s ease;
    }

    .form-group input:focus {
      border-bottom-color: #00bfff; /* Lighter blue on focus */
      background-color: rgb(248, 245, 245);
      box-shadow: 0 0 10px rgba(0, 123, 255, 0.2);
    }

    .form-group label {
      font-weight: bold;
      margin-bottom: 5px;
      color:rgb(206, 220, 241); /* Blue label text */
    }

    .btn-primary {
      width: 100%;
      padding: 14px;
      background-color: #1e90ff; /* Dodger blue button */
      border: none;
      color: white;
      font-size: 1rem;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease;
      border-radius: 8px;
    }

    .btn-primary:hover {
      background-color: #00bfff; /* Light blue on hover */
    }

    /* Footer Styling */
    .footer {
      text-align: center;
      font-size: 12px;
      color: #1e90ff; /* Blue text */
      margin-top: 20px;
    }

    .footer p {
      margin: 2px 0;
      line-height: 1.5;
    }
  </style>

</head>

<body>

  <main id="main" class="bg-dark">
    <div id="login-left">
      <!-- Background image -->
    </div>

    <div id="login-right">
      <div class="card">
        <div class="logo">
          <i class="fa fa-lock"></i> <!-- Lock Icon -->
        </div>

        <form id="login-form">
          <div class="form-group">
            <label for="username" class="control-label">Username</label>
            <input type="text" id="username" name="username" class="form-control" required>
          </div>

          <div class="form-group">
            <label for="password" class="control-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" required>
          </div>

          <center><button type="submit" class="btn-primary">Login</button></center>
        </form>

        <!-- Copyright Footer -->
        <div class="footer">
          <p>Copyright © 2024 All rights reserved <span style="color: #00bfff; font-weight: bold;">PayPro</span> Developers</p>
          <p>Developed by <span style="color: #00bfff; font-weight: bold;">PayPro</span></p>
        </div>
      </div>
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $('#login-form').submit(function(e) {
      e.preventDefault();
      $('#login-form button[type="submit"]').attr('disabled', true).html('Logging in...');
      if ($(this).find('.alert-danger').length > 0)
        $(this).find('.alert-danger').remove();

      $.ajax({
        url: 'ajax.php?action=login',
        method: 'POST',
        data: $(this).serialize(),
        error: err => {
          console.log(err);
          $('#login-form button[type="submit"]').removeAttr('disabled').html('Login');
        },
        success: function(resp) {
          if (resp == 1) {
            location.href = 'index.php?page=home';
          } else if (resp == 2) {
            location.href = 'voting.php';
          } else {
            $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>');
            $('#login-form button[type="submit"]').removeAttr('disabled').html('Login');
          }
        }
      });
    });
  </script>

</body>
</html>
