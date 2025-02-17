<?php
get_header(); // Include the header

// The Loop for displaying custom post type 'projects' with pagination
$args = array(
    'post_type' => 'projects',  // Custom post type slug
    'posts_per_page' => 6,      // Limit to 6 projects per page
    'paged' => get_query_var( 'paged', 1 ), // Ensure pagination works
);
$projects_query = new WP_Query( $args );

?>

<div class="container">
    <div class="projects-section">
        <h1>Our Projects</h1>

        <?php
        if ( $projects_query->have_posts() ) :
            echo '<div class="projects-container">';

            while ( $projects_query->have_posts() ) : $projects_query->the_post();
                ?>
                <div class="project-item">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="project-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                </div>
                <?php
            endwhile;

            echo '</div>';

            // Pagination for the custom query
            echo '<div class="pagination">';
            echo paginate_links( array(
                'total' => $projects_query->max_num_pages,
                'prev_text' => 'Previous',
                'next_text' => 'Next',
            ) );
            echo '</div>';

        else :
            echo '<p>No projects found.</p>';
        endif;

        wp_reset_postdata(); // Reset the custom query
        ?>
    </div>
</div>

<?php
get_footer(); // Include the footer
?>
