<?php

    $posts = get_posts(array(
        'numberposts' => -1,
        'post_type' => 'employee',
        'meta_key' => 'birthdate',
    ));

    if($posts)
    {
        foreach($posts as $post)
        {
            $current_date = date('d.m');
            $birth_date = get_field('birthdate');

            if ($birth_date == $current_date) { ?>
                <h6 class="text-warning text-center font-weight-bold pb-2">СЬОГОДНІ ДЕНЬ НАРОДЖЕННЯ</h6>
                <div class="card card-cascade border-primary wider z-depth-4 hover-shadow mb-4">
                    <!-- Card image -->
                    <div class="view view-cascade overlay" style="max-height: 300px; overflow: hidden;">
                        <!-- <img class="card-img-top" src="<?php echo get_template_directory_uri() . '/img/happy-birthday.jpg' ?>" alt="З Днем народження!"> -->
                        <img class="card-img-top" src="<?php the_field('image'); ?>" alt="З Днем народження!">
                    </div>

                    <!-- Card content -->
                    <div class="card-body card-body-cascade text-center">
                        <h5 class="card-title"><?php echo '<a href="' . get_permalink($post->ID) . '">' . get_the_title($post->ID) . '</a>'; ?></h5>
                        <h6 class="text-primary pb-2"><?php the_field('position'); ?></h6>
                        <hr>
                        <!-- Email link -->
                        <a href="mailto:<?php the_field('email'); ?>" class="text-muted card-link" style="white-space: nowrap;">
                            <i class="fa fa-envelope mr-1 text-dark"></i>
                        </a>
                        <!-- Phone -->
                        <a href="tel:<?php the_field('phone'); ?>" class="text-muted card-link" style="white-space: nowrap;">
                            <i class="fa fa-phone mr-1 text-dark"></i>
                        </a>
                    </div>
                </div>
                <!-- Card Wider -->
            <?php
            }
        }
    }

    if($posts)
        {
            foreach($posts as $post)
            {
                $get_tomorrow_date = time() + 60*60*24;
                $tomorrow_date = date('d.m', $get_tomorrow_date);
                $birth_date = get_field('birthdate');

                if ($birth_date == $tomorrow_date) { ?>
                    <h6 class="text-warning text-center font-weight-bold pb-2">ЗАВТРА ДЕНЬ НАРОДЖЕННЯ</h6>
                    <div class="card card-cascade border-primary wider z-depth-4 hover-shadow mb-4">
                        <!-- Card image -->
                        <div class="view view-cascade overlay" style="max-height: 300px; overflow: hidden;">
                        </div>

                        <!-- Card content -->
                        <div class="card-body card-body-cascade text-center">
                            <h5 class="card-title"><?php echo '<a href="' . get_permalink($post->ID) . '">' . get_the_title($post->ID) . '</a>'; ?></h5>
                            <h6 class="text-muted pb-2"><?php the_field('position'); ?></h6>
                            <hr>
                            <!-- Email link -->
                            <a href="mailto:<?php the_field('email'); ?>" class="text-muted card-link" style="white-space: nowrap;">
                                <i class="fa fa-envelope mr-1 text-dark"></i>
                            </a>
                            <!-- Phone -->
                            <a href="tel:<?php the_field('phone'); ?>" class="text-muted card-link" style="white-space: nowrap;">
                                <i class="fa fa-phone mr-1 text-dark"></i>
                            </a>
                        </div>
                    </div>
                    <!-- Card Wider -->
                <?php
                }
            }
        }

    if($posts)
        {
            foreach($posts as $post)
            {
                $get_after_tomorrow_date = time() + 60*60*48;
                $after_tomorrow_date = date('d.m', $get_after_tomorrow_date);
                $birth_date = get_field('birthdate');

                if ($birth_date == $after_tomorrow_date) { ?>
                    <h6 class="text-warning text-center font-weight-bold pb-2">ПІСЛЯЗАВТРА ДЕНЬ НАРОДЖЕННЯ</h6>
                    <div class="card card-cascade border-primary wider z-depth-4 hover-shadow mb-4">
                        <!-- Card image -->
                        <div class="view view-cascade overlay" style="max-height: 300px; overflow: hidden;">
                        </div>

                        <!-- Card content -->
                        <div class="card-body card-body-cascade text-center">
                            <h5 class="card-title"><?php echo '<a href="' . get_permalink($post->ID) . '">' . get_the_title($post->ID) . '</a>'; ?></h5>
                            <h6 class="text-muted pb-2"><?php the_field('position'); ?></h6>
                            <hr>
                            <!-- Email link -->
                            <a href="mailto:<?php the_field('email'); ?>" class="text-muted card-link" style="white-space: nowrap;">
                                <i class="fa fa-envelope mr-1 text-dark"></i>
                            </a>
                            <!-- Phone -->
                            <a href="tel:<?php the_field('phone'); ?>" class="text-muted card-link" style="white-space: nowrap;">
                                <i class="fa fa-phone mr-1 text-dark"></i>
                            </a>
                        </div>
                    </div>
                    <!-- Card Wider -->
                <?php
                }
            }
        }

    ?>