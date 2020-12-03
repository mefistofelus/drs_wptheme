<?php get_header(); ?>


<!--Main layout-->
<main class="mt-4">
    <!-- Intro -->
    <div class="card card-intro blue-gradient mb-3">
        <div class="card-body text-light rgba-black-light text-center pt-5 pb-4 mt-3">
            <!--Grid row-->
            <div class="row d-flex justify-content-center">
                <!--Grid column-->
                <div class="col-md-8">
                    <h1 class="font-weight-bold mb-4">
                        <?php the_title(); ?>
                    </h1>
                </div>
                <!--Grid column-->
            </div>
            <!--Grid row-->
        </div>
    </div>
    <!-- Intro -->
    <div class="container">
        <!--Section: Post-->
        <section class="mt-3">
            <!--Grid row-->
            <div class="row wow fadeIn">
                <!--Grid column-->
                <div class="col-md-8 mb-4">
                    <?php while ( have_posts() ) : the_post();
                            the_content();
                    ?>
                    <?php endwhile; // end of the loop. ?>

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
    get_footer();
?>