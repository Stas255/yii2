<?php

use yii\helpers\Url;

?>
<div class="col-md-8">
    <article class="post">
        <div class="post-thumb">
            <a href="blog.html"><img src="<?= $article->getImage() ?>" alt=""></a>
        </div>
        <div class="post-content">
            <header class="entry-header text-center text-uppercase">
                <h6>
                    <a href="<?= Url::toRoute(['/topic', 'id' => $article->topic->id]) ?>"> <?= $article->topic->name; ?></a>
                </h6>

                <h1 class="entry-title"><a href="blog.html"><?= $article->title; ?></a></h1>


            </header>
            <div class="entry-content">
                <?= $article->description; ?>
            </div>
            <div class="decoration">
                <a href="#" class="btn btn-default">Decoration</a>
                <a href="#" class="btn btn-default">Decoration</a>
            </div>

            <div class="social-share">
							<span
                                    class="social-share-title pull-left text-capitalize">By <?= $article->user->name;  ?> On <?= $article->getDate(); ?></span>
                <ul class="text-center pull-right">
                    <li><a class="s-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a class="s-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a class="s-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                    <li><a class="s-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                    <li><a class="s-instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
    </article>
    <?php if (!Yii::$app->user->isGuest): ?>
        <?php $form = \yii\widgets\ActiveForm::begin([
            'action' => ['site/comment', 'id' => $article->id],
            'options' => ['class' => '', 'role' => 'form']]) ?>
        <div class="leave-comment"><!--leave comment-->
            <h4>Leave a reply</h4>
            <form class="form-horizontal contact-form" role="form" method="post" action="#">
                <div class="form-group">
                    <div class="col-md-12">
                        <?= $form->field($commentForm, 'comment')->textarea(['class' => 'form-control', 'placeholder' => 'Write Message'])->label(false) ?>
                    </div>
                </div>
                <button type="submit" class="btn send-btn">Post Comment</button>
                <?php \yii\widgets\ActiveForm::end() ?>
            </form>
        </div><!--end leave comment-->
    <?php endif; ?>


    <?php if (!empty($comments)): ?>
        <div class="comments-block">
            <?php foreach ($comments as $comment): ?>
                <div class="comment-block">
                    <div class="comment">
                        <a href="#" class="comment-img">
                            <img class="img-round" src="<?= $comment->user->getImage(); ?>" alt="">
                        </a>
                        <div class="comment-body">
                            <div class="comment-top">
                                <a href="#" class="replay btn pull-right"> Replay</a>
                                <h5><?= $comment->user->name; ?></h5>
                                <p class="comment-date">
                                    <?= $comment->getDate(); ?>
                                </p>
                            </div>
                            <div class="comment-text">
                                <?= $comment->text; ?>
                            </div>
                        </div>
                    </div>
                    <div class="comment-childs-container">
                        <div class="comment-childs">
                            <div class="comment-block">
                                <div class="comment">
                                    <a href="#" class="comment-img">
                                        <img class="img-round" src="assets/images/blog-1.jpg" alt="">
                                    </a>
                                    <div class="comment-body">
                                        <div class="comment-top">
                                            <a href="#" class="replay btn pull-right"> Replay</a>
                                            <h5>Rubel Miah</h5>
                                            <p class="comment-date">
                                                December, 02, 2015 at 5:57 PM
                                            </p>
                                        </div>
                                        <div class="comment-text">
                                            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                                            diam nonumy
                                            eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam
                                            voluptua. At vero eos et cusam et justo duo dolores et ea rebum.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="comment-block">
                                <div class="comment">
                                    <a href="#" class="comment-img">
                                        <img class="img-round" src="assets/images/blog-1.jpg" alt="">
                                    </a>
                                    <div class="comment-body">
                                        <div class="comment-top">
                                            <a href="#" class="replay btn pull-right"> Replay</a>
                                            <h5>Rubel Miah</h5>
                                            <p class="comment-date">
                                                December, 02, 2015 at 5:57 PM
                                            </p>
                                        </div>
                                        <div class="comment-text">
                                            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                                            diam nonumy
                                            eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam
                                            voluptua. At vero eos et cusam et justo duo dolores et ea rebum.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>
<?php
echo \Yii::$app->view->renderFile('@app/views/site/right.php', compact('popular', 'recent', 'topics'));
?>
