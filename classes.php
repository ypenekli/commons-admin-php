<?php
require_once __DIR__ . "/config.php";

include_once CORE_PACKAGE_ROOT . '/tools/JsonHandler.php';
include_once CORE_PACKAGE_ROOT . '/tools/ClientIP.php';

include_once ADMIN_PACKAGE_ROOT . '/admin/model/AppModel.php';
include_once ADMIN_PACKAGE_ROOT . '/admin/data/App.php';

include_once ADMIN_PACKAGE_ROOT . '/admin/model/AppFuncModel.php';
include_once ADMIN_PACKAGE_ROOT . '/admin/data/AppFunc.php';
include_once ADMIN_PACKAGE_ROOT . '/admin/model/AppVersionModel.php';
include_once ADMIN_PACKAGE_ROOT . '/admin/data/AppVersion.php';

include_once ADMIN_PACKAGE_ROOT . '/admin/model/CommonModel.php';
include_once ADMIN_PACKAGE_ROOT . '/admin/data/Common.php';

include_once ADMIN_PACKAGE_ROOT . '/admin/model/ExportModel.php';
include_once ADMIN_PACKAGE_ROOT . '/admin/data/Export.php';

include_once ADMIN_PACKAGE_ROOT . '/admin/model/GroupModel.php';
include_once ADMIN_PACKAGE_ROOT . '/admin/data/Group.php';
include_once ADMIN_PACKAGE_ROOT . '/admin/data/GroupAppFunc.php';
include_once ADMIN_PACKAGE_ROOT . '/admin/data/GroupAppFuncsHistory.php';
include_once ADMIN_PACKAGE_ROOT . '/admin/data/GroupUser.php';
include_once ADMIN_PACKAGE_ROOT . '/admin/data/GroupUsersHistory.php';

include_once ADMIN_PACKAGE_ROOT . '/admin/model/UserModel.php';
include_once ADMIN_PACKAGE_ROOT . '/admin/data/User.php';
include_once ADMIN_PACKAGE_ROOT . '/admin/data/UserImage.php';
include_once ADMIN_PACKAGE_ROOT . '/admin/data/LoginHistory.php';
include_once ADMIN_PACKAGE_ROOT . '/admin/data/PwdHistory.php';

use com\yp\admin\data\User;
use com\yp\admin\model\UserModel;
use com\yp\admin\data\Group;
use com\yp\admin\model\GroupModel;
use com\yp\admin\data\App;
use com\yp\admin\model\AppModel;
use com\yp\admin\data\AppFunc;
use com\yp\admin\model\AppFuncModel;
use com\yp\admin\model\CommonModel;
use com\yp\admin\data\Common;
use com\yp\admin\data\Export;
use com\yp\admin\model\ExportModel;
use com\yp\admin\data\UserImage;
use com\yp\admin\data\LoginHistory;
use com\yp\admin\data\PwdHistory;
use com\yp\admin\data\AppVersion;
use com\yp\admin\data\GroupAppFunc;
use com\yp\admin\data\GroupAppFuncsHistory;
use com\yp\admin\data\GroupUser;
use com\yp\entity\DataEntity;
use com\yp\admin\data\GroupUsersHistory;
use com\yp\admin\model\AppVersionModel;

$CLASSES =
[
    'DataEntity'=> DataEntity::class,
    
    'App' => App::class,
    'AppModel' => AppModel::class,
    
    'AppFunc' => AppFunc::class,
    'AppFuncModel' => AppFuncModel::class,
    'AppVersion' => AppVersion::class,
    'AppVersionModel'=>AppVersionModel::class,
    
    'Common' => Common::class,
    'CommonModel' => CommonModel::class,
    
    'Export' => Export::class,
    'ExportModel' => ExportModel::class,
    
    'Group' => Group::class,
    'GroupModel' => GroupModel::class,
    'GroupAppFunc' => GroupAppFunc::class,
    'GroupAppFuncsHistory' => GroupAppFuncsHistory::class,
    'GroupUser' => GroupUser::class,
    'GroupUsersHistory' => GroupUsersHistory::class,
    
    'User' => User::class,
    'UserModel' => UserModel::class,
    'UserImage' => UserImage::class,
    'LoginHistory' => LoginHistory::class,
    'PwdHistory' => PwdHistory::class
];  

define('CLASSES', $CLASSES);

