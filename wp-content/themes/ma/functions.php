<?php
add_action( 'after_setup_theme', 'blankslate_setup' );
function blankslate_setup()
{
    add_theme_support( 'title-tag' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-thumbnails' );
}
add_action( 'wp_enqueue_scripts', 'blankslate_load_scripts' );
function blankslate_load_scripts()
{
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'mamain', get_bloginfo('template_url').'/main.js?t='.time(), array('jquery'), '1.0', true );
}
add_action( 'comment_form_before', 'blankslate_enqueue_comment_reply_script' );
function blankslate_enqueue_comment_reply_script()
{
    if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_filter( 'the_title', 'blankslate_title' );
function blankslate_title( $title ) {
    if ( $title == '' ) {
        return '&rarr;';
    } else {
        return $title;
    }
}
add_filter( 'wp_title', 'blankslate_filter_wp_title' );
function blankslate_filter_wp_title( $title )
{
    return $title . esc_attr( get_bloginfo( 'name' ) );
}
add_filter( 'get_comments_number', 'blankslate_comments_number' );
function blankslate_comments_number( $count )
{
    if ( !is_admin() ) {
        global $id;
        $comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
        return count( $comments_by_type['comment'] );
    } else {
        return $count;
    }
}

add_filter('show_admin_bar', '__return_false');

function my_update_attachment($f,$pid,$t='',$c='') {
    include_once( ABSPATH . 'wp-admin/includes/image.php' );
    wp_update_attachment_metadata( $pid, $f );
    if( !empty( $_FILES[$f]['name'] )) { //New upload
        require_once( ABSPATH . 'wp-admin/includes/file.php' );

        $override['action'] = 'editpost';
        $override['test_form'] = false;
        $file = wp_handle_upload( $_FILES[$f], $override );

        if ( isset( $file['error'] )) {
            return new WP_Error( 'upload_error', $file['error'] );
        }

        $file_type = wp_check_filetype($_FILES[$f]['name'], array(
            'jpg|jpeg' => 'image/jpeg',
            'gif' => 'image/gif',
            'png' => 'image/png',
        ));
        if ($file_type['type']) {
            $name_parts = pathinfo( $file['file'] );
            $name = $file['filename'];
            $type = $file['type'];
            $title = $t ? $t : $name;
            $content = $c;

            $attachment = array(
                'post_title' => $title,
                'post_type' => 'attachment',
                'post_content' => $content,
                'post_parent' => $pid,
                'post_mime_type' => $type,
                'guid' => $file['url'],
            );

            foreach( get_intermediate_image_sizes() as $s ) {
                $sizes[$s] = array( 'width' => '', 'height' => '', 'crop' => true );
                $sizes[$s]['width'] = get_option( "{$s}_size_w" ); // For default sizes set in options
                $sizes[$s]['height'] = get_option( "{$s}_size_h" ); // For default sizes set in options
                $sizes[$s]['crop'] = get_option( "{$s}_crop" ); // For default sizes set in options
            }

            $sizes = apply_filters( 'intermediate_image_sizes_advanced', $sizes );

            foreach( $sizes as $size => $size_data ) {
                $resized = image_make_intermediate_size( $file['file'], $size_data['width'], $size_data['height'], $size_data['crop'] );
                if ( $resized )
                    $metadata['sizes'][$size] = $resized;
            }

            $attach_id = wp_insert_attachment( $attachment, $file['file'] /*, $pid - for post_thumbnails*/);

            if ( !is_wp_error( $attach_id )) {
                $attach_meta = wp_generate_attachment_metadata( $attach_id, $file['file'] );
                wp_update_attachment_metadata( $attach_id, $attach_meta );
            }

            return array(
                'pid' =>$pid,
                'url' =>$file['url'],
                'file'=>$file,
                'attach_id'=>$attach_id
            );
            // update_post_meta( $pid, 'a_image', $file['url'] );
        }
    }
    return false;
}

add_action('init', 'add_new_check_imga');
function add_new_check_imga() {
    if (isset($_FILES['check_image'])) {
        $args = array(
            'post_title' => ''.wp_get_current_user()->first_name.' '.wp_get_current_user()->last_name.' '.date('m.d.Y H:i:s'),
            'post_type' => 'cheki',
            'post_status' => 'publish'
        );
        $chek = wp_insert_post($args);
        $att = my_update_attachment(
            'check_image',
            $chek
        );
        if (is_wp_error($att)) {
            die($att->get_error_message());
        }
        update_field(
            'check_image',
            $att['attach_id'],
            $chek
        );
        update_field(
            'user_id',
            get_current_user_id(),
            $chek
        );
        update_field(
            'txn_id',
            add_tx_log(1, "Загружен чек №".$chek, true),
            $chek
        );
        wp_redirect( get_bloginfo('url').'/?upload-success' );
    }
}

add_action('init', 'try_auth_vk');
function try_auth_vk() {
    //?uid=499174
    //&first_name=Степан
    //&last_name=Алексеев
    //&photo=https%3A%2F%2Fsun9-13.userapi.com%2Fs%2Fv1%2Fif1%2FHPNVIrpnxSTTaOgMvBhly9NRWTP0j7n1i8t22QvGrw26QgGvqDjdAdwM8S7KPtPxRrRYlwY2.jpg%3Fsize%3D200x0%26amp%3Bquality%3D96%26amp%3Bcrop%3D63%2C400%2C951%2C1425%26amp%3Bava%3D1
    //&photo_rec=https%3A%2F%2Fsun9-13.userapi.com%2Fs%2Fv1%2Fif1%2F9CvrhxhGgVPhRju11q-TU-2GasLL0dRFQxaRnPTRZNlriFc4sb3ALEmj5WupbBRDxcHqSyYi.jpg%3Fsize%3D50x0%26amp%3Bquality%3D96%26amp%3Bcrop%3D181%2C419%2C761%2C761%26amp%3Bava%3D1
    //&hash=2a2b6295fb1d2bb26c7b28a432f586ba
    if (isset($_GET['uid'])) {
        $hash = md5('7850467'.$_GET['uid'].'6DeGqHKj4lVVYxhD9DTN');
        if ($hash == $_GET['hash']) {
            $username = 'vk'.$_GET['uid'];
            $password = md5(md5('vk'.$_GET['uid']));
            $email = 'vk'.$_GET['uid'].'@mail.com';
            if (username_exists($username)) {
                $user = get_user_by('login', $username );
                if ( !is_wp_error( $user ) )
                {
                    wp_update_user( [
                        'ID'       => $user->ID,
                        'first_name' => $_GET['first_name'],
                        'last_name' => $_GET['last_name'],
                    ] );
                    update_field('avatar', str_replace('&amp;', '&', urldecode($_GET['photo'])), 'user_'.$user->ID);
                    update_field('avatar2', str_replace('&amp;', '&', urldecode($_GET['photo_rec'])), 'user_'.$user->ID);
                    wp_clear_auth_cookie();
                    wp_set_current_user ( $user->ID );
                    wp_set_auth_cookie  ( $user->ID );

                    wp_redirect( get_bloginfo('url').'/' );
                }
            } else {
                $user_id = wp_create_user( $username, $password, $email );
                $user = get_user_by( 'id', $user_id );
                wp_update_user( [
                    'ID'       => $user->ID,
                    'first_name' => $_GET['first_name'],
                    'last_name' => $_GET['last_name'],
                ] );
                update_field('avatar', str_replace('&amp;', '&', urldecode($_GET['photo'])), 'user_'.$user->ID);
                update_field('avatar2', str_replace('&amp;', '&', urldecode($_GET['photo_rec'])), 'user_'.$user->ID);
                wp_clear_auth_cookie();
                wp_set_current_user ( $user->ID );
                wp_set_auth_cookie  ( $user->ID );

                wp_redirect( get_bloginfo('url').'/' );
            }
        }
        // app_id+user_id+secret_key, например md5(194253766748fTanppCrNSeuYPbA4ENCo)
    }
}

function add_tries($num = 1, $user_id = 0) {
    $tries = 0;
    if ($user_id == 0) {
        $user_id = get_current_user_id();
    }
    if (get_field('tries_wheel', 'user_'.$user_id)) {
        $tries = get_field('tries_wheel', 'user_'.$user_id);
    }
    $tries += $num;
    if ($tries < 0) {
        $tries = 0;
    }
    update_field('tries_wheel', $tries, 'user_'.$user_id);
    return $tries;
}

function remove_tries($num = 1) {
    return add_tries(-$num);
}

function get_tries() {
    return add_tries(0);
}

function add_tx_log($change, $mess, $is_check_tx = false, $user_id = 0) {
    $datetim = date("d.m.Y H:i:s");
    if ($user_id == 0) {
        $user_id = get_current_user_id();
    }
    $post_id = wp_insert_post([
        'post_type' => 'tx_hist',
        'post_title' => $datetim.'|'.$user_id,
        'post_status' => 'publish',
    ]);
    update_field('datetime', $datetim, $post_id);
    update_field('change', $change, $post_id);
    update_field('message', $mess, $post_id);
    update_field('user', $user_id, $post_id);
    update_field('is_check_tx', $is_check_tx ? 'y' : 'n', $post_id);
    return $post_id;
}

add_action('init', 'try_actiond');
function try_actiond() {
    if (isset($_POST['actiond'])) {
        $res = new stdClass();
        $res->success = false;
        switch ($_POST['actiond']) {
            case 'round-wheel':
                $tries = get_tries();
                if ($tries > 0) {
                    $res->success = true;
                    $res->tries_left = remove_tries();
                    $prix = rand(1,7);
                    while ($prix == 2) {
                        $prix = rand(1,7);
                    }
                    $res->prize = $prix;
                    add_promocode($prix);
                    $res->pcodes_html = get_pcodes_html();
                    add_tx_log(-1, "Потрачена попытка, выпал приз #".$prix);
                } else {
                    $res->error_mess = "Недостаточно попыток для вращения";
                }
                break;
            case 'check-ingroup':
                // https://api.vk.com/method/groups.isMember?group_id=81007728&access_token=61d6a460b39bec9f1962f474cb5332cc5f1b4491fc5e4b21ec45c8e8282b133285bbb5754c1a20770247c&user_id=499174&extended=0&v=5.130
                $user = wp_get_current_user();
                $uuid = str_replace('vk', '', $user->user_login);
                $vk_resp = json_decode(file_get_contents("https://api.vk.com/method/groups.isMember?group_id=68535127&access_token=89a56ef085d412a4bb6dbca9e42437860d5900aad99e43def8d897fa49c398313ba9cbdfc932545b76586&user_id=$uuid&extended=0&v=5.130"));
                if ($vk_resp->response) {
                    $task_subscribe = get_field('task_subscribe', 'user_'.get_current_user_id());
                    if ($task_subscribe) {
                        $res->success = false;
                        $res->error_mess = "Вы уже получили награду за подписку";
                    } else {
                        $res->success = true;
                        update_field('task_subscribe', date('Y-m-d H:i:s'), 'user_'.get_current_user_id());
                        add_tries(1);
                        add_tx_log(1, "Получена попытка за задание Подпишитесь на сообщество");
                    }
                } else {
                    $res->success = false;
                    $res->error_mess = "Вы не подписаны на сообщество";
                }
                $res->tries_left = get_tries();
                break;
            case 'check-subscribe':
                // https://api.vk.com/method/groups.isMember?group_id=81007728&access_token=61d6a460b39bec9f1962f474cb5332cc5f1b4491fc5e4b21ec45c8e8282b133285bbb5754c1a20770247c&user_id=499174&extended=0&v=5.130
                $user = wp_get_current_user();
                $uuid = str_replace('vk', '', $user->user_login);
                $params = [
                    'vk_user_id' => $uuid,
                    'vk_group_id' => 68535127,
                    'access_token ' => "d4169048a67f6a6533b44400d68f0c371903c96158c7d198",
                    'v' => 2
                ];

                $myCurl = curl_init();
                curl_setopt_array($myCurl, [
                    CURLOPT_URL => "https://senler.ru/api/subscribers/get/",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => http_build_query($params)
                ]);

                $response = curl_exec($myCurl);
                $vk_resp = json_decode($response);
                if ($vk_resp->items) {
                    $task_subscribe = get_field('task_subscribe_sendler', 'user_'.get_current_user_id());
                    if ($task_subscribe) {
                        $res->success = false;
                        $res->error_mess = "Вы уже получили награду за подписку";
                    } else {
                        $res->success = true;
                        update_field('task_subscribe_sendler', date('Y-m-d H:i:s'), 'user_'.get_current_user_id());
                        add_tries(1);
                        add_tx_log(1, "Получена попытка за задание Подпишитесь на сообщество");
                    }
                } else {
                    $res->success = false;
                    $res->error_mess = "Вы не подписаны на рассылку";
                }
                $res->tries_left = get_tries();
                break;
            case 'goto-site':
                $task_gotosite = get_field('task_gotosite', 'user_'.get_current_user_id());
                if ($task_gotosite) {
                    $res->success = false;
                    $res->error_mess = "Вы уже получили награду за переход на сайт";
                } else {
                    $res->success = true;
                    update_field('task_gotosite', date('Y-m-d H:i:s'), 'user_'.get_current_user_id());
                    add_tries(1);
                    add_tx_log(1, "Получена попытка за задание Переход на сайт");
                }
                break;
            case 'check-repost':
                $task_repost = get_field('task_repost', 'user_'.get_current_user_id());
                if ($task_repost) {
                    $res->success = false;
                    $res->error_mess = "Вы уже получили награду за репост";
                } else {
                    $res->success = true;
                    update_field('task_repost', date('Y-m-d H:i:s'), 'user_'.get_current_user_id());
                    add_tries(1);
                    add_tx_log(1, "Получена попытка за задание Репост");
                }

                break;
            case 'green-accept':
                $uid = $_POST['uid'];
                $p = get_post($uid, ARRAY_A);
                if (!$p) {
                    $res->success = false;
                    $res->error_mess = "Запись не найдена";
                } else {
                    $uid_tx = get_field('txn_id', $uid);
                    $cur_status = get_field('is_approved', $uid);
                    if (in_array($cur_status, ['m', 'n', ''])) {
                        add_tries(1, get_field('user', $uid_tx));
                        add_tx_log('1', "Начислена попытка пользователю ".get_field('user', $uid_tx)." по чеку $uid транзакция ".$uid_tx);
                        update_field('message', "Загружен чек №".$uid_tx, $uid_tx);
                        update_field('tx_approved', 'y', $uid_tx);
                        update_field('is_approved', 'y', $uid);
                        $res->success = true;
                    } else {
                        $res->success = false;
                        $res->error_mess = "Уже одобрено";
                    }
                }
                break;
            case 'red-decline':
                $uid = $_POST['uid'];
                $p = get_post($uid, ARRAY_A);
                if (!$p) {
                    $res->success = false;
                    $res->error_mess = "Запись не найдена";
                } else {
                    $uid_tx = get_field('txn_id', $uid);
                    $cur_status = get_field('is_approved', $uid);
                    if (in_array($cur_status, ['m', 'y', ''])) {
                        if (!$_POST['comment']) {
                            $res->success = false;
                            $res->error_mess = "При отклонении требуется комментарий";
                        } else {
                            update_field('message', "Загружен чек №".$uid_tx.'<br><span class="redo-decline">'.$_POST['comment'].'</span>', $uid_tx);
                            update_field('tx_approved', 'n', $uid_tx);
                            update_field('is_approved', 'n', $uid);
                            $res->success = true;
                        }
                    } else {
                        $res->success = false;
                        $res->error_mess = "Уже отклонено";
                    }
                }
                break;
        }
        die(json_encode($res));
    }
}

function add_promocode($prix, $user = 0) {
    if ($user == 0) {
        $user = get_current_user_id();
    }
    $args = [
        'post_type' => 'promokodiz',
        'posts_per_page' => 1,
        'meta_query'	=> array(
            'relation'		=> 'AND',
            array(
                'key'	  	=> 'got_by_user',
                'value'	  	=> 'n',
                'compare' 	=> '=',
            ),
            array(
                'key'	  	=> 'prize_no',
                'value'	  	=> $prix,
                'compare' 	=> '=',
            ),
        ),
    ];
    $q = new WP_Query($args);
    while ($q->have_posts()) { $q->the_post();
        update_field('got_by_user', 'y');
        update_field('user_id', $user);
        update_field('datetime', date('d.m.Y H:i:s'));
        update_field('timestamp', time());
    } wp_reset_postdata();
}

function get_my_txs() {
    $txs = [];
    $args = [
        'post_type' => 'tx_hist',
        'meta_query'	=> array(
            'relation'		=> 'AND',
            array(
                'key'	  	=> 'user',
                'value'	  	=> get_current_user_id(),
                'compare' 	=> '=',
            ),
        ),
        'posts_per_page' => -1,
    ];
    $q = new WP_Query($args);
    while ($q->have_posts()) {$q->the_post();
        $txs[] = [
            'datetime' => get_field('datetime'),
            'change' => get_field('change'),
            'message' => get_field('message'),
            'is_check_tx' => get_field('is_check_tx'),
            'tx_approved' => get_field('tx_approved'),
        ];
    } wp_reset_postdata();
    return $txs;
}

function get_prizes() {
    global $all_prizes;
    if (isset($all_prizes) && !empty($all_prizes)) {
        return $all_prizes;
    } else {
        $all_prizes = [];
    }
    $args = [
        'post_type' => 'prizees',
        'posts_per_page' => -1,
    ];
    $q = new WP_Query($args);
    while ($q->have_posts()) { $q->the_post();
        $all_prizes [get_field('prize_no')]= [
            'name' => get_the_title(),
            'prize_no' => get_field('prize_no'),
        ];
    } wp_reset_postdata();
    return $all_prizes;
}

function get_my_pcods() {
    $txs = [];
    $args = [
        'post_type' => 'promokodiz',
        'meta_query'	=> array(
            'relation'		=> 'AND',
            array(
                'key'	  	=> 'user_id',
                'value'	  	=> get_current_user_id(),
                'compare' 	=> '=',
            ),
        ),
        'posts_per_page' => -1,
    ];
    $q = new WP_Query($args);
    $prizes = get_prizes();
    while ($q->have_posts()) {$q->the_post();
        $txs[] = [
            'datetime' => get_field('datetime'),
            'timestamp' => get_field('timestamp'),
            'codee' => get_field('codee'),
            'prize_name' => $prizes[get_field('prize_no')]['name'],
            'prize_no' => get_field('prize_no'),
        ];
    } wp_reset_postdata();
    usort($txs, function($a,$b) {
        if ($a['timestamp'] == $b['timestamp']) {
            return 0;
        }
        return ($a['timestamp'] > $b['timestamp']) ? -1 : 1;
    });
    return $txs;
}

function get_pcodes_html() {
    ob_start();
    $my_pcods = get_my_pcods(); ?>
    <?php if (!empty($my_pcods)) { ?>
        <div class="tx-hist-table-wrap">
            <table class="tx-hist-table">
                <tbody>
                <?php foreach ($my_pcods as $my_pcod) { ?>
                    <tr class="tx-hist-row">
                        <td class="tx-hist-col col-datetime"><?=str_replace(' ', '<br>', $my_pcod['datetime'])?></td>
                        <td class="tx-hist-col col-descr">
                            <span class="greener">Вы выиграли!</span> <br>
                            <span class="prix-namd"><?=$my_pcod['prize_name']?></span>
                            <span class="promocodey-wrapper" data-idx="<?=$my_pcod['codee']?>">
                                <input readonly style="position: absolute; opacity: 0;" class="promocodeyin" value="<?=$my_pcod['codee']?>">
                                <span class="promocodey"><?=$my_pcod['codee']?></span>
                                <span class="promocodey-copy">
                                    Скопировать промокод
                                </span>
                                <span class="greener copied-success">Скопировано!</span>
                            </span>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    <?php }
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}