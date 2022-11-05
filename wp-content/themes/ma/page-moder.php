<?php // Template Name: Панель модератора

get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div class="typical-cntainer ctr-panel-moder">
        <?php
        $args = [
            'post_type' => 'cheki',
            'order' => 'asc',
            'posts_per_page' => 500,
            'meta_query'	=> array(
                'relation'		=> 'OR',
                array(
                    'key'	  	=> 'is_approved',
                    'value'	  	=> 'm',
                    'compare' 	=> '=',
                ),
                array(
                    'key'	  	=> 'is_approved',
                    'value'	  	=> '',
                    'compare' 	=> '=',
                ),
                array(
                    'key'	  	=> 'is_approved',
                    'compare' 	=> 'NOT EXISTS',
                ),
            ),
        ];
        $q = new WP_Query($args);
        ?>
        <?php while ($q->have_posts()) { $q->the_post(); ?>
            <div class="moder-item" data-uid="<?php echo get_the_ID(); ?>">
                <div class="moder-item-num">
                    Чек № <?php echo get_the_ID(); ?>
                </div>
                <?php $check_image = get_field( 'check_image' ); ?>
                <?php if ( $check_image ) { ?>
                    <div onclick="window.open('<?php echo $check_image['url']; ?>');" class="img-contain img-moder" style="background-image: url('<?php echo $check_image['sizes']['large']; ?>');"></div>
                <?php } ?>
                <div class="moder-action-btns">
                    <button class="green-accept">Одобрить</button> | <button class="red-decline">Отклонить</button>
                </div>
                <textarea placeholder="Причина отклоения" class="why-declined"></textarea>
            </div>
        <?php } wp_reset_postdata(); ?>
    </div>
<?php endwhile; endif; ?>
<?php get_footer(); ?>