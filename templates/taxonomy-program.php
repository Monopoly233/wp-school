<?php get_header(); ?>

<h1>Students in "<?php single_term_title(); ?>"</h1>

<div class="students-grid">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post(); ?>
            <div class="student-card">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('student-thumb-sm'); ?>
                    <h2><?php the_title(); ?></h2>
                </a>
            </div>
        <?php endwhile;
    else :
        echo '<p>No students found in this category.</p>';
    endif;
    ?>
</div>

<?php get_footer(); ?>
