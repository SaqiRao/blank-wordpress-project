<?php get_header(); ?>

<?php
$args = array(
    'post_type' => 'projects',
    'posts_per_page' => 6,
    'paged' => get_query_var('paged', 1),
);
$projects_query = new WP_Query($args);

if ($projects_query->have_posts()) :
    echo '<div class="projects-container">';
    while ($projects_query->have_posts()) : $projects_query->the_post();
        ?>
        <div class="project-item">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="project-excerpt"><?php the_excerpt(); ?></div>
        </div>
        <?php endwhile;
    echo '</div>';

    echo paginate_links(array(
        'total' => $projects_query->max_num_pages,
    ));
else :
    echo '<p>No projects found.</p>';
endif;

wp_reset_postdata();
?>

<?php get_footer(); ?>
