<?php get_header(); ?>
<div class="container">
    <div class="main-content">
        <h1><?php echo get_the_archive_title(); ?></h1>

        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <?php the_excerpt(); ?>
                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <p>No se encontraron publicaciones en esta categoría.</p>
        <?php endif; ?>

        <div class="pagination">
            <?php the_posts_pagination(); ?>
        </div>
    </div>
<?php get_footer(); ?>
