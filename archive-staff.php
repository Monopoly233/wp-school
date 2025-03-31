<?php
/**
 * The template for displaying staff archive pages
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="staff-archive-container">
        <header class="staff-archive-header">
            <h1 class="staff-archive-title"><?php echo esc_html__('Our Staff', 'school'); ?></h1>
            <div class="staff-archive-content">
                <p><?php echo esc_html__('Meet our dedicated team of professionals who work together to provide the best education experience.', 'school'); ?></p>
            </div>
        </header>

        <?php
        // 获取所有部门
        $departments = get_terms(array(
            'taxonomy' => 'department',
            'hide_empty' => true,
        ));

        if (!empty($departments) && !is_wp_error($departments)) :
            ?>
            <div class="staff-grid">
                <?php
                foreach ($departments as $department) :
                    // 获取该部门的所有员工
                    $staff_members = new WP_Query(array(
                        'post_type' => 'staff',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'department',
                                'field' => 'term_id',
                                'terms' => $department->term_id,
                            ),
                        ),
                    ));

                    if ($staff_members->have_posts()) :
                        while ($staff_members->have_posts()) :
                            $staff_members->the_post();
                            ?>
                            <article class="staff-member-card">
                                <div class="staff-department-label"><?php echo esc_html($department->name); ?></div>
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="staff-member-image">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="staff-member-content">
                                    <h3 class="staff-member-name"><?php the_title(); ?></h3>
                                    <?php
                                    // 获取职位和邮箱信息
                                    $blocks = parse_blocks(get_the_content());
                                    foreach ($blocks as $block) {
                                        if ($block['blockName'] === 'core/paragraph') {
                                            if (isset($block['attrs']['className']) && $block['attrs']['className'] === 'staff-job-title') {
                                                echo '<div class="staff-job-title">' . $block['innerHTML'] . '</div>';
                                            } elseif (isset($block['attrs']['className']) && $block['attrs']['className'] === 'staff-email') {
                                                echo '<div class="staff-email">' . $block['innerHTML'] . '</div>';
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </article>
                        <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                endforeach;
                ?>
            </div>
        <?php
        endif;
        ?>
    </div>
</main>

<?php
get_footer(); 