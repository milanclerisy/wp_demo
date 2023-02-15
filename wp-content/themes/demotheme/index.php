<?php
get_header();
$args = array(
    'post_type' => 'news',
    'paged' => $paged,
    'orderby' =>'ID',
    'order' =>'asc',        
    'posts_per_page' => 9
    /* 'tax_query' => array(
        array(
            'taxonomy' => 'animal',
            'field' => 'tiger',
        )
    ) */
    );
$the_query = new WP_Query( $args );
if ($the_query->have_posts()) {
    while ($the_query->have_posts()) {
        $the_query->the_post();
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