<?php
/**
 * Основные параметры WordPress.
 *
 * Этот файл содержит следующие параметры: настройки MySQL, префикс таблиц,
 * секретные ключи и ABSPATH. Дополнительную информацию можно найти на странице
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Кодекса. Настройки MySQL можно узнать у хостинг-провайдера.
 *
 * Этот файл используется скриптом для создания wp-config.php в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать этот файл
 * с именем "wp-config.php" и заполнить значения вручную.
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'college');

/** Имя пользователя MySQL */
define('DB_USER', 'college_admin');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'college12345');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'HFoSk?RC :uS_Z~oX$`z%p0A^=;7<@}WDB/lU-1]oC nv~A+#0%J1vg*0SB`zp0<');
define('SECURE_AUTH_KEY',  'eb%i3-SjSuI&g!hRjN9;8VX?L2olEL`q^%-P0pr7w}VukC/ilR~WZ9z=||Lq`qI3');
define('LOGGED_IN_KEY',    'ASX9hs`,|}fV2LiKWyG95X*W},-u16=Mg3Ku tG1~2Jwy(PA_P{I/=t5yg48vIOG');
define('NONCE_KEY',        'fbk!4D~|dSUQitq|`~+lT6d?7!|U~@+TK5(CV@MYuMF)6W*`>dK^,X$gU.920p=M');
define('AUTH_SALT',        ':w>KWc%2a&x$xJbVIzKGbv-RtCoM,-I=Z.b=#SvX-|~Nbv1xvh2[,-RfaN,e| <d');
define('SECURE_AUTH_SALT', 'lCcwkm,b5ujqBn-2-:!Jm~MK-+pyCvrLU 3&[T[[K-iw4TNe1=e15`u4)Hv}ItO!');
define('LOGGED_IN_SALT',   'B$[@^gJI{MX:n/x-|7fs-E-dw-y}0QfL+hr^|a?>geUa>wp[dl65+/|$}w[&rV[i');
define('NONCE_SALT',       'oS]mHG,4XZKeeyT(@}fkfsr9^.&K,lWZV,4 &n|P2Ps}^*|B*|S@AuX8h+-z7Tvb');

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
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
