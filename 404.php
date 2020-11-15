<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package drs
 */

get_header();
?>

    <main id="primary" class="site-main pt-5 mx-lg-5">
        <div class="container-fluid mt-3">

            <div class="row mt-5">
                <div class="col-md-10">
                    <section class="error-404 not-found pt-5">
                        <header class="masthead d-flex">
                            <div class="container text-center my-auto">
                                <h1 class="mb-1 text-success">Ваше повідомлення успішно відправлено!</h1>
                                <div class="text-success p-4"><i class="fas fa-check-circle fa-5x"></i></div>
                                <h3 class="mb-5">
                                    <em>Зачекайте будь ласка, спеціаліст уже працює над Вашою проблемою... </em>
                                </h3>
                                <a class="btn btn-primary btn-xl js-scroll-trigger" href="/"><i class="fas fa-hand-point-left mr-1"></i>Повернутися на головну</a>
                            </div>
                            <div class="overlay"></div>
                        </header>
                    </section><!-- .error-404 -->
                </div>
            </div>

        </div>
    </main><!-- #main -->

<?php
get_footer();
