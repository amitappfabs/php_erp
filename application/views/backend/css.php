<!DOCTYPE html>
<html lang="en" dir="<?php if ($text_align == 'right-to-left') echo 'rtl';?>">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="A complete and most powerful school system management system for all. Purchase and enjoy">
    <meta name="author" content="OPTIMUM LINKUP COMPUTERS">
		<?php 
		//////////LOADING SYSTEM SETTINGS FOR ALL PAGES AND ACCOUNTS/////////
		$system_title	=	$this->db->get_where('settings' , array('type'=>'system_title'))->row()->description;
		?>

    <link rel="icon"  sizes="16x16" href="<?php echo base_url() ?>uploads/logo.png">
    <title><?php echo $page_title;?>&nbsp;|&nbsp;<?php echo $system_title;?></title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>optimum/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" >

    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet" >
    <!-- Menu CSS -->
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet" >
    <!-- morris CSS -->
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/morrisjs/morris.css" rel="stylesheet" >
    <!-- animation CSS -->
    <link href="<?php echo base_url(); ?>optimum/css/animate.css" rel="stylesheet" >
    <!-- Custom CSS -->
<?php if ($text_align == 'right-to-left') { ?>
  <link href="<?php echo base_url(); ?>optimum/css/style-rtl.css" rel="stylesheet" >
<?php } else { ?>
  <link href="<?php echo base_url(); ?>optimum/css/style.css" rel="stylesheet" >
<?php } ?>

    
    <!-- color CSS -->
	 <link rel="stylesheet" href="<?php echo base_url(); ?>optimum/plugins/bower_components/dropify/dist/css/dropify.min.css" >
	<link href="<?php echo base_url(); ?>optimum/plugins/bower_components/dropzone-master/dist/dropzone.css" rel="stylesheet" type="text/css" / >
	

    <link href="<?php echo base_url(); ?>optimum/css/colors/<?php echo $this->db->get_where('settings', array('type' => 'skin_colour'))->row()->description; ?>.css" id="theme" rel="stylesheet" >
	<link href="<?php echo base_url(); ?>optimum/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="<?php echo base_url(); ?>optimum/plugins/bower_components/html5-editor/bootstrap-wysihtml5.css" / >
	
	 <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" / >
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/custom-select/custom-select.css" rel="stylesheet" type="text/css" / >
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" / >
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
	
	<link href="<?php echo base_url(); ?>optimum/plugins/bower_components/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>optimum/plugins/bower_components/icheck/skins/all.css" rel="stylesheet">
		
		
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>optimum/plugins/bower_components/gallery/css/animated-masonry-gallery.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>optimum/plugins/bower_components/fancybox/ekko-lightbox.min.css" />

    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>optimum/plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/calendar/dist/fullcalendar.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
	
	
	 <!--Owl carousel CSS -->
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/owl.carousel/owl.carousel.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/owl.carousel/owl.theme.default.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>js/font-awesome-icon-picker/fontawesome-four-iconpicker.min.css" type="text/css" />
	
	
									

	
	
	<script src="<?php echo base_url(); ?>optimum/js/jquery-1.11.0.min.js"></script>


	<!--<link href="<?php echo base_url(); ?>optimum/fullcalendar/css/style.css" rel="stylesheet">-->

<!--Amcharts-->
<script src="<?php echo base_url(); ?>optimum/js/amcharts/amcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>optimum/js/amcharts/pie.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>optimum/js/amcharts/serial.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>optimum/js/amcharts/gauge.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>optimum/js/amcharts/funnel.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>optimum/js/amcharts/radar.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>optimum/js/amcharts/exporting/amexport.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>optimum/js/amcharts/exporting/rgbcolor.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>optimum/js/amcharts/exporting/canvg.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>optimum/js/amcharts/exporting/jspdf.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>optimum/js/amcharts/exporting/filesaver.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>optimum/js/amcharts/exporting/jspdf.plugin.addimage.js" type="text/javascript"></script>
    <!-- Resources -->
<script src="<?php echo base_url(); ?>optimum/amcharts/core.js"></script>
<script src="<?php echo base_url(); ?>optimum/amcharts/charts.js"></script>
<script src="<?php echo base_url(); ?>optimum/amcharts/animated.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Custom Profile Image Styling -->
<style>
.profile-img-enhanced {
    border: 3px solid #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
}

.profile-img-enhanced:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(0,0,0,0.25);
}

.sidebar .user-pro img {
    width: 60px !important;
    height: 60px !important;
    border: 3px solid #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    margin-bottom: 10px;
}

.sidebar .user-pro .hide-menu {
    font-size: 14px;
    font-weight: 600;
    color: #333;
}

.navbar-top-links .dropdown-toggle {
    padding: 10px 15px;
}

.profile-pic b {
    margin-left: 10px;
    font-size: 14px;
    font-weight: 600;
}

/* Enhanced Navigation Styling */
.enhanced-nav-item {
    margin-bottom: 4.5px; /* Reduced from 5px */
    border-radius: 7.2px; /* Reduced from 8px */
    transition: all 0.3s ease;
    background: #ffffff;
    border: 1px solid #e0e0e0;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}

.enhanced-nav-item:hover {
    background: linear-gradient(135deg, #e9d5ff 0%, #faf5ff 100%);
    transform: translateX(4.5px); /* Reduced from 5px */
    box-shadow: 0 3.6px 13.5px rgba(233, 213, 255, 0.4); /* Reduced from 4px 15px */
    border-color: transparent;
}

/* Fix persistent greyish color - ensure items return to white when not hovered */
.enhanced-nav-item:not(:hover):not(.active) {
    background: #ffffff !important;
    border: 1px solid #e0e0e0 !important;
}

.enhanced-nav-link {
    padding: 10.8px 18px !important; /* Reduced from 12px 20px */
    border-radius: 7.2px; /* Reduced from 8px */
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.enhanced-nav-link:before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.enhanced-nav-link:hover:before {
    left: 100%;
}

.enhanced-text {
    font-size: 14.4px !important; /* Reduced from 16px (10% reduction) */
    font-weight: 600;
    color: #2c3e50;
    transition: all 0.3s ease;
}

.enhanced-nav-item:hover .enhanced-text {
    color: #7c3aed;
    text-shadow: 0 1px 3px rgba(124, 58, 237, 0.3);
}

/* Fix text color when not hovered */
.enhanced-nav-item:not(:hover) .enhanced-text {
    color: #2c3e50 !important;
    text-shadow: none !important;
}

.enhanced-icon {
    font-size: 16.2px !important; /* Reduced from 18px (10% reduction) */
    color: #6c757d;
    transition: all 0.3s ease;
    margin-right: 10.8px; /* Reduced from 12px */
}

.enhanced-nav-item:hover .enhanced-icon {
    color: #7c3aed;
    transform: scale(1.1);
}

/* Fix icon color when not hovered */
.enhanced-nav-item:not(:hover) .enhanced-icon {
    color: #6c757d !important;
    transform: scale(1) !important;
}

/* Remove special vibrant styling - all items now use white background */
.enhanced-nav-item:nth-child(2),
.enhanced-nav-item:nth-child(5) {
    background: #ffffff;
    border: 1px solid #e0e0e0;
    color: inherit;
}

.enhanced-nav-item:nth-child(2) .enhanced-text,
.enhanced-nav-item:nth-child(2) .enhanced-icon,
.enhanced-nav-item:nth-child(5) .enhanced-text,
.enhanced-nav-item:nth-child(5) .enhanced-icon {
    color: #2c3e50 !important;
}

.enhanced-nav-item:nth-child(2):hover,
.enhanced-nav-item:nth-child(5):hover {
    background: linear-gradient(135deg, #e9d5ff 0%, #faf5ff 100%);
    transform: translateX(7.2px) scale(1.02); /* Reduced from 8px */
    border-color: transparent;
}

.enhanced-nav-item:nth-child(2):hover .enhanced-text,
.enhanced-nav-item:nth-child(2):hover .enhanced-icon,
.enhanced-nav-item:nth-child(5):hover .enhanced-text,
.enhanced-nav-item:nth-child(5):hover .enhanced-icon {
    color: #7c3aed !important;
}

/* Special styling for Manage Profile - white with grey border */
.enhanced-profile-item {
    background: #ffffff;
    border: 1px solid #d0d0d0;
    box-shadow: 0 1px 3px rgba(0,0,0,0.08);
}

.enhanced-profile-item:hover {
    background: linear-gradient(135deg, #e9d5ff 0%, #faf5ff 100%);
    border-color: transparent;
    transform: translateX(7.2px) scale(1.02); /* Reduced from 8px */
}

.enhanced-profile-item .enhanced-text,
.enhanced-profile-item .enhanced-icon {
    color: #495057 !important;
    font-weight: 600;
}

.enhanced-profile-item:hover .enhanced-text,
.enhanced-profile-item:hover .enhanced-icon {
    color: #7c3aed !important;
    font-weight: 700;
}

/* Special styling for Logout - white with grey border */
.enhanced-logout-item {
    background: #ffffff;
    border: 1px solid #d0d0d0;
    box-shadow: 0 1px 3px rgba(0,0,0,0.08);
}

.enhanced-logout-item:hover {
    background: linear-gradient(135deg, #e9d5ff 0%, #faf5ff 100%);
    transform: translateX(7.2px); /* Reduced from 8px */
    border-color: transparent;
}

.enhanced-logout-item .enhanced-text,
.enhanced-logout-item .enhanced-icon {
    color: #6c757d !important;
    font-weight: 600;
}

.enhanced-logout-item:hover .enhanced-text,
.enhanced-logout-item:hover .enhanced-icon {
    color: #7c3aed !important;
}

/* Sub-menu styling */
.enhanced-sub-item {
    margin: 2.7px 0; /* Reduced from 3px */
    border-radius: 5.4px; /* Reduced from 6px */
    transition: all 0.3s ease;
    background: #f8f9fa;
    border: 1px solid #e9ecef;
}

.enhanced-sub-item:hover {
    background: linear-gradient(135deg, #e9d5ff 0%, #faf5ff 100%);
    transform: translateX(9px); /* Reduced from 10px */
    border-color: transparent;
}

.enhanced-sub-link {
    padding: 9px 13.5px !important; /* Reduced from 10px 15px */
    border-radius: 5.4px; /* Reduced from 6px */
    transition: all 0.3s ease;
}

.enhanced-sub-text {
    font-size: 12.6px !important; /* Reduced from 14px (10% reduction) */
    font-weight: 500;
    color: #495057;
    transition: all 0.3s ease;
}

.enhanced-sub-item:hover .enhanced-sub-text {
    color: #7c3aed;
    font-weight: 600;
}

/* Active state styling */
.enhanced-nav-item.active {
    background: linear-gradient(135deg, #e9d5ff 0%, #faf5ff 100%);
    box-shadow: 0 3.6px 13.5px rgba(233, 213, 255, 0.4); /* Reduced from 4px 15px */
    border-color: transparent;
}

.enhanced-nav-item.active .enhanced-text,
.enhanced-nav-item.active .enhanced-icon {
    color: #7c3aed !important;
}

/* Sidebar overall improvements */
.sidebar {
    background: linear-gradient(180deg, #f8f9fa 0%, #e9ecef 100%);
    box-shadow: 2px 0 9px rgba(0,0,0,0.1); /* Reduced from 10px */
    width: 252px !important; /* Reduced from 280px (10% reduction) */
    /* Hide scrollbar but keep functionality */
    overflow-y: auto;
    scrollbar-width: none; /* Firefox */
    -ms-overflow-style: none; /* Internet Explorer 10+ */
}

/* Hide scrollbar for Chrome, Safari and Opera */
.sidebar::-webkit-scrollbar {
    display: none;
}

.sidebar-nav {
    padding: 18px 13.5px; /* Reduced from 20px 15px */
}

/* Animation for menu items */
@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-27px); /* Reduced from -30px */
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.enhanced-nav-item {
    animation: slideInLeft 0.5s ease-out;
}

.enhanced-nav-item:nth-child(1) { animation-delay: 0.1s; }
.enhanced-nav-item:nth-child(2) { animation-delay: 0.2s; }
.enhanced-nav-item:nth-child(3) { animation-delay: 0.3s; }
.enhanced-nav-item:nth-child(4) { animation-delay: 0.4s; }
.enhanced-nav-item:nth-child(5) { animation-delay: 0.5s; }
.enhanced-nav-item:nth-child(6) { animation-delay: 0.6s; }
.enhanced-nav-item:nth-child(7) { animation-delay: 0.7s; }
.enhanced-nav-item:nth-child(8) { animation-delay: 0.8s; }

/* Responsive adjustments */
@media (max-width: 768px) {
    .enhanced-text {
        font-size: 12.6px !important; /* Reduced from 14px */
    }
    
    .enhanced-icon {
        font-size: 14.4px !important; /* Reduced from 16px */
    }
    
    .enhanced-sub-text {
        font-size: 10.8px !important; /* Reduced from 12px */
    }
}

/* Fix diary modal form alignment */
.modal-dialog .form-horizontal .form-group {
    margin-left: 0;
    margin-right: 0;
}

.modal-dialog .form-horizontal .control-label {
    text-align: left !important;
    padding-top: 6.3px; /* Reduced from 7px */
    margin-bottom: 0;
    font-weight: 600;
    color: #333;
    padding-left: 13.5px !important; /* Reduced from 15px */
}

.modal-dialog .form-horizontal .form-control {
    width: 100%;
    box-sizing: border-box;
}

.modal-dialog .form-group .col-sm-3,
.modal-dialog .form-group .col-sm-9 {
    padding-left: 13.5px; /* Reduced from 15px */
    padding-right: 13.5px; /* Reduced from 15px */
}

.modal-dialog .help-block {
    margin-top: 4.5px; /* Reduced from 5px */
    margin-bottom: 0;
    color: #737373;
    font-size: 10.8px; /* Reduced from 12px */
    margin-left: 0 !important;
}

.modal-dialog .modal-body {
    padding: 18px; /* Reduced from 20px */
}

.modal-dialog .form-group {
    margin-bottom: 18px; /* Reduced from 20px */
}

/* Hide "Diary Entry Not Found" error messages in modal */
.modal .alert-danger {
    display: none !important;
}

/* Force left alignment for all form labels in modals */
.modal .form-horizontal .control-label {
    text-align: left !important;
    padding-left: 13.5px !important; /* Reduced from 15px */
    margin-left: 0 !important;
}

/* Override Bootstrap's form-horizontal right alignment */
@media (min-width: 768px) {
    .modal-dialog .form-horizontal .control-label {
        text-align: left !important;
        padding-left: 13.5px !important; /* Reduced from 15px */
    }
}

/* Ensure proper spacing in modal forms */
@media (max-width: 767px) {
    .modal-dialog .form-horizontal .control-label {
        text-align: left !important;
        margin-bottom: 4.5px; /* Reduced from 5px */
        padding-left: 13.5px !important; /* Reduced from 15px */
    }
    
    .modal-dialog .form-group .col-sm-3,
    .modal-dialog .form-group .col-sm-9 {
        width: 100%;
        float: none;
        padding-left: 13.5px; /* Reduced from 15px */
        padding-right: 13.5px; /* Reduced from 15px */
    }
}

/* Additional fixes for form alignment */
.modal .form-group .col-sm-3 {
    padding-left: 13.5px !important; /* Reduced from 15px */
    margin-left: 0 !important;
}

.modal .form-group .col-sm-9 {
    padding-left: 13.5px !important; /* Reduced from 15px */
    margin-left: 0 !important;
}

/* Fix any potential inline style overrides */
.modal .control-label[style*="text-align"] {
    text-align: left !important;
}

/* Perfect circular profile image styling */
.profile-pic img,
.navbar-top-links img,
.dropdown img {
    border-radius: 50% !important;
    object-fit: cover;
    border: 1.8px solid #fff; /* Reduced from 2px */
    box-shadow: 0 1.8px 7.2px rgba(0,0,0,0.15); /* Reduced from 2px 8px */
}

/* Default profile image when no image exists */
.profile-pic img[src*="default.jpg"],
.navbar-top-links img[src*="default.jpg"],
.dropdown img[src*="default.jpg"] {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: 2.7px solid #fff; /* Reduced from 3px */
    box-shadow: 0 3.6px 10.8px rgba(0,0,0,0.2); /* Reduced from 4px 12px */
    padding: 1.8px; /* Reduced from 2px */
}

/* Ensure circular shape for all profile images */
.img-circle {
    border-radius: 50% !important;
    width: 45px !important; /* Reduced from 50px */
    height: 45px !important; /* Reduced from 50px */
    object-fit: cover !important;
    border: 1.8px solid #fff !important; /* Reduced from 2px */
    box-shadow: 0 1.8px 7.2px rgba(0,0,0,0.15) !important; /* Reduced from 2px 8px */
}

/* Enhanced styling for header profile */
.navbar-top-links .profile-pic {
    display: flex;
    align-items: center;
    padding: 4.5px 9px; /* Reduced from 5px 10px */
    border-radius: 22.5px; /* Reduced from 25px */
    transition: all 0.3s ease;
}

.navbar-top-links .profile-pic:hover {
    background: rgba(255,255,255,0.1);
    transform: scale(1.02);
}

/* Admin navigation specific enhancements */
.sidebar .enhanced-nav-item {
    margin-bottom: 7.2px; /* Reduced from 8px */
    border-radius: 9px; /* Reduced from 10px */
    transition: all 0.3s ease;
    background: #ffffff;
    border: 1px solid #e0e0e0;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}

/* Ensure admin gets same hover effects as teacher */
.sidebar .enhanced-nav-item:hover {
    background: linear-gradient(135deg, #e9d5ff 0%, #faf5ff 100%);
    transform: translateX(4.5px); /* Reduced from 5px */
    box-shadow: 0 3.6px 13.5px rgba(233, 213, 255, 0.4); /* Reduced from 4px 15px */
    border-color: transparent;
}

/* Admin text and icon styling */
.sidebar .enhanced-text {
    font-size: 15.3px !important; /* Reduced from 17px (10% reduction) */
    font-weight: 600;
    color: #2c3e50;
    transition: all 0.3s ease;
}

.sidebar .enhanced-icon {
    font-size: 17.1px !important; /* Reduced from 19px (10% reduction) */
    color: #6c757d;
    transition: all 0.3s ease;
    margin-right: 13.5px; /* Reduced from 15px */
}

.sidebar .enhanced-nav-item:hover .enhanced-text,
.sidebar .enhanced-nav-item:hover .enhanced-icon {
    color: #7c3aed !important;
}

/* Admin sub-menu styling */
.sidebar .enhanced-sub-item {
    margin: 3.6px 0; /* Reduced from 4px */
    border-radius: 7.2px; /* Reduced from 8px */
    transition: all 0.3s ease;
    background: #f8f9fa;
    border: 1px solid #e9ecef;
}

.sidebar .enhanced-sub-item:hover {
    background: linear-gradient(135deg, #e9d5ff 0%, #faf5ff 100%);
    transform: translateX(9px); /* Reduced from 10px */
    border-color: transparent;
}

.sidebar .enhanced-sub-text {
    font-size: 13.5px !important; /* Reduced from 15px (10% reduction) */
    font-weight: 500;
    color: #495057;
    transition: all 0.3s ease;
}

.sidebar .enhanced-sub-item:hover .enhanced-sub-text {
    color: #7c3aed;
    font-weight: 600;
}

/* Adjust main content area to accommodate wider sidebar */
.navbar-default .navbar-static-side {
    width: 252px !important; /* Reduced from 280px */
}

/* Adjust page wrapper for wider sidebar */
#page-wrapper {
    margin-left: 252px !important; /* Reduced from 280px */
    padding: 18px 13.5px; /* Reduced from 20px 15px */
}

/* Responsive adjustments for smaller screens */
@media (max-width: 1200px) {
    #page-wrapper {
        padding: 13.5px 9px; /* Reduced from 15px 10px */
    }
}

@media (max-width: 992px) {
    #page-wrapper {
        padding: 9px 7.2px; /* Reduced from 10px 8px */
    }
}

@media (max-width: 768px) {
    .sidebar {
        width: 225px !important; /* Reduced from 250px */
    }
    
    .navbar-default .navbar-static-side {
        width: 225px !important; /* Reduced from 250px */
    }
    
    #page-wrapper {
        margin-left: 0 !important;
        padding: 9px 4.5px; /* Reduced from 10px 5px */
    }
}

/* Ensure proper content scaling */
.container-fluid {
    padding-left: 9px !important; /* Reduced from 10px */
    padding-right: 9px !important; /* Reduced from 10px */
}

.row {
    margin-left: -9px !important; /* Reduced from -10px */
    margin-right: -9px !important; /* Reduced from -10px */
}

.col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6,
.col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
    padding-left: 9px !important; /* Reduced from 10px */
    padding-right: 9px !important; /* Reduced from 10px */
}

/* Table responsiveness improvements */
.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

.table {
    font-size: 12.6px; /* Reduced from 14px (10% reduction) */
}

/* Panel and card adjustments */
.panel {
    margin-bottom: 13.5px; /* Reduced from 15px */
}

.white-box {
    padding: 13.5px; /* Reduced from 15px */
    margin-bottom: 13.5px; /* Reduced from 15px */
}

/* Form adjustments */
.form-group {
    margin-bottom: 13.5px; /* Reduced from 15px */
}

/* Button adjustments */
.btn {
    padding: 7.2px 14.4px; /* Reduced from 8px 16px */
    font-size: 12.6px; /* Reduced from 14px */
}

.btn-lg {
    padding: 10.8px 18px; /* Reduced from 12px 20px */
    font-size: 14.4px; /* Reduced from 16px */
}
</style>
</head>
<body>

        
