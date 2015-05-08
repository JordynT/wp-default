<?php


// ** MySQL settings ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress_default');

/** MySQL database username */
define('DB_USER', 'wp');

/** MySQL database password */
define('DB_PASSWORD', 'wp');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('AUTH_KEY',         'rH}&N%#w!KE[YUd?M5Ose}uVh&T|91izPZul~xTqUe|l_BtmCb%dx0C[^no&`{oG');
define('SECURE_AUTH_KEY',  'FST%_r?-q2B`2ySlQ!yw[{+<agk<{D Wsa|U @+(TXC?QP21ve+Y$+x+7x<m`K:f');
define('LOGGED_IN_KEY',    'Hm8Jkb7)&Ql1rj)gbi@?[aqCS,>Y){{5Lc$iZ+LJ;AU8u:,2c<.O+Wl;;;<&MMoD');
define('NONCE_KEY',        'e?onEAmV0<AIK U?/4MHQ(Ql!o-M8_f9>|f$&xDm(+8LCE6pB:u2lBKJ}Iw*-I!%');
define('AUTH_SALT',        '}IKeFj8!-/:~{CG2ojSy,:<`y!=IP,dfpH6-d|OaSfPOa<?hKLqvIiOf&es6HS`1');
define('SECURE_AUTH_SALT', 'PE8E]=N[swFl`w|88,ED#xQU#<#B0!$?fx;uT=+*Wme$Q&9D7*3K]h;MOTVt</zA');
define('LOGGED_IN_SALT',   '7WF+LtF]8HPNn@Y=3ePQktw:!8z?:/DZc}aZjMymo/,Po,34Tvp/_MrY_s:(iJN1');
define('NONCE_SALT',       'yWJD= tA[a!x:Sm4.%K Ziq-!~L-  ]({y|8VvJg253=A,Tpm=?Uq2Mf491zQEHu');


$table_prefix = 'wp_';


// Match any requests made via xip.io.
if ( isset( $_SERVER['HTTP_HOST'] ) && preg_match('/^(local.wordpress.)\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}(.xip.io)\z/', $_SERVER['HTTP_HOST'] ) ) {
	define( 'WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] );
	define( 'WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] );
}

define( 'WP_DEBUG', true );



/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
