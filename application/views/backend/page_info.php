<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <?php if($page_title !== get_phrase('admin_dashboard')): ?>
                            <h4 class="page-title"><?php echo $page_title;?></h4>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                        <ol class="breadcrumb">
                            <li><a href=""><?php echo $system_name;?></a></li>
                            <li class="active"><?php echo date('d M,Y');?></li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>