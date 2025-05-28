<?php 
$system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
$system_title = $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;
?>

<!DOCTYPE html>  
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="We ddevelop creative software, eye catching software. We also train to become a creative thinker">
<meta name="author" content="OPTIMUM LINKUP COMPUTERS">
<link rel="icon"  sizes="16x16" href="<?php echo base_url() ?>uploads/logo.png">
        <title><?php echo $system_title;?></title>
<!-- Bootstrap Core CSS -->
<link href="<?php echo base_url(); ?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>optimum/plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
<!-- animation CSS -->
<link href="<?php echo base_url(); ?>optimum/css/animate.css" rel="stylesheet">
<!-- Custom CSS -->
<!-- <link href="<?php echo base_url(); ?>optimum/css/style.css" rel="stylesheet"> --> <!-- Comment out old style -->
<!-- color CSS -->
<!-- <link href="<?php echo base_url(); ?>optimum/css/colors/megna.css" id="theme"  rel="stylesheet"> --> <!-- Comment out old theme -->
<link href="<?php echo base_url();?>optimum/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #6366F1, #A855F7, #EC4899);
            color: #fff;
        }

        .container {
            width: 90%;
            max-width: 1000px;
            padding: 2rem 1rem;
            display: flex; 
            flex-direction: column;
            align-items: center;
            flex-grow: 1;
            justify-content: center;
        }
        
        /* Initially hide login form, show role selection */
        #login-form { display: none; }
        #role-selection { display: flex; flex-direction: column; width:100%; align-items: center; } /* Ensure role selection is initially visible and centered */


        .header {
            text-align: center;
            margin-bottom: 3rem; /* Reduced margin */
        }

        .header h1 {
            font-size: 3rem; /* Slightly reduced */
            margin-bottom: 0.75rem; 
            font-weight: bold;
        }

        .header p {
            font-size: 1.5rem; /* Slightly reduced */
            opacity: 0.9;
        }

        .role-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2.5rem; /* Reduced gap */
            width: 100%;
            max-width: 1100px; /* Adjusted max-width */
            margin-bottom: 3rem; /* Added margin below cards */
        }

        /* Hide parent card completely */
        .role-card.parent-card {
            display: none;
        }

        /* Student card positioning - center it in the bottom row */
        .role-card.student-card {
            grid-column: 1 / -1; /* Span full width */
            max-width: 550px; /* Half the container width to maintain same size */
            justify-self: center; /* Center horizontally */
        }

        .role-card {
            background-color: white;
            border-radius: 1.25rem; /* Slightly reduced radius */
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .role-content {
            padding: 2rem; /* Reduced padding */
        }

        .role-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem; 
        }

        .role-icon {
            width: 4rem; /* Adjusted size */
            height: 4rem; /* Adjusted size */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1.5rem; 
            flex-shrink: 0; 
        }
         .role-icon i {
            font-size: 1.75rem; /* Adjusted icon size */
         }

        .school-icon { background-color: #dbeafe; }
        .school-icon i { color: #2563eb; }
        
        .teacher-icon { background-color: #f3e8ff; }
        .teacher-icon i { color: #9333ea; }
        
        .parent-icon { background-color: #ffedd5; }
        .parent-icon i { color: #f97316; }
        
        .student-icon { background-color: #dcfce7; }
        .student-icon i { color: #16a34a; }

        .role-title {
            font-size: 1.5rem; 
            font-weight: 600;
            color: #1f2937;
        }

        .role-description {
            color: #4b5563;
            margin-bottom: 2rem; /* Reduced margin */
            font-size: 1.5rem; /* Adjusted font size */
            line-height: 1.6; 
        }

        .btn {
            padding: 1rem 1.5rem; /* Adjusted padding */
            border-radius: 0.75rem; 
            text-align: center;
            font-weight: 600; 
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
            display: block;
            font-size: 1.3rem; 
            width: 100%; 
            box-sizing: border-box;
        }

        .btn-primary {
            background-color: #2563eb;
            color: white;
            border: none;
        }
        .btn-primary:hover {
            background-color: #1d4ed8;
        }

        .btn-primary.teacher {
            background-color: #9333ea;
        }
        .btn-primary.teacher:hover {
            background-color: #7e22ce;
        }

        .btn-primary.parent {
            background-color: #f97316;
        }
        .btn-primary.parent:hover {
            background-color: #ea580c;
        }

        .btn-primary.student {
            background-color: #16a34a;
        }
        .btn-primary.student:hover {
            background-color: #15803d;
        }

        .footer {
            margin-top: 3rem; /* Reduced margin */
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.3rem; /* Adjusted font size */
            text-align: center;
            width: 100%;
            padding-bottom: 1.5rem; 
            flex-shrink: 0; /* Prevent footer from shrinking */
        }

        /* Login Form Styles */
        .login-container {
            
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2.5rem; /* Reduced gap */
            width: 100%;
            max-width: 1100px; /* Adjusted max-width */
            margin-bottom: 5rem; /* Added margin below cards */
            
        }

        .login-box {
            background-color: white;
            border-radius: 1.5rem; /* << Further Increase Radius >> */
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 4rem; /* << Increased Padding >> */
            color: #333;
            width: 100%;
            
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 3rem; /* << Increased Margin >> */
            color: #1f2937;
            font-size: 3rem; /* << Increased Title Size >> */
            font-weight: 700;
        }

        .form-group {
            /* margin-bottom: 1.75rem; */
             /* << Increased Margin >> */
             margin : 1.75rem 8rem 1.75rem 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.875rem; /* << Increased Margin >> */
            color: #4b5563;
            font-size: 1.5rem; /* << Increased Label Size >> */
            font-weight: 500; 
            /* width: 80%; */ /* Removed width */
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 1.1rem; /* << Increased Icon Size >> */
        }

        .input-wrapper i.icon-left {
            left: 1.5rem; /* << Increased Padding >> */
        }

        .input-wrapper i.icon-right {
            right: -6rem; /* << Increased Padding >> */
            cursor: pointer;
        }

        .form-group input {
            width: 140%;
            padding: 1.2rem 4rem; /* << Increased Padding >> */
            border: 1px solid #d1d5db;
            border-radius: 0.75rem; /* << Increased Radius >> */
            font-size: 1.2rem; /* << Increased Input Font Size >> */
            box-sizing: border-box;
            outline: none;
            transition: border-color 0.2s;
        }
         .form-group input[type="password"] {
            padding-right: 4rem; /* << Adjust Padding >> */
        }

        .form-group input:focus {
            border-color: #6366F1; 
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2); 
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center; 
            margin-top: 3rem; /* << Increased Margin >> */
        }

        .btn-back {
            padding: 1rem 2rem; /* << Increased Padding >> */
            border-radius: 0.75rem; /* << Increased Radius >> */
            border: 1px solid #d1d5db;
            background-color: white;
            color: #4b5563;
            font-size: 1.5rem; /* << Increased Font Size >> */
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            transition: background-color 0.2s;
        }

        .btn-back i {
            margin-right: 0.75rem; /* << Increased Margin >> */
        }

        .btn-back:hover {
            background-color: #f3f4f6;
        }

        .btn-signin {
            padding: 1rem 2.5rem; /* << Increased Padding >> */
            border-radius: 0.75rem; /* << Increased Radius >> */
            border: none;
            background-color: #2563eb; 
            color: white;
            font-size: 1.5rem; /* << Increased Font Size >> */
            font-weight: 600; 
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-signin:hover {
            opacity: 0.9; 
        }
        
        /* Specific sign-in button colors */
        .btn-signin.school { background-color: #2563eb; }
        .btn-signin.teacher { background-color: #9333ea; }
        .btn-signin.parent { background-color: #f97316; }
        .btn-signin.student { background-color: #16a34a; }
        

        @media (max-width: 768px) {
            /* Mobile adjustments might need further tweaking */
            .container {
                justify-content: flex-start; /* Allow scrolling if needed on mobile */
                padding: 1rem; 
            }
             .role-container {
                gap: 1.5rem; 
            }
             .login-container {
                 padding: 1rem; 
            }
             .login-box {
                padding: 1.5rem; /* Adjust mobile padding */
            }
            /* Keep existing mobile button styles */
             .form-actions {
                 flex-direction: column-reverse; 
                 gap: 1rem;
                 align-items: stretch; 
            }
             .btn-back, .btn-signin {
                 width: 100%; 
                 justify-content: center;
                 font-size: 1rem; 
                 padding: 1rem; 
            }
        }
        
        /* Alert styles (basic) */
        .alert {
            padding: 1rem 1.5rem; /* Larger padding */
            margin-bottom: 2rem; /* More margin */
            border: 1px solid transparent;
            border-radius: 0.5rem; /* Larger radius */
            font-size: 1rem; /* Larger text */
        }
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

    </style>
</head>
<body>
    <!-- Role Selection Page -->
    <div class="container" id="role-selection">
        <div class="header">
             <!-- Dynamic System Name -->
            <h1><?php echo $system_name;?></h1>
            <p>Select your role to continue</p>
</div>

        <div class="role-container">
            <!-- School Card (Admin) -->
            <div class="role-card">
                <div class="role-content">
                    <div class="role-header">
                        <div class="role-icon school-icon">
                            <i class="fas fa-school fa-lg"></i> <!-- Changed icon -->
                        </div>
                        <h2 class="role-title">School</h2>
                    </div>
                    <p class="role-description">
                        Access the school administration portal to manage students, teachers, and school operations.
                    </p>
                    <button class="btn btn-primary school" onclick="showLogin('school')">School Login</button> <!-- Changed to button -->
                </div>
            </div>

            <!-- Teacher Card -->
            <div class="role-card">
                <div class="role-content">
                    <div class="role-header">
                        <div class="role-icon teacher-icon">
                            <i class="fas fa-chalkboard-teacher fa-lg"></i> <!-- Changed icon -->
                        </div>
                        <h2 class="role-title">Teacher</h2>
                    </div>
                    <p class="role-description">
                        Login to your teacher account to manage classes, assignments, attendance, and student records.
                    </p>
                    <button class="btn btn-primary teacher" onclick="showLogin('teacher')">Teacher Login</button> <!-- Changed to button -->
                </div>
            </div>

            <!-- Parent Card -->
            <div class="role-card parent-card">
                <div class="role-content">
                    <div class="role-header">
                        <div class="role-icon parent-icon">
                            <i class="fas fa-user-friends fa-lg"></i> <!-- Changed icon -->
                        </div>
                        <h2 class="role-title">Parent</h2>
                    </div>
                    <p class="role-description">
                        Login to view your child's academic progress, attendance, and communicate with teachers.
                    </p>
                     <button class="btn btn-primary parent" onclick="showLogin('parent')">Parent Login</button> <!-- Changed to button -->
                </div>
            </div>

            <!-- Student Card -->
            <div class="role-card student-card">
                <div class="role-content">
                    <div class="role-header">
                        <div class="role-icon student-icon">
                            <i class="fas fa-user-graduate fa-lg"></i> <!-- Changed icon -->
                        </div>
                        <h2 class="role-title">Student</h2>
                    </div>
                    <p class="role-description">
                        Login to access your courses, assignments, grades, and school resources.
                    </p>
                     <button class="btn btn-primary student" onclick="showLogin('student')">Student Login</button> <!-- Changed to button -->
                </div>
            </div>
        </div>
	
        <div class="footer">
            <!-- Dynamic Footer -->
            <?php echo $this->db->get_where('settings', array('type' => 'footer'))->row()->description; ?>
        </div>
    </div>

    <!-- Login Container -->
    <div class="container login-container" id="login-form">
        <?php echo form_open(base_url() . 'login/validate_login'); ?>
            <div class="login-box">
                <h2 id="login-title">Login</h2>

                <!-- Error Message Display -->
                <?php if (($this->session->flashdata('error_message')) != ''):?>
                <div class="alert alert-danger" style="margin-bottom: 1.5rem;">
                    <?php echo $this->session->flashdata('error_message');?>
                </div>
                <?php endif;?>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope icon-left"></i>
                        <input type="email" id="email" name="email" required placeholder="Enter your email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock icon-left"></i>
                        <input type="password" id="password" name="password" required placeholder="Enter your password">
                        <i class="fas fa-eye icon-right" id="toggle-password"></i>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn-back" onclick="showRoleSelection()"> <!-- type="button" to prevent form submit -->
                        <i class="fas fa-arrow-left"></i> Back
                    </button>
                    <button type="submit" class="btn-signin" id="sign-in-btn">Sign In</button> <!-- Submit button -->
                </div>
            </div>
        <?php echo form_close();?>
         <div class="footer">
             <!-- Dynamic Footer -->
            <?php echo $this->db->get_where('settings', array('type' => 'footer'))->row()->description; ?>
        </div>
    </div>

    <!-- Original JS includes (keep for now) -->
<script src="<?php echo base_url(); ?>optimum/plugins/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>optimum/bootstrap/dist/js/tether.min.js"></script>
<script src="<?php echo base_url(); ?>optimum/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>optimum/plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
<script src="<?php echo base_url(); ?>optimum/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<script src="<?php echo base_url(); ?>optimum/js/jquery.slimscroll.js"></script>
<script src="<?php echo base_url(); ?>optimum/js/waves.js"></script>
    <!-- <script src="<?php echo base_url(); ?>optimum/js/custom.min.js"></script> --> <!-- Comment out old custom JS -->
<script src="<?php echo base_url(); ?>optimum/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
<script src="<?php echo base_url(); ?>optimum/plugins/bower_components/toast-master/js/jquery.toast.js"></script>

    <!-- New UI JS -->
    <script>
        // Current role being viewed
        let currentRole = '';

        // Show login form for selected role
        function showLogin(role) {
            currentRole = role;
            
            // Hide role selection and show login form
            document.getElementById('role-selection').style.display = 'none';
            document.getElementById('login-form').style.display = 'flex'; // Use flex to center
            
            // Set the login title based on role
            const loginTitle = document.getElementById('login-title');
            const roleName = role.charAt(0).toUpperCase() + role.slice(1);
            loginTitle.textContent = `${roleName} Login`;
            
            // Set the sign-in button class based on role
            const signInBtn = document.getElementById('sign-in-btn');
            signInBtn.className = 'btn-signin ' + role; // Add role class for styling
        }

        // Show role selection page
        function showRoleSelection() {
            document.getElementById('role-selection').style.display = 'flex'; // Use flex
            document.getElementById('login-form').style.display = 'none';
        }

        // Toggle password visibility
        document.getElementById('toggle-password').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this;
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Removed the sign-in button JS click handler as form submit handles it now.
        
        // Toast notifications for errors (from original file)
<?php if (($this->session->flashdata('error_message')) !=''):?>
$(document).ready(function(){
          // Instead of toast, maybe just rely on the alert div added above?
          // Or uncomment toast if preferred and styled correctly.
          /*
  $.toast({
            heading: 'Login Error',
    text: '<?php echo $this->session->flashdata('error_message');?>',
    position: 'top-right',
    loaderBg: '#ff6849',
    icon:'warning',
    hideAfter: '3500',
    stack: 6
  });
          */
});
        <?php endif;?>

</script>
</body>
</html>
