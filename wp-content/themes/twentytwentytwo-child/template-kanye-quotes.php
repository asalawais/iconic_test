<?php
/*
Template Name: Kanye West Quotes
*/

get_header();

$quotes = array();
for ($i = 0; $i < 5; $i++) {
    $quote = get_kanye_quotes();
    if ($quote) {
        $quotes[] = $quote['quote'];
    }
}
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php if (!empty($quotes)) : ?>
            <div class="kanye-quotes">
                <h2>Kanye West Quotes</h2>
                <ul>
                    <?php foreach ($quotes as $quote) : ?>
                        <li><?php echo esc_html($quote); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php else : ?>
            <p>Sorry, we couldn't fetch the Kanye West quotes at the moment.</p>
        <?php endif; ?>

    </main>
</div>

<?php get_footer(); ?>
