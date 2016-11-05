<?php
/**
 * Created by PhpStorm.
 * User: zoco
 * Date: 16/10/31
 * Time: 14:20
 */

namespace Yezuozuo\Coverage;

/**
 * Class Injecter
 *
 * @package Yezuozuo\Coverage
 */
class Injecter {

    /**
     * @var
     */
    public static $callback;

    /**
     * $logDir 覆盖率日志目录
     * $ignoreFiles 需要忽略的目录、文件列表
     * $repeat 是否累加测试（累加测试期间，代码文件不应该变动，否则影响覆盖率行的判断）
     *
     * @param array $config
     */
    public static function Inject($config = []) {
        $logDir     = isset($config['log_dir']) ? $config['log_dir'] : '';
        $ignoreFile = isset($config['ignore_file']) ? $config['ignore_file'] : '';
        $isRepeat   = isset($config['is_repeat']) ? $config['is_repeat'] : false;

        if (!is_writable($logDir)) {
            echo('php-coverage config error ：log dir "<u>' . $logDir . '</u>" can not be null and must be writable !');
            exit(0);
        }

        if (!empty($ignoreFile) && !file_exists($ignoreFile)) {
            echo('php-coverage config error ：ignore file "<u>' . $ignoreFile . '</u>" is not exists !');
            exit(0);
        }

        if (!$isRepeat) {
            clearDir($config['log_dir']);
        }

        if (function_exists('xdebug_start_code_coverage')) {
            xdebug_start_code_coverage();
            register_shutdown_function("Yezuozuo\\Coverage\\Injecter::gather", $logDir, $ignoreFile);
        } else {
            echo('PHPCoverage config error ：xdebug unreachable !');
            exit(0);
        }
    }

    /**
     * @param $logDir
     * @param $ignoreFile
     */
    public static function gather($logDir, $ignoreFile) {
        $coverageData = xdebug_get_code_coverage();
        xdebug_stop_code_coverage();
        $coverageFile = sprintf('%s/%s.coverage', $logDir, uniqid());
        file_put_contents($coverageFile, json_encode($coverageData));
        self::reporter($logDir, $ignoreFile);
    }

    /**
     * @param $logDir
     * @param $ignoreFile
     */
    private static function reporter($logDir, $ignoreFile) {
        require_once 'Reporter.php';
        $reporter = new Reporter($logDir, $ignoreFile);
        $reporter->report();
    }
}