<!-- Sidebar -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="dashboard.php">Student Management System</a>
    </div>
    <!-- /.navbar-header -->

    <!-- Logout Button in the Top Right Corner -->
    <ul class="nav navbar-nav navbar-right" style="margin-right: 10px;">
        <li><a href="https://time.is/">
                <p id="currentTime"></p>
            </a></li>
        <li><a href="logout.php"><i class="fa fa-sign-out"></i>Logout</a></li>
    </ul>

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>

                <!-- Student Section -->
                <li>
                    <a href="#"><i class="fa fa-user fa-fw"></i> Students<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="add_student.php">Add Student</a>
                        </li>
                        <li>
                            <a href="view_students.php">View Students</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>

                <!-- Courses Section -->
                <li>
                    <a href="#"><i class="fa fa-certificate fa-fw"></i> Courses<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="add_courses.php">Add Course</a>
                        </li>
                        <li>
                            <a href="manage_courses.php">Manage Course</a>
                        </li>
                        <li>
                            <a href="view_courses.php">View Courses</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>

                <!-- Subjects Section -->
                <li>
                    <a href="#"><i class="fa fa-book fa-fw"></i> Subjects<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="add_subjects.php">Add Subjects</a>
                        </li>
                        <li>
                            <a href="view_subjects.php">View Subjects</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>

            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
<!-- /#sidebar-wrapper -->