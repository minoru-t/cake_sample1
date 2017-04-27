<?php
/**
 * CakePHP実行環境クラス
 * 
 * @author Minoru Tanaka. - #4786
 */
class CakeEnv {
    /** 環境種別：ローカル */
    const ENV_LOCAL = 'local';
    /** 環境種別：開発環境（サーバ） */
    const ENV_DEV = 'develop';
    /**
     * 環境情報を読み込む
     * @return string 環境種別文字列
     */
    public static function load() {
        $envs = self::getEnvs();
        $targetEnv = '';
        foreach ($envs as $env) {
            $path = ROOT . DS . 'config' . DS . 'env' . DS . $env;
            if (is_file($path)) {
                $targetEnv = $env;
                break;
            }
        }
        // 環境未設定の場合は例外を発生させる
        if (empty($targetEnv)) {
            throw new Exception("The environment isn\'t established. Please put a file with the environment name in the [config/env].");
        }
        return $targetEnv;
    }
    /**
     * 環境種別を取得する
     * @return array 環境種別配列
     */
    private static function getEnvs() {
        return array(
            self::ENV_LOCAL,
            self::ENV_DEV,
        );
    }
}