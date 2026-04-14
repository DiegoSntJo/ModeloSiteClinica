<?php

function clinic_get_database_config()
{
	$config = [
		'auth' => [
			'host' => 'localhost',
			'database' => 'projeto_login',
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8mb4',
		],
		'appointments' => [
			'host' => 'localhost',
			'database' => 'projeto_tabela',
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8mb4',
		],
	];

	$overridePath = __DIR__ . '/database.local.php';
	if (file_exists($overridePath)) {
		$override = require $overridePath;

		if (is_array($override)) {
			foreach ($override as $connectionName => $connectionConfig) {
				if (!isset($config[$connectionName]) || !is_array($connectionConfig)) {
					continue;
				}

				$config[$connectionName] = array_merge($config[$connectionName], $connectionConfig);
			}
		}
	}

	return $config;
}

function clinic_get_connection_config($connectionName)
{
	$config = clinic_get_database_config();

	if (!isset($config[$connectionName])) {
		throw new RuntimeException('Configuracao de banco invalida: ' . $connectionName);
	}

	return $config[$connectionName];
}

function clinic_create_pdo($connectionName)
{
	$config = clinic_get_connection_config($connectionName);
	$dsn = sprintf(
		'mysql:host=%s;dbname=%s;charset=%s',
		$config['host'],
		$config['database'],
		$config['charset']
	);

	return new PDO(
		$dsn,
		$config['username'],
		$config['password'],
		[
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		]
	);
}

function clinic_create_mysqli($connectionName)
{
	$config = clinic_get_connection_config($connectionName);
	$mysqli = new mysqli(
		$config['host'],
		$config['username'],
		$config['password'],
		$config['database']
	);

	if ($mysqli->connect_errno) {
		throw new RuntimeException('Falha na conexao: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
	}

	$mysqli->set_charset($config['charset']);

	return $mysqli;
}