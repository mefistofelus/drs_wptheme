<!DOCTYPE html>
<html lang="ua">

<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <?php wp_site_icon(); ?>
    <title>
        <?php bloginfo( 'name'); ?>
    </title>
    <?php wp_head(); ?>
	

	
	</head>

<body class="grey lighten-3">

	<!--Main Navigation-->
	<header>

		<!-- Navbar Top-->
		<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light scrolling-navbar shadow-4">
			<div class="container-fluid">

				<!-- Brand -->
				<a class="navbar-brand waves-effect" href="<?php get_home_url(); ?>">
					<strong class="text-primary"><?php bloginfo( 'name'); ?>
						<i class="fa fa-external-link"></i>
					</strong>
				</a>

				<!-- Collapse -->
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<!-- Links -->
				<div class="collapse navbar-collapse" id="navbarNav">

					<!-- Left -->
					<ul class="navbar-nav">
						<li class="nav-item">
							<a href="http://www.drs.gov.ua/" class="nav-link" data-toggle="tooltip" data-placement="bottom" title="Сайт ДРС"><i class="fa fa-address-card"></i>
								<!-- Сайт ДРС -->
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tooltip" data-placement="bottom" title="Пошта ДРС" href="https://mail.drs.gov.ua/owa/#path=/mail" rel="external"><i class="fa fa-file"></i>
								<!-- Пошта ДРС -->
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tooltip" data-placement="bottom" title="Телефонний довідник" href="<?php echo get_template_directory_uri() . ('/content/tel-drs.html') ?>" target="_blank"><i class="fa fa-phone"></i>
								<!-- Телефони ДРС -->
							</a>
						</li>
						<!-- <li class="nav-item">
							<a class="nav-link" data-toggle="tooltip" data-placement="bottom" title="4" href="#" OnClick="window.open('#')" rel="external"><i class="fa fa-keyboard-o"></i>

							</a>
						</li> -->
					</ul>

					<!-- Right -->
					<ul class="navbar-nav nav-flex-icons ml-auto">
						<!-- Button trigger modal -->
						<button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-life-ring mr-2"></i>Допомога!</button>
					</ul>

				</div>

			</div>
		</nav>
		<!-- Navbar Top-->

		<!-- Sidebar -->
		<div class="sidebar-fixed position-fixed">

			<div class="sidebar-img text-center my-5">
				<?php the_custom_logo(); ?>
			</div>

			<!-- MAIN MENU -->
            <?php wp_nav_menu( [
                'theme_location'  => 'menu-1',
                'menu'            => '', 
                'container'       => 'ul', 
                'container_class' => '', 
                'container_id'    => '',
                'menu_class'      => 'main-menu list-group list-group-flush', 
                'menu_id'         => '',
                'echo'            => true,
                'fallback_cb'     => 'wp_page_menu',
                'before'          => '',
                'after'           => '',
                'link_before'     => '',
                'link_after'      => '',
                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth'           => 0,
                'walker'          => '',
            ]
            ) ?>

            <a class="btn btn-warning btn-lg menu-btn" href="<?php echo get_template_directory_uri() . ('/content/tel-drs.html') ?>" target="_blank">ДОВІДНИК ТЕЛЕФОНІВ</button></a>
            <br>
                        <div class="custom">
                            <?php
                            if ( function_exists('dynamic_sidebar') )
                                dynamic_sidebar('page-vijet');
                            ?>
                        </div>
            <!-- <a href="#" class="btn btn-info btn-md menu-btn" data-toggle="modal" data-target="#exampleModal">ВИКЛИК СПЕЦІАЛІСТА</a> -->
            <!-- MAIN MENU -->

		</div>
		<!-- Sidebar -->
	</header>
