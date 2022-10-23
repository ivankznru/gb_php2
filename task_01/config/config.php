<?php


/* DB config */ // данные для подключения к базе данных
const HOST = 'localhost'; //где находится база данных
const USER = 'root'; // имя пользователя
const PASS = 'root'; // пароль
const DB = 'geek_brains'; // название базы данных

const TWIG_DIR = 'Twig'; // путь к twig
const LIB_DIR = 'engine'; // путь к папке engine (папка с логикой сайта)
const TRAITS_DIR = LIB_DIR . '/traits'; // путь к папке traits

require_once(LIB_DIR . '/lib_autoload.php'); // подключение к файлу ../engine/lib_autoload.php



