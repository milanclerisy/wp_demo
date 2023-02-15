 <?php
    get_header();
    if (have_posts()) {
        while (have_posts()) {
            the_post();
    ?>
    <article class="post">
        <h1><a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a></h1>
        <p><?php the_content(); ?></p>
    </article>
 <?php
        }
    }
    get_footer();

    ?>