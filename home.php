<?php include 'db_connect.php' ?>

<style>
   /* Global Styling */
   body {
       font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
       background-color:rgb(210, 212, 212);
   }
   .container-fluid {
       margin-top: 30px;
   }

   /* Row Styling */
   .row {
       margin: 0;
   }

   /* Card Styling */
   .card {
       border-radius: 10px;
       background: rgba(41, 34, 34, 0.9); /* Slightly transparent white */
       box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
       transition: all 0.3s ease;
   }

   /* Card Hover Effect */
   .card:hover {
       transform: translateY(-5px);
       box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
   }

   /* Card Body Styling */
   .card-body {
       padding: 40px;
       text-align: center;
       font-size: 1.2rem;
       line-height: 1.6;
   }

   /* Welcome Message */
   .card-body h1 {
       font-size: 2rem;
       margin-bottom: 20px;
       color: white;
   }

   /* Section Heading */
   .card-body .section-heading {
       font-size: 1.3rem;
       font-weight: bold;
       color: white;
       margin-bottom: 10px;
   }

   /* Button Styling */
   .btn-modern {
       display: inline-block;
       padding: 12px 24px;
       background-color: #3498db;
       color: white;
       font-weight: bold;
       border-radius: 5px;
       text-transform: uppercase;
       border: none;
       cursor: pointer;
       font-size: 1rem;
       transition: background-color 0.3s ease;
   }

   .btn-modern:hover {
       background-color: #2980b9;
   }

   /* Responsive Design */
   @media (max-width: 767px) {
       .card-body {
           padding: 20px;
       }
       .card-body h1 {
           font-size: 1.8rem;
       }
   }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <!-- Add any additional sections here if necessary -->
        </div>
    </div>

    <div class="row mt-3 ml-3 mr-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h1>Welcome back, <?php echo $_SESSION['login_name']; ?>!</h1>
                    <p class="section-heading">We're glad to see you again. Enjoy managing your tasks.</p>
                    <!-- No dashboard button here as requested -->
                </div>
            </div>
        </div>
    </div>

</div>
<script>
   // Additional custom JavaScript can be added here if needed
</script>
