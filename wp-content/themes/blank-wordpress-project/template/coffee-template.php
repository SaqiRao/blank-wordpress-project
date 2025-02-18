<?php
/* Template Name: Coffee and Kanye Quotes */
get_header();
?>

<div class="content">
    <h2>Welcome to the Coffee and Kanye Quotes Page</h2>

    <?php
    // Display the Coffee Link and Kanye Quotes
    $coffee_link = hs_give_me_coffee();
    echo '<p>Here is your random coffee link: <a href="' . esc_url($coffee_link) . '" target="_blank">Click here</a></p>';

    $quotes = get_kanye_quotes();
    echo '<h3>Here are 5 Kanye West Quotes:</h3>';
    foreach ($quotes as $quote) {
        echo '<p>' . esc_html($quote) . '</p>';
    }
    ?>

</div>

<?php
get_footer();
?>
