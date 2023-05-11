<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $itemController->edit(1)

use App\Controller\AmeriqueController;

return [
    '' => ['HomeController', 'index',],
    'survivants' => ['SurvivantController', 'index',],
    'admin' => ['AdminController', 'index'],
    'admin/amerique' => ['AdminAmeriqueController', 'index',],
    'amerique/add' => ['AdminAmeriqueController', 'add'],
    'amerique/edit' => ['AdminAmeriqueController', 'edit', ['id']],
    'amerique/delete' => ['AdminAmeriqueController', 'delete', ['id']],
    'asie/index' => ['AdminAsieController','index',],
    'asie/add' => ['AdminAsieController', 'add'],
    'asie/edit' => ['AdminAsieController', 'edit', ['id']],
    'asie/delete' => ['AdminAsieController', 'delete', ['id']],
    'login' => ['AdminController', 'login'],
    'logout' => ['AdminController', 'logout'],
    'items' => ['ItemController', 'index',],
    'items/edit' => ['ItemController', 'edit', ['id']],
    'items/show' => ['ItemController', 'show', ['id']],
    'items/add' => ['ItemController', 'add',],
    'items/delete' => ['ItemController', 'delete',],
    'amerique' => ['AmeriqueController', 'index'],
    'amerique/index' => ['AdminAmeriqueController','index',],
    'europe' => ['EuropeController', 'index'],
    'asie' => ['AsieController', 'index']
];
