<?php get_header(); ?>


<!--Main layout-->
<main>
    <!-- Intro -->
    <div class="card card-intro blue-gradient mb-3">
        <div class="card-body text-light rgba-black-light text-center pt-5 pb-4 mt-3">
            <!--Grid row-->
            <div class="row d-flex justify-content-center">
                <!--Grid column-->
                <div class="col-md-8">
                    <h1 class="font-weight-bold mb-4">
                        <?php single_cat_title(); ?>
                    </h1>
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

                    <?php 
                        $infocat = get_the_category();
                        $info = $infocat[0]->cat_ID;
                        $array = "orderby=date&amp;showposts=10&amp;cat=$info";
                        query_posts($array);

                        if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                            <!--Card-->
                            <div class="card mb-4">
                                <div class="card-body">
                                    <ul class="list-unstyled">
                                        <li class="media">
                                            <div class="media-body">
                                                <a href="<?php the_permalink() ?>" title="Читати: <?php the_title(); ?>">
                                                    <h5 class="mt-0 mb-1 pb-2 border-bottom font-weight-bold"><?php the_title(); ?></h5>
                                                </a>
                                                <?php the_excerpt(); ?>
                                            </div>
                                            <div class="post-date text-muted text-right">
                                                <small><?php echo get_the_date(); ?></small>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--/.Card-->
                        <?php endwhile; else: ?>
                            Публікацій не знайдено
                        <?php endif; wp_reset_query();?>
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