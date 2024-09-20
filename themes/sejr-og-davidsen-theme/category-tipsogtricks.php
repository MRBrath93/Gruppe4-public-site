<?php get_header();
sejr_davidsens_heroBanner();
?>
<!-- Kategoriside for alle nyheder med kategorien "tips og tricks"-->
<div>
    <main>
        <h1 class="titleForPage archiveTitle">Arkiv: Tips & Tricks</h1>
        <?php

        $tipsogtricksArticles = new WP_Query(
            array(
                'category_name' => 'tipsogtricks',
                'post_type' => 'nyheder',
                'posts_per_page' => 4,
                'orderby' => 'date',
                'order' => 'ASC',
            )
        );

        while ($tipsogtricksArticles->have_posts()) {
            $tipsogtricksArticles->the_post();
            $image_url = get_field('billede')['url'];
            $image_alt = get_field('billede')['alt'];

        ?>
            <div class="introText flex-item">
                <div>
                    <img class="article-img" src="<?php echo esc_url($image_url) ?>" alt="<?php echo $image_alt; ?>"
                        loading="lazy">
                </div>
                <div class="random-news-section">
                    <p class="article-styling">Skrevet af <span class="bold-styling"><?php the_author_posts_link(); ?></span> d. <?php the_time('n.j.y'); ?>
                        i <span class="bold-styling"><?php echo get_the_category_list(','); ?></span>
                    </p>

                    <h5 class="news-black-text"><?php the_title(); ?></h5>
                    <div class="dogtype-styling">
                        <p><?php echo wp_trim_words(get_field('indhold'), 25); ?></p>
                        <a class="readmore-link" href="<?php the_permalink(); ?>">Læs mere</a>
                    </div>
                    <hr class="section-break">
                </div>
            </div>



        <?php
        }
        echo paginate_links();

        wp_reset_postdata();
        ?>
    </main>


    <?php
    get_footer();
    ?>