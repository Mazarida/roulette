<?php // Template Name: Главная

get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div class="swiper-container sc1__banner-slider">
        <div class="swiper-wrapper">
            <div class="swiper-slide sc1__slide sld_1-1">
                <div class="ani-slide-1">
                    <div class="main-sldr-img sl1" style="background-image: url('<?php bloginfo('template_url'); ?>/assets/img/slide_1.png')"></div>
                </div>
                <h2 class="sc1__header-slide">
                    Разыгрываем <span class="sc1__header-slide-accent">5 iPhone</span>
                    <br>и свыше 5000 других призов!
                </h2>
                <a href="#" class="sc1__cta-slide">Выиграть приз</a>
            </div>
            <div class="swiper-slide sc1__slide sld_1-2">
                <div class="ani-slide-1">
                    <div class="main-sldr-img sl2" style="background-image: url('<?php bloginfo('template_url'); ?>/assets/img/slide_2.png')"></div>
                </div>
                <h2 class="sc1__header-slide">
                    Разыгрываем <span class="sc1__header-slide-accent">5 iPhone</span>
                    <br>и свыше 5000 других призов!
                </h2>
                <a href="#" class="sc1__cta-slide">Выиграть приз</a>
            </div>
            <div class="swiper-slide sc1__slide sld_1-3">
                <div class="ani-slide-2">
                    <div class="main-sldr-img sl3" style="background-image: url('<?php bloginfo('template_url'); ?>/assets/img/slide_3.png')"></div>
                </div>
                <h2 class="sc1__header-slide">
                    Разыгрываем <span class="sc1__header-slide-accent">5 iPhone</span>
                    <br>и свыше 5000 других призов!
                </h2>
                <a href="#" class="sc1__cta-slide">Выиграть приз</a>
            </div>
            <div class="swiper-slide sc1__slide sld_1-4">
                <div class="ani-slide-3">
                    <div class="main-sldr-img sl41" style="background-image: url('<?php bloginfo('template_url'); ?>/assets/img/slide_4-1.png')"></div>
                </div>
                <div class="ani-slide-4">
                    <div class="main-sldr-img sl42" style="background-image: url('<?php bloginfo('template_url'); ?>/assets/img/slide_4-2.png')"></div>
                </div>
                <div class="ani-slide-5">
                    <div class="main-sldr-img sl43" style="background-image: url('<?php bloginfo('template_url'); ?>/assets/img/slide_4-3.png')"></div>
                </div>
                <h2 class="sc1__header-slide">
                    Разыгрываем <span class="sc1__header-slide-accent">5 iPhone</span>
                    <br>и свыше 5000 других призов!
                </h2>
                <a href="#" class="sc1__cta-slide">Выиграть приз</a>
            </div>
            <div class="swiper-slide sc1__slide sld_1-5">
                <div class="ani-slide-6">
                    <div class="main-sldr-img sl51" style="background-image: url('<?php bloginfo('template_url'); ?>/assets/img/slide_5-1.png')"></div>
                </div>
                <div class="ani-slide-7">
                    <div class="main-sldr-img sl52" style="background-image: url('<?php bloginfo('template_url'); ?>/assets/img/slide_5-2.png')"></div>
                </div>
                <h2 class="sc1__header-slide">
                    Разыгрываем <span class="sc1__header-slide-accent">5 iPhone</span>
                    <br>и свыше 5000 других призов!
                </h2>
                <a href="#" class="sc1__cta-slide">Выиграть приз</a>
            </div>
            <div class="swiper-slide sc1__slide sld_1-6">
                <div class="ani-slide-8">
                    <div class="main-sldr-img sl61" style="background-image: url('<?php bloginfo('template_url'); ?>/assets/img/slide_6-1.png')"></div>
                </div>
                <div class="ani-slide-9">
                    <div class="main-sldr-img sl62" style="background-image: url('<?php bloginfo('template_url'); ?>/assets/img/slide_6-2.png')"></div>
                </div>
                <div class="ani-slide-10">
                    <div class="main-sldr-img sl63" style="background-image: url('<?php bloginfo('template_url'); ?>/assets/img/slide_6-3.png')"></div>
                </div>
                <h2 class="sc1__header-slide">
                    Разыгрываем <span class="sc1__header-slide-accent">5 iPhone</span>
                    <br>и свыше 5000 других призов!
                </h2>
                <a href="#" class="sc1__cta-slide">Выиграть приз</a>
            </div>
            <div class="swiper-slide sc1__slide sld_1-7">
                <div class="ani-slide-11">
                    <div class="main-sldr-img sl7" style="background-image: url('<?php bloginfo('template_url'); ?>/assets/img/slide_7.png')"></div>
                </div>
                <h2 class="sc1__header-slide">
                    Разыгрываем <span class="sc1__header-slide-accent">5 iPhone</span>
                    <br>и свыше 5000 других призов!
                </h2>
                <a href="#" class="sc1__cta-slide">Выиграть приз</a>
            </div>
        </div>
        <div class="slider__sc1-nextprev">
            <div class="swiper-arrow-prev slider__sc1-prev"></div>
            <div class="swiper-arrow-next slider__sc1-next"></div>
        </div>
    </div>
    <div class="swiper-container sc1__banner-subslider">

        <div class="swiper-wrapper">
            <div class="swiper-slide sc1__slide-smx" style="background-color: #F24329; background-image: url('<?php bloginfo('template_url'); ?>/assets/img/lava-crab.svg')">
                <div class="img-contain img__sc1-subslider">
                    <div class="hover-stuff">
                        Лава с крабом при заказе от 799 р. в подарок.
                    </div>
                </div>
            </div>
            <div class="swiper-slide sc1__slide-smx" style="background-color: #C6C958; background-image: url('<?php bloginfo('template_url'); ?>/assets/img/california-kappa.svg')">
                <div class="img-contain img__sc1-subslider">
                    <div class="hover-stuff">
                        Калифорния каппа
                    </div>
                </div>
            </div>
            <div class="swiper-slide sc1__slide-smx" style="background-color: #F2982F; background-image: url('<?php bloginfo('template_url'); ?>/assets/img/kuritsa.svg')">
                <div class="img-contain img__sc1-subslider">
                    <div class="hover-stuff">
                        Ролл с курицей
                    </div>
                </div>
            </div>
            <div class="swiper-slide sc1__slide-smx" style="background-color: #8453A2; background-image: url('<?php bloginfo('template_url'); ?>/assets/img/skidka20.svg')">
                <div class="img-contain img__sc1-subslider">
                    <div class="hover-stuff">
                        Скидка 20%
                    </div>
                </div>
            </div>
            <div class="swiper-slide sc1__slide-smx" style="background-color: #FF7317; background-image: url('<?php bloginfo('template_url'); ?>/assets/img/fila-syake.svg')">
                <div class="img-contain img__sc1-subslider">
                    <div class="hover-stuff">
                        Филадельфия сяке
                    </div>
                </div>
            </div>
            <div class="swiper-slide sc1__slide-smx" style="background-color: #41467D; background-image: url('<?php bloginfo('template_url'); ?>/assets/img/etofila.svg')">
                <div class="img-contain img__sc1-subslider">
                    <div class="hover-stuff">
                        Этофила
                    </div>
                </div>
            </div>
            <div class="swiper-slide sc1__slide-smx" style="background-color: #31333A; background-image: url('<?php bloginfo('template_url'); ?>/assets/img/iphone.svg')">
                <div class="img-contain img__sc1-subslider">
                    <div class="hover-stuff">
                        iPhone
                    </div>
                </div>
            </div>
        </div>
        <div class="slider__sc2-pagination"></div>
    </div>
    <div class="sc2__wheel-block">
        <h2 class="sc2__hrader">
            Крутите <span class="accent">колесо</span> <br>
            и выигрывайте <span class="accent">вкусные призы!</span>
        </h2>
        <div class="flex-row typical-cntainer sc2__wheel-meta">
            <div class="sc2__wheel-l">
                <div class="wheel-holder">
                    <div class="img-contain wheel-overlay"></div>
                    <div class="wheel-prizes">
                        <div class="wheel-prize" style="background-image: url('<?php bloginfo('template_url'); ?>/assets/img/prize1_roulette.svg')"></div>
                        <div class="wheel-prize" style="background-image: url('<?php bloginfo('template_url'); ?>/assets/img/prize2_roulette.svg')"></div>
                        <div class="wheel-prize" style="background-image: url('<?php bloginfo('template_url'); ?>/assets/img/prize3_roulette.svg')"></div>
                        <div class="wheel-prize" style="background-image: url('<?php bloginfo('template_url'); ?>/assets/img/prize4_roulette.svg')"></div>
                        <div class="wheel-prize" style="background-image: url('<?php bloginfo('template_url'); ?>/assets/img/prize5_roulette.svg')"></div>
                        <div class="wheel-prize" style="background-image: url('<?php bloginfo('template_url'); ?>/assets/img/prize6_roulette.svg')"></div>
                        <div class="wheel-prize" style="background-image: url('<?php bloginfo('template_url'); ?>/assets/img/prize7_roulette.svg')"></div>
                    </div>
                </div>
            </div>
            <div class="sc2__meta-r">
                <div class="sc2__meta-header">Всего попыток:
                    <span class="tries-count"><?php
                        if (get_field('tries_wheel', 'user_'.get_current_user_id())) {
                            echo get_field('tries_wheel', 'user_'.get_current_user_id());
                        } else {
                            echo '0';
                        }
                        ?></span>
                </div>
                <div class="sc2__meta-legend">
                    Выполните задание и нажмите кнопку “Готово”, чтобы получить дополнительную попытку крутить колесо
                </div>
                <div class="sc2__tasks">
                    <?php
                    $checkr = get_field('task_subscribe', 'user_'.get_current_user_id());
                    if ($checkr) {
                        $cls = 'task-finished';
                        $txr = 'Начислено';
                    } else {
                        $cls = 'task-not-finished';
                        $txr = 'Готово';
                    }
                    ?>
                    <div class="flex-row sc2__task <?php echo $cls; ?>">
                        <div class="flex-row sc2__task-name-try">
                            <div class="sc2__task-name">
                                Подпишитесь на <a href="https://vk.com/sushi_takeaway" target="_blank" style="text-decoration: underline;">сообщество</a>
                            </div>
                            <div class="sc2__task-try">
                                + 1 попытка
                            </div>
                        </div>
                        <div class="sc2__task-status" data-check-action="check-ingroup">
                            <?php echo $txr; ?>
                        </div>
                    </div>
                    <?php
                    $checkr = get_field('task_subscribe_sendler', 'user_'.get_current_user_id());
                    if ($checkr) {
                        $cls = 'task-finished';
                        $txr = 'Начислено';
                    } else {
                        $cls = 'task-not-finished';
                        $txr = 'Готово';
                    }
                    ?>
                    <div class="flex-row sc2__task <?php echo $cls; ?>">
                        <div class="flex-row sc2__task-name-try">
                            <div class="sc2__task-name">
                                Подпишитесь на <a href="https://vk.com/app5898182_-68535127#s=1411799" target="_blank" style="text-decoration: underline;">рассылку</a>
                            </div>
                            <div class="sc2__task-try">
                                + 1 попытка
                            </div>
                        </div>
                        <div class="sc2__task-status" data-check-action="check-subscribe">
                            <?php echo $txr; ?>
                        </div>
                    </div>
                    <?php
                    $checkr = get_field('task_repost', 'user_'.get_current_user_id());
                    if ($checkr) {
                        $cls = 'task-finished';
                        $txr = 'Начислено';
                    } else {
                        $cls = 'task-not-finished';
                        $txr = 'Готово';
                    }
                    ?>
                    <div class="flex-row sc2__task <?php echo $cls; ?>" data-check-action="check-repost">
                        <div class="flex-row sc2__task-name-try">
                            <div class="sc2__task-name">
                                Сделайте репост о конкурсе ВК
                            </div>
                            <div class="sc2__task-try">
                                + 1 попытка
                            </div>
                        </div>
                        <div class="sc2__task-status">
                            <?php echo $txr; ?>
                        </div>
                    </div>
                    <?php
                    $checkr = get_field('task_gotosite', 'user_'.get_current_user_id());
                    if ($checkr) {
                        $cls = 'task-finished';
                        $txr = 'Начислено';
                    } else {
                        $cls = 'task-not-finished';
                        $txr = 'Готово';
                    }
                    ?>
                    <div class="flex-row sc2__task <?php echo $cls; ?>" data-check-action="goto-site">
                        <div class="flex-row sc2__task-name-try">
                            <div class="sc2__task-name">
                                Переход на <a class="lik-goto" href="https://sushi-master.ru/?utm_source=site&utm_medium=landing&utm_campaign=roulettefortune" target="_blank">сайт</a>
                            </div>
                            <div class="sc2__task-try">
                                + 1 попытка
                            </div>
                        </div>
                        <div class="sc2__task-status">
                            <?php echo $txr; ?>
                        </div>
                    </div>
                    <div class="flex-row sc2__task task-not-finished" data-check-action="check-checks">
                        <div class="flex-row sc2__task-name-try">
                            <div class="sc2__task-name">
                                Загрузите чек
                            </div>
                            <div class="sc2__task-try">
                                + 1 попытка
                            </div>
                        </div>
                        <div class="sc2__task-status">
                            Загрузить
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; endif; ?>
<?php get_footer(); ?>