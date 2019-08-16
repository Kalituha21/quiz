<?php

require 'UserRepositoryInterface.php';
require 'EmailInterface.php';
require 'EmailLogService.php';
require 'UserService.php';
require 'UserArrayRepository.php';
require 'UserFileRepository.php';
require 'UserModel.php';

$repository = new UserFileRepository();
$email = new EmailLogService();
$userService = new UserService($repository, $email);
echo '<pre>';
//$user1 = $userService->register('Martiņš');
//$user2 = $userService->register('Jānis');
$user3 = $userService->register('Brut', 'aaa@aa.lv');
print_r($userService->getUsers());
echo '</pre>';