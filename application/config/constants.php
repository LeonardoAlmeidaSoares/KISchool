<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

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
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

define('CAMINHO_IMAGENS_ICONES', "http://localhost/bancoImagens/icones");

define("CODIGO_ALUNO_EM_AULA_PRESENTE", 1);
define("CODIGO_ALUNO_EM_AULA_AUSENTE", 0);

define("STATUS_ALUNO_CANCELADO", -1);
define("STATUS_ALUNO_CANCELAMENTO_PENDENTE", 0);
define("STATUS_ALUNO_NORMAL", 1);
define("STATUS_ALUNO_FALTOSO", 2);
define("STATUS_ALUNO_ABANDONOU", 3);
define("STATUS_ALUNO_VAGA_LIBERADA", 4);

define("LIMITE_FALTA_ALUNOS_PARA_LIGACAO", 3); //Originalmente, 3
define("LIMITE_FALTA_ALUNOS_PARA_ABANDONO", 5); //Originalmente, 5

define("COD_CARGO_PROFESSOR", 4);

define("COD_STATUS_COMPROVANTE_CRIADO",   1000);
define("COD_STATUS_COMPROVANTE_GERADO",   1001);
define("COD_STATUS_COMPROVANTE_ENTREGUE", 1002);

define("COD_STATUS_OBSERVACAO_CANCELADA", 1000);
define("COD_STATUS_OBSERVACAO_ATIVA", 1001);

define("COD_CONTA_PAGAR_CANCELADA", 1999);
define("COD_CONTA_PAGAR_PAGO", 2000);
define("COD_CONTA_PAGAR_A_VENCER", 2001);
define("COD_CONTA_PAGAR_VENCIDA", 2002);

define("COD_NOTIFICACAO_ABERTA", 1000);
define("COD_NOTIFICACAO_FINALIZADA", 1001);
define("COD_NOTIFICACAO_PENDENTE", 1002);

define("COD_AVALIACAO_MARCADA", 1001);
define("COD_AVALIACAO_ADIADA", 1002);
define("COD_AVALIACAO_EFETUADA", 1003);
define("COD_AVALIACAO_CANCELADA", 1004);

defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
