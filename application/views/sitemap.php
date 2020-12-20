<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php '<?xml version="1.0" encoding="UTF-8" ?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?php echo base_url() ?></loc>
        <lastmod>2019-09-26T19:39:45+00:00</lastmod>
    </url>
    <?php
    foreach ($object_variables as $object_variable){
    ?>
    <url>
        <loc><?php echo base_url(),'pages/'.text_dash(strtolower($object_variable->colomn)) ?></loc>
        <lastmod>2019-09-26T19:39:45+00:00</lastmod>
        <!-- <lastmod><?php echo date(DATE_ATOM, $object_variable->time_colomn); ?></lastmod> -->
    </url>
    <?php } ?>
</urlset>