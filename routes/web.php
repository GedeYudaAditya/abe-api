<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', 'login@index');

$router->post('/login/proses', 'login@proseslogin');
$router->get('/login/profile/{id}', 'login@profile');

$router->post('/feedback/create', 'feedbacks@create');

$router->get('/berita/read/{from}/{to}/', 'beritas@read');
$router->get('/berita/search/{from}/{to}/{search}', 'beritas@search');
$router->get('/pengumuman/read/{from}/{to}', 'pengumumans@read');
$router->get('/pengumuman/search/{from}/{to}/{search}', 'pengumumans@search');
$router->get('/notifikasi/read/{id}', 'notifikasis@read');

$router->get('/jenisflashcard/read/', 'jenisflashcards@read');

$router->get('/flashcard/read/{id}/', 'flashcards@read');
$router->get('/flashcard/readone/{id}/', 'flashcards@readOne');

$router->get('/flashcardpengguna/read/{from}/{to}/{id}', 'flashcardpenggunas@read');
$router->post('/flashcardpengguna/create', 'flashcardpenggunas@create');
$router->post('/flashcardpengguna/update', 'flashcardpenggunas@update');
$router->get('/flashcardpengguna/delete/{id}', 'flashcardpenggunas@delete');

$router->post('/flashcardbagikan/createadmin', 'flashcardbagikans@createadmin');
$router->get('/flashcardbagikan/pengguna/read/{from}/{to}/{id}', 'flashcardbagikans@penggunaread');
$router->get('/flashcardbagikan/pengguna/search/{from}/{to}/{id}/{search}', 'flashcardbagikans@penggunasearch');
$router->post('/flashcardbagikan/createuser', 'flashcardbagikans@createuser');

$router->get('/flashcardbagikan/draft/read/{from}/{to}/{id}', 'flashcardbagikans@penggunareaddraft');
$router->get('/flashcardbagikan/draft/accept/{id}', 'flashcardbagikans@penggunadraftacc');
$router->get('/flashcardbagikan/delete/{id}', 'flashcardbagikans@penggunadelete');
$router->get('/flashcardbagikan/terkirim/read/{from}/{to}/{id}', 'flashcardbagikans@penggunareadterkirim');
$router->get('/flashcardbagikan/kiriman/read/{from}/{to}/{id}', 'flashcardbagikans@penggunareadkiriman');

$router->get('/perkembangan/terapis/anak/read/{from}/{to}', 'perkembanganterapis@anakread');
$router->get('/perkembangan/terapis/anak/search/{from}/{to}/{search}', 'perkembanganterapis@anaksearch');
$router->get('/perkembangan/terapis/read/{id}', 'perkembanganterapis@perkembanganread');
$router->get('/perkembangan/{id}', 'perkembanganterapis@perkembanganOneRead');
$router->get('/perkembangan/respon/{id}', 'respons@readorturespon');

$router->post('/perkembangan/terapis/create', 'perkembanganterapis@perkembangancreate');
$router->get('/perkembangan/terapis/delete/{id}', 'perkembanganterapis@perkembangandelete');
$router->post('/perkembangan/terapis/update', 'perkembanganterapis@perkembanganupdate');

$router->get('/perkembangan/orangtua/anak/read/{from}/{to}/{idortu}', 'perkembanganorangtua@anakread');
$router->get('/perkembangan/orangtua/read/{from}/{to}/{id}', 'perkembanganorangtua@perkembanganread');
$router->get('/perkembangan/orangtua/respon/{id}', 'perkembanganorangtua@perkembanganresponread');
$router->post('/perkembangan/orangtua/respon/create', 'respons@ortucreate');

$router->get('/mengurutkan/flashcardtype', 'persamaan@flashcardtype');
$router->get('/mengurutkan/flashcard/{id}', 'persamaan@flashcard');
$router->get('/mengurutkan/flashcardshared/{id}', 'persamaan@flashcardshared');
$router->get('/mengurutkan/myflashcard/{id}', 'persamaan@myflashcard');

$router->post('/diskriminasi/insert', 'diskriminasi@insert');
$router->get('/diskriminasi/read/{id}', 'diskriminasi@read');
$router->get('/diskriminasi/delete/{id}', 'diskriminasi@delete');

$router->get('/appid/insert/{id}/{appid}/{token}', 'apps@insert');

$router->get('/clear-cache', function () {

    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    //    \Illuminate\Support\Facades\Artisan::call('route:cache');
    //    \Illuminate\Support\Facades\Artisan::call('config:cache');
    //    \Illuminate\Support\Facades\Artisan::call('view:clear');
    return "Cache is cleared";
});
