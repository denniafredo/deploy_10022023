<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
define('EXIT_SUCCESS', 0); // no errors
define('EXIT_ERROR', 1); // generic error
define('EXIT_CONFIG', 3); // configuration error
define('EXIT_UNKNOWN_FILE', 4); // file not found
define('EXIT_UNKNOWN_CLASS', 5); // unknown class
define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
define('EXIT_USER_INPUT', 7); // invalid user input
define('EXIT_DATABASE', 8); // database error
define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


/*
|--------------------------------------------------------------------------
| Custom const
|--------------------------------------------------------------------------
|
| This your custom const
|
*/
//define('C_URL_API_JAIM', 'http://192.168.2.7/jaim');
//define('C_URL_API_JAIM', 'http://192.168.1.10:7780/api/jaim');
define('C_URL_API_JAIM', 'https://aims.ifg-life.id/api/jaim');
define('C_URL_API_OTP', 'http://smsgw.ifg-life.id:8080');
define('C_URL_API', 'api/jsspaj');
define('C_URL_API_CURL', 'https://aims.ifg-life.id/api/jsspaj');
define('C_ROWS_PAGINATION', 10); // change also in config pagination
define('C_GRUP_KUESIONER', 1);
define('C_USER_OTP', 'jiwasraya');
define('C_PASS_OTP', '1212');


define('C_PAGE_JUMLAH', 10);
define('C_PAGE_JUMLAH_LINK', 3);


define('C_STATUS_GAGAL_LOGIN_USERNAME',     'gagal-login-username');
define('C_STATUS_GAGAL_LOGIN_PASSWORD',     'gagal-login-password');
define('C_STATUS_GAGAL_LOGIN_NONAKTIF',     'gagal-login-nonaktif');
define('C_STATUS_GAGAL_RESET_NOAGEN',       'gagal-reset-noagen');
define('C_STATUS_GAGAL_RESET_EMAIL',        'gagal-reset-email');
define('C_STATUS_SUKSES_RESET_SANDI',       'sukses-reset-sandi');
define('C_STATUS_GAGAL_EMAIL_SANDI_KOSONG', 'gagal-email-sandi-kosong');


define('C_PESAN_GAGAL_LOGIN_USERNAME', '<strong>Oh Tidak!</strong> Username tidak ditemukan.');
define('C_PESAN_GAGAL_LOGIN_PASSWORD', '<strong>Oh Tidak!</strong> Password salah.');
define('C_PESAN_GAGAL_LOGIN_NONAKTIF', '<strong>Oh Tidak!</strong> Username tidak aktif.');


define('C_MENU_FRONTEND', 1);
define('C_MENU_BACKEND', 2);
define('C_MENU_EVALUASI_WILAYAH', 'MN15070001');
define('C_MENU_EVALUASI_CABANG', 'MN15060007');
define('C_MENU_EVALUASI_AGEN', 'MN15060008');
define('C_MENU_EPKAJ', 'MN18040001');
define('C_MENU_DOWNLOAD_EVALUASI_AGEN_SE_KAPUS', 'MN16090001');
define('C_MENU_PENDAPATAN_AGEN_SE_WILAYAH', 'MN15090002');
define('C_MENU_PENDAPATAN_AGEN_SE_CABANG', 'MN15090001');
define('C_MENU_PENDAPATAN_AGEN', 'MN15060009');
define('C_MENU_AGENDA_SAYA', 'MN15060013');
define('C_MENU_AGENDA_BINAAN', 'MN15060014');
define('C_MENU_PROSPEK_SAYA', 'MN21070001'); //MN15060015
define('C_MENU_PROSPEK_BINAAN', 'MN15060016');
define('C_MENU_PROSPEK_NASABAH', 'MN15060017');
define('C_MENU_ULANGTAHUN_NASABAH', 'MN15060018');
define('C_MENU_JATUHTEMPO_BENEFIT', 'MN15060019');
define('C_MENU_JATUHTEMPO_PREMI', 'MN15120001');
define('C_MENU_AGENDA_AGEN_SE_CABANG', 'MN15060020');
define('C_MENU_AGENDA_AGEN_SE_WILAYAH', 'MN15100001');
define('C_MENU_PROSPEK_AGEN_SE_CABANG', 'MN15060021');
define('C_MENU_PROSPEK_AGEN_SE_WILAYAH', 'MN15100002');
define('C_MENU_DOWNLOAD_PROSPEK_AGEN_SE_WILAYAH', 'MN16020001');
define('C_MENU_DOWNLOAD_PROSPEK_AGEN_SE_CABANG', 'MN16020002');
define('C_MENU_DOWNLOAD_PROSPEK_AGEN_SE_KAPUS', 'MN16020003');
define('C_MENU_TOP_REKRUT_AGEN', 'MN15060010');
define('C_MENU_TOP_POLIS_AGEN', 'MN15060011');
define('C_MENU_TOP_PREMI_AGEN', 'MN15060012');
define('C_MENU_PENGATURAN_MENU', 'MN15100004');
define('C_MENU_LEARNING_EBOOK', 'MN15100005');
define('C_MENU_LEARNING_VIDEO', 'MN15100006');
define('C_MENU_LEARNING_ESERTIFIKAT', 'MN18110001');
define('C_MENU_TOP_REKRUT_CABANG', 'MN15100007');
define('C_MENU_TOP_POLIS_CABANG', 'MN15100008');
define('C_MENU_TOP_PREMI_CABANG', 'MN15100009');
define('C_MENU_TOP_REKRUT_WILAYAH', 'MN15100010');
define('C_MENU_TOP_POLIS_WILAYAH', 'MN15100011');
define('C_MENU_TOP_PREMI_WILAYAH', 'MN15100012');
define('C_MENU_KONTES_REWARD_156', 'MN15100017');
define('C_MENU_AKTIVASI_PENJUALAN', 'MN17090001');
define('C_MENU_DOWNLOAD_AKTIVASI_SE_KAPUS', 'MN17090002');
define('C_MENU_DOWNLOAD_AKTIVASI_SE_KANWIL', 'MN17100001');

define('C_MENU_FRONTEND_BODMSG', 'MN15110001');
define('C_MENU_FRONTEND_AOTM', 'MN15110002');
define('C_MENU_FRONTEND_USERAGEN', 'MN16050001');
define('C_MENU_FRONTEND_DASBOR', 'MN16060001');

define('C_STATUS_SUKSES_SIMPAN', 'sukses-simpan');
define('C_STATUS_GAGAL_SIMPAN', 'gagal-simpan');
define('C_STATUS_GAGAL_SIMPAN_KTP', 'gagal-simpan-ktp');
define('C_STATUS_SUKSES_HAPUS', 'sukses-hapus');
define('C_STATUS_GAGAL_HAPUS', 'gagal-hapus');
define('C_STATUS_SUKSES_KIRIM', 'sukses-kirim');
define('C_STATUS_GAGAL_KIRIM', 'gagal-kirim');
define('C_STATUS_GAGAL_UPLOAD', 'gagal-upload');


define('C_BUTTON_DETAIL', 'Detail Rincian');
define('C_BUTTON_BACK', 'Kembali');
define('C_BUTTON_REFRESH', 'Muat Ulang');
define('C_BUTTON_EDIT', 'Ubah');
define('C_BUTTON_DELETE', 'Hapus');
define('C_BUTTON_SEARCH', 'Cari');
define('C_BUTTON_VIEW', 'Lihat');
define('C_BUTTON_ADD', 'Tambah');
define('C_BUTTON_AKTIFKAN', 'Aktifkan');
define('C_BUTTON_DOWNLOAD', 'Unduh');
define('C_BUTTON_UPLOAD', 'Unggah');


define('C_ROLE_AGEN', '1');
define('C_ROLE_KANCAB', '2');
define('C_ROLE_KANWIL', '3');
define('C_ROLE_FRONTEND', '90');
define('C_ROLE_BACKEND', '100');

