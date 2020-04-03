<h2><?php echo $title; ?></h2>


<?php foreach ($news as $news_item){ ?>
        <h3><?php echo $news_item->getTitular(); ?></h3>
        <div class="main">
                <?php echo $news_item->getNewsText(); ?>
        </div>
        <p><a href="<?php echo site_url('news/'.$news_item->getSlug()); ?>">View article</a></p>

<?php }