<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// URL домашней страницы 
$home_url="http://testapi/api/";

// страница указана в параметре URL, страница по умолчанию одна 
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// установка количества записей на странице 
$records_per_page = 10;

// расчёт для запроса предела записей 
$from_record_num = ($records_per_page * $page) - $records_per_page;

// параметры сортировки
$sort = array('ASC', 'DESC');
$sort_field = array('rating', 'create');

// опциональные параметры поиска
$search_fields = array('description', 'allphoto');

?>