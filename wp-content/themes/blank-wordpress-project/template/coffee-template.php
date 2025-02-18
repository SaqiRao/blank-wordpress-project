<?php
/* Template Name: Coffee and Kanye Quotes */
get_header();
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Welcome to the Coffee and Kanye Quotes Page</h2>

    <div class="card mb-4">
        <div class="card-header">
            <h4>Random Coffee Link</h4>
        </div>
        <div class="card-body">
            <?php
            // Display the Coffee Link
            $coffee_link = hs_give_me_coffee();
            echo '<p>Here is your random coffee link: <a href="' . esc_url($coffee_link) . '" target="_blank" class="btn btn-primary">Click here</a></p>';
            ?>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>5 Kanye West Quotes</h4>
        </div>
        <div class="card-body">
            <?php
            // Fetch and display Kanye quotes
            $quotes = get_kanye_quotes();
            foreach ($quotes as $quote) {
                echo '<p class="blockquote">' . esc_html($quote) . '</p>';
            }
            ?>
        </div>
    </div>
</div>

<?php
get_footer();
?>

