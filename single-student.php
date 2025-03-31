<?php get_header(); ?>

<article class="single-student">
    <h1><?php the_title(); ?></h1>

    <?php if (has_post_thumbnail()) : ?>
        <div class="student-image">
            <?php the_post_thumbnail('student-thumb-lg'); ?>
        </div>
    <?php endif; ?>

    <div class="student-content">
        <?php the_content(); ?>
    </div>

    <p class="student-tax">
        <?php the_terms(get_the_ID(), 'program'); ?>
    </p>
</article>

<?php get_footer(); ?> 