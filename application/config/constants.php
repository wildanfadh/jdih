<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
defined('SHOW_DEBUG_BACKTRACE') or define('SHOW_DEBUG_BACKTRACE', TRUE);

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
defined('FILE_READ_MODE')  or define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') or define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   or define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  or define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           or define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     or define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       or define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  or define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   or define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              or define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            or define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       or define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

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
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        or define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          or define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         or define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   or define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  or define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') or define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     or define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       or define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      or define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      or define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

defined('LAYOUT_WEB')       or define('LAYOUT_WEB', "LWE");
defined('LAYOUT_DASHBOARD') or define('LAYOUT_DASHBOARD', "LDA");

defined('PROK_DAERAH')  or define('PROK_DAERAH', "PROKUM_DAERAH");
defined('PROK_PUSAT')   or define('PROK_PUSAT', "PROKUM_PUSAT");
defined('PROK_NON')     or define('PROK_NON', "PROKUM_NON");

defined('TIPE_1')   or define('TIPE_1', "PROKUM");
defined('TIPE_2')   or define('TIPE_2', "BAGKUM");
defined('TIPE_3')   or define('TIPE_3', "DOKKUM");
defined('TIPE_4')   or define('TIPE_4', "SURAT");

defined('POS_KEPALA')   or define('POS_KEPALA', 1);
defined('POS_SUB')      or define('POS_SUB', 2);
defined('POS_STAFF')    or define('POS_STAFF', 3);
defined('POS_WAKIL')    or define('POS_WAKIL', 4);

defined('COUN_LACAK')   or define('COUN_LACAK', 1);

// PERMANENT CONSTANT
defined('PERM_ADM')         or define('PERM_ADM', 1);
defined('PERM_PERUNDANGAN') or define('PERM_PERUNDANGAN', 2);
defined('PERM_BANKUM')      or define('PERM_BANKUM', 3);
defined('PERM_DOKUM')       or define('PERM_DOKUM', 4);
defined('PERM_KABAG')       or define('PERM_KABAG', 5);
defined('PERM_SKPD')        or define('PERM_SKPD', 6);
defined('PERM_ASISTEN')     or define('PERM_ASISTEN', 7);
defined('PERM_SEKDA')       or define('PERM_SEKDA', 8);
defined('PERM_WALIKOTA')    or define('PERM_WALIKOTA', 9);
defined('PERM_RESEPSIONIS') or define('PERM_RESEPSIONIS', 10);

defined('JENP_PERWALI') or define('JENP_PERWALI', 1);
defined('JENP_KEPWALI') or define('JENP_KEPWALI', 2);
defined('JENP_KEPSEK')  or define('JENP_KEPSEK', 3);
defined('JENP_INWALI')  or define('JENP_INWALI', 4);
defined('JENP_SE')      or define('JENP_SE', 5);

defined('PENGAJUAN_MASUK')      or define('PENGAJUAN_MASUK', 0);
defined('PENGAJUAN_TERIMA')     or define('PENGAJUAN_TERIMA', 1);
defined('PENGAJUAN_KEMBALI')    or define('PENGAJUAN_KEMBALI', 2);
defined('PENGAJUAN_PROSES')     or define('PENGAJUAN_PROSES', 3);
defined('PENGAJUAN_TERUS')      or define('PENGAJUAN_TERUS', 4);

defined('PENYUSUNAN_DRAFT')     or define('PENYUSUNAN_DRAFT', 0);
defined('PENYUSUNAN_PROSES')    or define('PENYUSUNAN_PROSES', 1);
defined('PENYUSUNAN_KEMBALI')   or define('PENYUSUNAN_KEMBALI', 2);
defined('PENYUSUNAN_SIAP')      or define('PENYUSUNAN_SIAP', 3);

defined('SYSTEM_ADD')       or define('SYSTEM_ADD', 1);
defined('SYSTEM_UPDATE')    or define('SYSTEM_UPDATE', 2);
defined('SYSTEM_DELETE')    or define('SYSTEM_DELETE', 3);

defined('DUM_ASISTEN')  or define('DUM_ASISTEN', 97);
defined('DUM_SEKDA')    or define('DUM_SEKDA', 98);
defined('DUM_WALIKOTA') or define('DUM_WALIKOTA', 99);

defined('JENIS_PERDA')  or define('JENIS_PERDA', 1);
defined('JENIS_PERWALI')    or define('JENIS_PERWALI', 2);
defined('JENIS_KEP_WALI') or define('JENIS_KEP_WALI', 3);
defined('JENIS_INS_WALI') or define('JENIS_INS_WALI', 4);

// STATUS PENGAJUAN
defined('STAT_UMASUK')      or define('STAT_UMASUK', "Usulan Masuk");
defined('STAT_UKEMBALI')    or define('STAT_UKEMBALI', "Usulan Dikembalikan");
defined('STAT_UDISPOSISI')  or define('STAT_UDISPOSISI', "Proses Disposisi Kabag");
defined('STAT_UDRAFTING')   or define('STAT_UDRAFTING', "Proses Drafting Kasubbag");

// STATUS PENYUSUNAN
defined('STAT_PPROSES')     or define('STAT_PPROSES', "Proses Kasubag");
defined('STAT_PTIDAK')      or define('STAT_PTIDAK', "Prokum Tidak Bisa Diproses");
defined('STAT_PKABAG')      or define('STAT_PKABAG', "Proses Paraf Kabag");
defined('STAT_PASISTEN')    or define('STAT_PASISTEN', "Proses Paraf Asisten");
defined('STAT_PSEKDA')      or define('STAT_PSEKDA', "Proses Paraf/Tanda Tangan Sekda");
defined('STAT_PWALIKOTA')   or define('STAT_PWALIKOTA', "Proses Tanda Tangan Walikota");
defined('STAT_PREGISTER')   or define('STAT_PREGISTER', "Proses Register Prokum");
defined('STAT_PSIAP')       or define('STAT_PSIAP', "Prokum Siap Diambil");
defined('STAT_PDIAMBIL')    or define('STAT_PDIAMBIL', "Prokum Sudah Diambil");

// SETTING NAV
defined('NAVP_MENU_WEB')      or define('NAVP_MENU_WEB', 1);
defined('NAVP_PENGATURAN')    or define('NAVP_PENGATURAN', 2);
defined('NAVP_DOKUM')         or define('NAVP_DOKUM', 3);
defined('NAVP_PROKUM')        or define('NAVP_PROKUM', 4);
defined('NAVP_REPORT')        or define('NAVP_REPORT', 5);
defined('NAVP_KONSULTASI')    or define('NAVP_KONSULTASI', 6);

defined('NAVC_DASHBOARD')   or define('NAVC_DASHBOARD', "dashboard");
defined('NAVC_MENU_WEB_1')  or define('NAVC_MENU_WEB_1', "menu/text_jalan");
defined('NAVC_MENU_WEB_2')  or define('NAVC_MENU_WEB_2', "setting/profil");
defined('NAVC_MENU_WEB_3')  or define('NAVC_MENU_WEB_3', "setting/agenda");
defined('NAVC_MENU_WEB_4')  or define('NAVC_MENU_WEB_4', "setting/tupoksi");

defined('NAVC_PENGATURAN_1') or define('NAVC_PENGATURAN_1', "user");
defined('NAVC_PENGATURAN_2') or define('NAVC_PENGATURAN_2', "setting/lemari");

defined('NAVC_DOKUM_1') or define('NAVC_DOKUM_1', "prokum?tipe=prokum_daerah");
defined('NAVC_DOKUM_2') or define('NAVC_DOKUM_2', "prokum?tipe=prokum_pusat");
defined('NAVC_DOKUM_3') or define('NAVC_DOKUM_3', "prokum?tipe=prokum_non");

defined('NAVC_PROKUM_1') or define('NAVC_PROKUM_1', "pengajuan");
defined('NAVC_PROKUM_2') or define('NAVC_PROKUM_2', "pengajuan/penyusunan_list");

defined('NAVC_REPORT_1') or define('NAVC_REPORT_1', "pengajuan/report");
defined('NAVC_REPORT_2') or define('NAVC_REPORT_2', "pengajuan/penyusunan_report_list");

defined('NAVC_KONSULTASI') or define('NAVC_KONSULTASI', "konsultasi");


// Constant For Status Konsultasi
defined('BELUM_DIBALAS') or define('BELUM_DIBALAS', 0);
defined('SUDAH_DIBALAS') or define('SUDAH_DIBALAS', 1);
defined('KONFIRMASI_SELESAI') or define('KONFIRMASI_SELESAI', 0);
defined('BELUM_KONFIRMASI') or define('BELUM_KONFIRMASI', 3);
defined('VALUE_STATUS') or define('VALUE_STATUS', 1);


defined('STATUS_KOSONG') or define('STATUS_KOSONG', 0);
defined('STATUS_DIKONFIRMASI') or define('STATUS_DIKONFIRMASI', 1);
defined('STATUS_DIBATALKAN') or define('STATUS_DIBATALKAN', 2);
defined('STATUS_MASUK') or define('STATUS_MASUK', 3);
