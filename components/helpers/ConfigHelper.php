<?php

namespace app\components\helpers;

use Dotenv\Dotenv;
use RuntimeException;
use yii\db\Connection;

final class ConfigHelper
{
    public const ENV_WEB = 'web';
    public const ENV_TEST = 'test';
    public const ENV_CONSOLE = 'console';

    public const DB_TYPE_MSSQL = 'mssql';
    public const DB_TYPE_MYSQL = 'mysql';

    /**
     * Загружает `.env` файл
     *
     * Если окружение "web", то загружает файл `.env`, иначе - `.env.<суффикс>`
     *
     * @param string $env Текущее окружение
     */
    public static function load(string $env = self::ENV_WEB): void
    {
        $filename = '.env';
        if ($env !== self::ENV_WEB) {
            $filename .= ".$env";
        }

        $dotenv = Dotenv::createImmutable(__DIR__ . '/../..', $filename);
        $dotenv->load();
    }

    /**
     * Создает параметры конфигурации для подключения к БД средствами Yii2
     *
     * @param string      $dbName
     * @param string|null $type `ConfigHelper::ENV_*`. Если `null`, то значение берется из
     *                          переменных окружения
     *
     * @return array
     */
    public static function createDbConfig(string $dbName, ?string $type = null): array
    {
        if (!$type) {
            $type = (string)$_ENV['DB_TYPE'];
        }

        return [
            'class' => Connection::class,
            'dsn' => self::generateDsn($type, $dbName),
            'username' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASSWORD'],
            'charset' => 'utf8',
        ];
    }

    /**
     * Создает DSN строку для подключения в БД в нужном формате
     *
     * @param string $type `ConfigHelper::DB_TYPE_*`
     * @param string $dbName
     *
     * @return string
     */
    private static function generateDsn(string $type, string $dbName): string
    {
        if ($type === self::DB_TYPE_MSSQL) {
            return "sqlsrv:Server={$_ENV['DB_HOST']};Database=$dbName";
        }

        if ($type === self::DB_TYPE_MYSQL) {
            return "mysql:host={$_ENV['DB_HOST']};dbname=$dbName";
        }

        throw new RuntimeException('Данный тип БД не поддерживается');
    }
}
