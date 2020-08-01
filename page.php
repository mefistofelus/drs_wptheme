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
                    <?php echo do_shortcode( '[contact-form-7 id="99" title="ІНФОРМАЦІЯ про відсутніх працівників Відділу інформаційних технологій, захисту інформації та з питань цифрового розвитку   на робочому місці 03.07.2020 року"]' );?>
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
                        <!--Card-->
                        <div class="card mb-4">
                            <div class="card-header">Related articles</div>
                            <!--Card content-->
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    <li class="media">
                                        <div class="media-body">
                                            <a href="">
                                                <h5 class="mt-0 mb-1 font-weight-bold">List-based media object</h5>
                                            </a>
                                            Cras sit amet nibh libero, in gravida nulla (...)
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!--/.Card-->
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