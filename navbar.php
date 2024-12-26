<style>
/* Sidebar Styles */
#sidebar {
    font-family: Arial, sans-serif;
    background-color: #2D2646; /* Match the top bar color */
    width: 250px; /* Fixed width */
    height: 100vh; /* Full viewport height */
    color: #ddd;
    position: fixed; /* Fixed sidebar on the left */
    top: 40px; /* Add a gap for the top bar */
    left: 0;
    overflow-y: auto; /* Enable scrolling within the sidebar */
    padding: 15px 0;
    transition: all 0.3s ease-in-out;
    z-index: 1000;
}

#sidebar .sidebar-list {
    padding: 0;
    margin: 0;
}

#sidebar .nav-item {
    display: flex;
    align-items: center;
    text-decoration: none;
    padding: 12px 20px;
    margin: 5px 0;
    color: #ddd;
    font-size: 16px;
    border-radius: 6px;
    transition: all 0.3s ease-in-out;
}

#sidebar .nav-item .icon-field {
    margin-right: 10px;
    font-size: 18px;
    width: 25px;
    text-align: center;
}

#sidebar .nav-item:hover {
    color: #2D2646;
    background-color: #ddd;
    font-weight: bold;
}

#sidebar .nav-item.active {
    color: white;
    background-color: #007bff;
    font-weight: bold;
}

#sidebar::-webkit-scrollbar {
    width: 8px;
}

#sidebar::-webkit-scrollbar-thumb {
    background-color: #555;
    border-radius: 5px;
}

#sidebar::-webkit-scrollbar-thumb:hover {
    background-color: #007bff;
}

/* Main Content Adjustment */
#main-content {
    margin-left: 250px; /* Match the sidebar width */
    margin-top: 10px; /* Add top spacing for the top bar */
    padding: 20px;
}

/* Top Bar Placeholder */
#top-bar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 56px;
    background-color: #2D2646; /* Match the sidebar color */
    z-index: 1050;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
</style>

<!-- Top Bar -->
<div id="top-bar">
    <!-- Content for the top bar goes here -->
</div>

<nav id="sidebar" class="mx-lt-5 bg-dark">
    <div class="sidebar-list">
        <a href="index.php?page=home" class="nav-item nav-home">
            <span class="icon-field"><i class="fa fa-home"></i></span> Home
        </a>
        <a href="index.php?page=attendance" class="nav-item nav-attendance">
            <span class="icon-field"><i class="fa fa-th-list"></i></span> Attendance
        </a>
        <?php if ($_SESSION['login_type'] == 1): ?>
        <a href="index.php?page=payroll" class="nav-item nav-payroll">
            <span class="icon-field"><i class="fa fa-columns"></i></span> Payroll List
        </a>
        <a href="index.php?page=employee" class="nav-item nav-employee">
            <span class="icon-field"><i class="fa fa-user-tie"></i></span> Employee List
        </a>
        <a href="index.php?page=department" class="nav-item nav-department">
            <span class="icon-field"><i class="fa fa-columns"></i></span> Department List
        </a>
        <a href="index.php?page=position" class="nav-item nav-position">
            <span class="icon-field"><i class="fa fa-user-tie"></i></span> Position List
        </a>
        <a href="index.php?page=allowances" class="nav-item nav-allowances">
            <span class="icon-field"><i class="fa fa-list"></i></span> Allowance List
        </a>
        <a href="index.php?page=deductions" class="nav-item nav-deductions">
            <span class="icon-field"><i class="fa fa-money-bill-wave"></i></span> Deduction List
        </a>
        <a href="index.php?page=users" class="nav-item nav-users">
            <span class="icon-field"><i class="fa fa-users"></i></span> Users
        </a>
        <?php endif; ?>
    </div>
</nav>

<div id="main-content">
    <!-- Main content goes here -->
</div>

<script>
    // Add 'active' class to the current navigation item
    $('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active');
</script>
