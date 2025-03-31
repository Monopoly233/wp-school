<?php get_header(); ?>

<h1>Our Students</h1>

<div class="students-grid">
    <?php
    $students = new WP_Query(array(
        'post_type' => 'student',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
    ));

    if ($students->have_posts()) :
        while ($students->have_posts()) : $students->the_post();
            ?>
            <div class="student-card">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('student-thumb-sm'); ?>
                    <h2><?php the_title(); ?></h2>
                </a>
                <p class="student-tax">
                    <?php the_terms(get_the_ID(), 'program'); ?>
                </p>
            </div>
            <?php
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
</div>

<?php get_footer(); ?>
