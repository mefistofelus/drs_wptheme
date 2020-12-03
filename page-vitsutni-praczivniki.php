<?php get_header(); ?>


<!--Main layout-->
<main class="mt-5 pt-5">
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
                    <?php get_template_part('template-parts/content-vidsutni'); ?>
                </div>
                <!--Grid column-->
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <!-- Sticky content -->
                    <div class="sticky">
                        <!--Section: Dynamic Content Wrapper-->
                        <section>
                            <div id="dynamic-content"></div>
                        </section>
                        <!--Section: Dynamic Content Wrapper-->
                      
                    </div>
                    <!-- Sticky content -->
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