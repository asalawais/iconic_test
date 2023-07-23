<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php if (have_posts()) : ?>
            <div class="projects-wrapper">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('thumbnail'); ?>
                                </a>
                            <?php endif; ?>
                            <h2 class="entry-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                        </header>
                        <div class="entry-content">
                            <?php the_excerpt(); ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <?php
            // Display pagination
            the_posts_pagination(array(
                'prev_text' => __('Previous', 'textdomain'),
                'next_text' => __('Next', 'textdomain'),
            ));
            ?>

        <?php else : ?>
            <p><?php _e('No projects found.', 'textdomain'); ?></p>
        <?php endif; ?>

    </main>
</div>

<?php get_footer(); ?>
