<?php
$data           = $args['data_preheader'] ?? null;

$context        = $data['context'] ?? 'single';
$post_type      = $data['post_type'] ?? null;
$breadcrumb_link_label = $data['breadcrumb_link_label'] ?? null;
$breadcrumb_link  = $data['breadcrumb_link'] ?? null;

?>

<?php if ($context === 'single' && $post_type && $breadcrumb_link_label): ?>
    <header class="preheader">
        <div class="breadcrumbs">
            <a href="<?php echo esc_url($breadcrumb_link); ?>">
                <?php echo esc_html($breadcrumb_link_label); ?>
            </a>
        </div>
    </header>
<?php endif; ?>