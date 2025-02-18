<?php get_header(); ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Projects Archive</h2>

    <?php
    $args = array(
        'post_type' => 'projects',
        'posts_per_page' => 6,
        'paged' => get_query_var('paged', 1),
    );
    $projects_query = new WP_Query($args);

    if ($projects_query->have_posts()) :
        echo '<div class="row">'; // Start a row for the grid layout
        while ($projects_query->have_posts()) : $projects_query->the_post();
            ?>
            <div class="col-md-4 mb-4"> <!-- 3 columns layout on medium screens -->
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                        <p class="card-text"><?php the_excerpt(); ?></p>
                    </div>
                </div>
            </div>
            <?php endwhile;
        echo '</div>'; // End the row

        // Pagination
        echo '<div class="pagination text-center mt-4">';
        echo paginate_links(array(
            'total' => $projects_query->max_num_pages,
            'prev_text' => '&laquo; Prev',
            'next_text' => 'Next &raquo;',
        ));
        echo '</div>';

    else :
        echo '<p>No projects found.</p>';
    endif;

    wp_reset_postdata();
    ?>

</div>

<?php get_footer(); ?>
