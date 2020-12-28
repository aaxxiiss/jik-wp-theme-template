<?php get_header(); ?>

<main>

    <div class="container">

        <?php if (have_posts()) : while(have_posts()) : the_post();?>

            <?php the_title();?>

            <?php the_content();?>

        <?php endwhile; endif;?>
    
    </div>

</main>

<?php get_footer(); ?>