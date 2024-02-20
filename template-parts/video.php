<?php
$video_enabled = get_theme_mod('video_enabled', true);
$video_videoid = get_theme_mod('video_videoid', 'zqLEO5tIuYs');
$video_background_style = get_theme_mod('video_background_style', '');
if (empty($video_background_style)) {
    $video_background_style = 'background-image: url(\'https://i.ytimg.com/vi/' . esc_attr($video_videoid) . '/maxresdefault.jpg\');';
}
$video_videoid_with_rel = $video_videoid ;
if ($video_enabled) :
?>
    <lite-youtube videoid="<?php echo esc_attr($video_videoid_with_rel); ?>" style="<?php echo esc_attr($video_background_style); ?>" params="controls=0&enablejsapi=1"></lite-youtube>
<?php endif; ?>
