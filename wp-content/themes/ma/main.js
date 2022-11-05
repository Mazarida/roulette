jQuery(function($){
    if (window.outerWidth > 1020) {
        $('meta[name="viewport"]').replaceWith($('<meta name="viewport" content="width=device-with" />'));
    }
    showError = function (errtext, title = "Упс! Задание не выполнено.") {
        $('.modal-alert').removeClass('modal-success');
        $('.modal-alert').addClass('modal-failure');
        $('.modal-alert .upload-headr').html(title);
        $('.modal-alert .modal-txtd').html(errtext);
        $('.typical-modal').removeClass('typical-modal-active');
        $('.modal-alert').addClass('typical-modal-active');
    };
    showInfo = function (infotext, title = "Супер!") {
        $('.modal-alert').removeClass('modal-failure');
        $('.modal-alert').addClass('modal-success');
        $('.modal-alert .upload-headr').html(title);
        $('.modal-alert .modal-txtd').html(infotext);
        $('.typical-modal').removeClass('typical-modal-active');
        $('.modal-alert').addClass('typical-modal-active');
    };

    $('body').on('click', '.login__header', function (e) {
        e.preventDefault();
        $('.typical-modal').removeClass('typical-modal-active');
        $('.modal-auth').addClass('typical-modal-active');
    });

    $('body').on('click', '[data-check-action="check-checks"],.txhist,.tx-legend', function (e) {
        e.preventDefault();
        $('.typical-modal').removeClass('typical-modal-active');
        $('.modal-uploadr').addClass('typical-modal-active');
    });

    $('body').on('click', '.mypcodes', function (e) {
        e.preventDefault();
        $('.typical-modal').removeClass('typical-modal-active');
        $('.modal-pcodey').addClass('typical-modal-active');
    });

    $('body').on('click', '.typical-modal-overlay,.modal-xcross', function (e) {
        e.preventDefault();
        $('.typical-modal').removeClass('typical-modal-active');
    });

    $('body').on('click', '.promocodey-wrapper', function (e) {
        e.preventDefault();
        let copid = $(this).find('.copied-success');
        let copyText = $(this).find('.promocodeyin')[0];
        copid.addClass('active-copid');
        setTimeout(function () {
            copid.removeClass('active-copid');
        }, 1000);
        copyText.select();
        document.execCommand("copy");
    });

    $('body').on('click', '.wheel-overlay', function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            data: {
                actiond: 'round-wheel',
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                if (data.success) {
                    $('.tries-count').html(data.tries_left);
                    $('.pcodes-wrapd').html(data.pcodes_html);
                    let prizeNmae = $('.pcodes-wrapd .tx-hist-row:first-child .prix-namd').html();
                    let promoCodd = '<span class="promocodey-wrapper">'+$('.pcodes-wrapd .tx-hist-row:first-child .promocodey-wrapper').html()+'</span>';
                    let pcodeTxt = 'Вы выиграли <span class="accent-modal">' + prizeNmae + '</span>. <br>' +
                        promoCodd +
                        '<div class="greener dsh mypcodes">Все мои промокоды</div>';
                    setTimeout(function () {
                        showInfo(pcodeTxt, 'Поздравляем!');
                    }, 11000);
                    $('.wheel-prizes').addClass('no-transition');
                    $('.wheel-prizes').removeClass('prize1');
                    $('.wheel-prizes').removeClass('prize2');
                    $('.wheel-prizes').removeClass('prize3');
                    $('.wheel-prizes').removeClass('prize4');
                    $('.wheel-prizes').removeClass('prize5');
                    $('.wheel-prizes').removeClass('prize6');
                    $('.wheel-prizes').removeClass('prize7');
                    setTimeout(function () {
                        $('.wheel-prizes').removeClass('no-transition');
                    }, 10);
                    setTimeout(function () {
                        $('.wheel-prizes').addClass('prize'+data.prize);
                    }, 20);
                } else {
                    showError(data.error_mess, "Упс! Что-то пошло не так.");
                }
            },
        });
    });

    $('body').on('click', '.green-accept', function (e) {
        e.preventDefault();
        let uid = $(this).closest('.moder-item').attr('data-uid');
        let modeItem = $(this).closest('.moder-item');
        $.ajax({
            type: "POST",
            data: {
                actiond: 'green-accept',
                uid: uid,
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                if (data.success) {
                    modeItem.hide("slow");
                    console.log("Успешно одобрено");
                }  else {
                    showError(data.error_mess, "Упс! Что-то пошло не так.");
                }
            },
        });
    });

    $('body').on('click', '.red-decline', function (e) {
        e.preventDefault();
        let uid = $(this).closest('.moder-item').attr('data-uid');
        let comment = $(this).closest('.moder-item').find('.why-declined').val().trim();
        let modeItem = $(this).closest('.moder-item');
        $.ajax({
            type: "POST",
            data: {
                actiond: 'red-decline',
                uid: uid,
                comment: comment,
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                if (data.success) {
                    modeItem.hide("slow");
                    console.log("Успешно отклоено");
                } else {
                    showError(data.error_mess, "Упс! Что-то пошло не так.");
                }
            },
        });
    });

    $('body').on('click', '[data-check-action]', function (e) {
        e.preventDefault();
        let action = $(this).attr('data-check-action');
        switch (action) {
            case 'goto-site':
                if (typeof window.visitedSite !== "undefined") {

                    $.ajax({
                        type: "POST",
                        data: {
                            actiond: action,
                        },
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            if (data.success) {
                                $('[data-check-action="'+action+'"]').removeClass('task-not-finished').addClass('task-finished').find('.sc2__task-status').html('Начислено');
                                showInfo("Получена дополнительная попытка");
                            } else {
                                showError(data.error_mess);
                            }
                            $('.tries-count').html(data.tries_left);
                        },
                    });
                } else {
                    showError("Посетите сайт по ссылке", "Не засчитано")
                }
                break;
            case 'check-subscribe':
            case 'check-ingroup':
                $.ajax({
                    type: "POST",
                    data: {
                        actiond: action,
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        if (data.success) {
                            $('[data-check-action="'+action+'"]').removeClass('task-not-finished').addClass('task-finished').find('.sc2__task-status').html('Начислено');
                            showInfo("Получена дополнительная попытка");
                        } else {
                            showError(data.error_mess);
                        }
                        $('.tries-count').html(data.tries_left);
                    },
                });
            break;
            case 'check-repost':

                VK.api("wall.post", {"message": "" +
                        "Я испытал свою удачу в колесе фортуны «Суши Мастер» и выигрываю вкусные призы 😍\n" +
                        "\n" +
                        "А главный приз — iphone 🍎\n" +
                        "\n" +
                        "Переходите по ссылке и выигрывайте вместо со мной 👉" +
                        "",
                    "v":"5.73",
                    "attachments":"photo499174_457240133,https://sushimaster-roulette.ru",
                }, function (data) {
                    if (data && data.response && data.response.post_id) {
                        $.ajax({
                            type: "POST",
                            data: {
                                actiond: action,
                            },
                            dataType: "json",
                            success: function (data) {
                                console.log(data);
                                if (data.success) {
                                    $('[data-check-action="'+action+'"]').removeClass('task-not-finished').addClass('task-finished').find('.sc2__task-status').html('Начислено');
                                    showInfo("Получена дополнительная попытка");
                                } else {
                                    showError(data.error_mess);
                                }
                                $('.tries-count').html(data.tries_left);
                            },
                        });
                    } else {
                        showError("Не удалось подтвердить размещение записи на стене.");
                    }
                });
            break;
            case 'check-checks':
            break;
        }
    });
    $('.lik-goto').click(function (e) {
        e.stopPropagation();
        window.visitedSite = true;
    });
});