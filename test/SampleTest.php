<?php

namespace test;

use Database;
use Exception;
use PDO;
use PHPUnit\Framework\TestCase;

class SampleTest extends TestCase
{
    private static string $db_host = 'localhost';
    private static string $db_username = 'root';
    private static string $db_password = '';
    private static string $db_name = 'quera';

    private static PDO $db;

    private static bool $initialized = false;


    public static function setUpBeforeClass(): void
    {
        if (self::$initialized) {
            return;
        }
        require_once __DIR__ . '/../Database.php';
        self::$db = new PDO('mysql:host=' . self::$db_host, self::$db_username, self::$db_password);
        self::$db->exec('DROP DATABASE IF EXISTS ' . self::$db_name);
        self::$db->exec('CREATE DATABASE ' . self::$db_name);
        self::$initialized = true;
    }

    public function testGetInstanceExists()
    {
        $this->assertTrue(method_exists(Database::class, 'getInstance'));
    }

    public function testSingletonReturnsAnInstanceOfClass(){
        $sample_class_instance = Database::getInstance();
        $this->assertInstanceOf(PDO::class, $sample_class_instance);
    }
}