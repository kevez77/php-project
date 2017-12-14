<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Itb\CharacterRepository;
use Itb\ProductRepository;
use Itb\UserRepository;
use Itb\VisitorRepository;
use Itb\StaffRepository;
use Itb\AdminRepository;
;
$clothesRepository = new \Itb\ClothesRepository();
$clothesRepository->dropTableClothes();
$clothesRepository->createClothesTable();
$clothesRepository->insertIntoClothes('homekit','team jersey','50.00');
$clothesRepository->insertIntoClothes('awaykit','team jersey','60.00');
$clothesRepository->insertIntoClothes('thirdkit','team jersey','40.00');

$memberRepository = new \Itb\MemberRepository();
$memberRepository->dropmemberTable();
$memberRepository->creatememberTable();
$memberRepository->insertIntomember('Kevin','male','40');
$memberRepository->insertIntomember('Mary','female','35');

header("location:/index.php");

































