<style>
.navbar {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    background-color: #2D2646; /* Deep purple background */
    padding: 0.5rem 1rem; /* Increased padding for a taller navbar */
    z-index: 9999; /* To ensure it stays on top */
    position: absolute; /* Required for absolute positioning of the logout button */
    height: 3.5rem; /* Fixed height for the navbar */
}

.navbar .container-fluid {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.navbar .text-white {
    color: white;
}

.navbar .col-md-4 {
    font-size: 1.2rem; /* Adjusted font size for better readability */
    font-weight: bold;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

.navbar .logout-btn {
    position: absolute;
    right: 30px; /* Adjust this value to change how far from the right edge the button is */
    top: 50%;
    transform: translateY(-50%); /* Vertically center the button */
    text-decoration: none;
    color: white;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    transition: color 0.3s ease-in-out;
}

.navbar .logout-btn:hover {
    color: #f39c12; /* Orange color for hover effect */
}

.navbar i {
    margin-left: 5px;
    font-size: 1.1rem;
    transition: transform 0.3s ease;
}

.navbar i:hover {
    transform: rotate(360deg); /* Rotate icon on hover for a subtle effect */
}
</style>

<nav class="navbar fixed-top" style="min-height:3rem;"> <!-- Adjusted navbar height -->
  <div class="container-fluid mt-2 mb-2">
    <div class="col-lg-12">
      <div class="col-md-4 text-white">
        <large><b>Pay-Trackr</b></large>
      </div>
    </div>
  </div>
  <a href="ajax.php?action=logout" class="logout-btn"><?php echo $_SESSION['login_name'] ?> <i class="fa fa-power-off"></i></a> <!-- Logout button -->
</nav>
