<div class="col-md-8">
    <?php foreach ($articles as $article): ?>
        <article class="post">
            <div class="post-thumb">
                <a href="blog.html"><img src="<?= $article->getImage()  ?>" alt=""></a>
            </div>
            <div class="post-content">
                <header class="entry-header text-center text-uppercase">
                    <h6><a href="#"> <?= $article->topic->name;  ?></a></h6>

                    <h1 class="entry-title"><a href="blog.html"><?= $article->title;  ?></a></h1>


                </header>
                <div class="entry-content">
                    <p><?= $article->description;  ?>
                    </p>

                    <div class="btn-continue-reading text-center text-uppercase">
                        <a href="blog.html" class="more-link">Continue Reading</a>
                    </div>
                </div>
                <div class="social-share">
                    <span class="social-share-title pull-left text-capitalize">By <a href="#">Rubel</a> On <?= $article->date;  ?></span>
                    <ul class="text-center pull-right">
                        <li><a class="s-facebook" href="#"><i class="fa fa-eye"></i></a></li>
                        <?= (int)$article->viewed;  ?>
                    </ul>
                </div>
            </div>
        </article>
     <?php endforeach; ?>

    <?php

    use yii\widgets\LinkPager;

    echo LinkPager::widget([
    'pagination' => $pagination,
    ]);
    ?>
</div>






