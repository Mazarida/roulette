<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'toaster_b1shmstr');

/** Имя пользователя MySQL */
define('DB_USER', 'toaster_b1shmstr');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'a48d1347f');

/** Имя сервера MySQL */
define('DB_HOST', 'sqlnew.101bot.ru');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'x?3ECaab*(RdTQob~]FpKEn^r&er+M4w@rDZRKMmLI1q2;I~GGOPJ!ME{Q3:$~V%');
define('SECURE_AUTH_KEY',  '$7>JsJhmAD=*B@y;uF!x-ZvjYdB&=gAxDVXKG! q#uD&gbw,`2]tci*y8dF~etL,');
define('LOGGED_IN_KEY',    'qPvL{}j.a:C^osW x8r5]TgbmfmL5Xr+>~YsC:Q6a+J/kH+a]L<|C-B,NCT0#[6G');
define('NONCE_KEY',        '4!Uhz}Dks>.b~-m/C=IO*@g2_u%(5:rRW|}jB2=[`Ef~o(F?sw%[rjk[1?g:F{?{');
define('AUTH_SALT',        'Up`O&fHTxOyu<%H&zU>uC_e)ovC~0D4#,}~2-^iWXfsA82~J5S q/ZJF c4?$z?%');
define('SECURE_AUTH_SALT', 'Qt4>G-:]lsvfKF3oq(wJ %4Jk/JV?Po?cjt&*@dC1WshiN<`Xc`_Z3;(kXQ;m{a4');
define('LOGGED_IN_SALT',   '?(sO!uMndv*g+:L##Ln11vaU]B8|)!u8_5[ JfMn|mu!`kO>nNS%Z~+F^&|i(Q?_');
define('NONCE_SALT',       '$3@a*WOxVw}*vTSWyQv{AG9nGL9b^v;X-%l4sAw!(`GVyaBscjgkDL0SNg<RYf_[');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

//define( 'WP_CONTENT_URL', '/assets' );
define( 'WP_DEFAULT_THEME', 'ma' );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
