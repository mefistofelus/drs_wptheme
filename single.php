<?php  get_header();
if ( have_posts() ) {
while ( have_posts() ) {
the_post();
?>
<!--Main layout-->
<main>
    <!-- Intro -->
    <div class="card card-intro blue-gradient mb-3">
        <div class="card-body text-light rgba-black-light text-center pt-5 pb-4 mt-3">
            <!--Grid row-->
            <div class="row d-flex justify-content-center">
                <!--Grid column-->
                <div class="col-md-6">
                    <h1 class="font-weight-bold mb-4"><?php the_title() ?></h1>
                </div>
                <!--Grid column-->
            </div>
            <!--Grid row-->
        </div>
    </div>
    <!-- Intro -->
    <div class="container-fluid">
        <!--Section: Post-->
        <section class="mt-3">
            <!--Grid row-->
            <div class="row wow fadeIn">
                <!--Grid column-->
                <div class="col-md-9 mb-4">
                    <!-- Breadcrumbs -->
                    <div class="container">
                        <?php the_breadcrumb() ?>
                    </div>
                    <!-- Breadcrumbs -->
                    <?php the_post_thumbnail( 'large', array( 'class'=> 'img-fluid z-depth-1-half mb-4')); ?>
                    <div class="card mb-4">
                        <!--Card content-->
                        <div class="card-body justify-content-end">
                            
                            <div class="post-content">
                                <?php the_content(); ?>
                            </div>
                            <hr>
                            <p class="text-muted">Опублікoвано <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a> | <?php echo get_the_date(); ?></p>
                        </div>
                    </div>
                </div>
                <!--Grid column-->
                <!--Grid column-->
                <div class="col-md-3 mb-4">
                        <!--Section: Dynamic Content Wrapper-->
                        <div class="custom">
                            <?php
                            if ( function_exists('dynamic_sidebar') )
                                dynamic_sidebar('page-sidebar');
                            ?>
                        </div>
                </div>
                <!--Grid column-->
            </div>
            <!--Grid row-->
        </section>
        <!--Section: Post-->
    </div>
</main>
<!--Main layout-->
<?php
} // end while
} // end if
get_footer();
?>