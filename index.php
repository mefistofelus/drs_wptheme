<?php get_header(); ?>
<!--Main layout-->
<main class="pt-5 mt-4 mx-lg-5">
	<div class="container-fluid mt-3">
		<div class="row">
			<div class="col-md-9">
				<div id="features-list">
					<!--Grid row-->
					<div class="row mb-4 wow fadeIn">
						
						<!--Grid column-->
						<div class="col-md-3 col-12 mb-2">
							<!-- Card -->
							<a href="http://www.drs.gov.ua/" target="_blank">
								<div class="card card-cascade hover-shadow mb-3">
									
									<!-- Card image -->
									<div class="view view-cascade gradient-card-header purple-gradient">
										
										<!-- Title -->
										<h2 class="card-header-title mb-3">Офіційний сайт <br> ДРС</h2>
										<!-- Subtitle -->
										<p class="card-header-subtitle mb-0"></p>
										
									</div>
									
									<!-- Card content -->
									<div class="card-body card-body-cascade text-center">
										
										<hr>
										
										<!-- Button -->
										<button type="button" class="btn btn-outline-info ripple">ПЕРЕЙТИ <i class="fa fa-angle-double-right"></i></button>
										
									</div>
									
								</div>
							</a>
						</div>
						<!--Grid column-->
						
						<!--Grid column-->
						<div class="col-md-3 col-12 mb-2">
							
							
							<!-- Card -->
							<a href="<?php echo get_template_directory_uri() . ('/content/tel-drs.html') ?>" target="_blank">
								<div class="card card-cascade hover-shadow mb-3">
									
									<!-- Card image -->
									<div class="view view-cascade gradient-card-header blue-gradient">
										
										<!-- Title -->
										<h2 class="card-header-title mb-3">Телефонний довідник <br> організації</h2>
										<!-- Subtitle -->
										<p class="card-header-subtitle mb-0"></p>
										
									</div>
									
									<!-- Card content -->
									<div class="card-body card-body-cascade text-center">
										
										<hr>
										
										<!-- Button -->
										<button type="button" class="btn btn-outline-info waves-effect">ПЕРЕЙТИ <i class="fa fa-angle-double-right"></i></button>
										
									</div>
									
								</div>
							</a>
						</div>
						<!--Grid column-->
						
						<!--Grid column-->
						<div class="col-md-3 col-12 mb-2">
							
							
							<!-- Card -->
							<a href="https://mail.drs.gov.ua/owa/#path=/mail" target="_blank">
								<div class="card card-cascade hover-shadow mb-3">
									
									<!-- Card image -->
									<div class="view view-cascade gradient-card-header lime-gradient">
										
										<!-- Title -->
										<h2 class="card-header-title mb-3"> Електронна пошта <br> ДРС </h2>
										<!-- Subtitle -->
										<p class="card-header-subtitle mb-0"></p>
										
									</div>
									
									<!-- Card content -->
									<div class="card-body card-body-cascade text-center">
										
										<hr>
										
										<!-- Button -->
										<button type="button" class="btn btn-outline-info waves-effect">ПЕРЕЙТИ <i class="fa fa-angle-double-right"></i></button>
										
									</div>
									
								</div>
							</a>
						</div>
						<!--Grid column-->
						
						<!--Grid column-->
						<div class="col-md-3 col-12 mb-2">
							
							
							<!-- Card -->
							<a href="http://site/category/departament/" target="_blank">
								<div class="card card-cascade hover-shadow mb-3">
									
									<!-- Card image -->
									<div class="view view-cascade gradient-card-header peach-gradient">
										
										<!-- Title -->
										<h2 class="card-header-title mb-3">Відділ управління <br> персоналом </h2>
										<!-- Subtitle -->
										<p class="card-header-subtitle mb-0"></p>
										
									</div>
									
									<!-- Card content -->
									<div class="card-body card-body-cascade text-center">
										
										<hr>
										
										<!-- Button -->
										<button type="button" class="btn btn-outline-info waves-effect">ПЕРЕЙТИ <i class="fa fa-angle-double-right"></i></button>
									</div>
									
								</div>
							</a>
						</div>
						<!--Grid column-->
						
						<!--Grid row-->
						<div class="col-12 mb-5">
							<?php get_template_part('template-parts/content-chat'); ?>
						</div>
						<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script> -->
					</div>
					
				</div>
			</div>
			<div class="col-md-3">
				<?php
				if ( function_exists('dynamic_sidebar') )
					dynamic_sidebar('homepage-sidebar');
				?>
			</div>
		</div>
	</div>
	
</main>
<!--Main layout-->
<?php get_footer(); ?>