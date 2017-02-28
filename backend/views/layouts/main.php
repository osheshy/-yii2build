<?php
 
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\models\PermisosHelpers;
// use backend\assets\FontAwesomeAsset;
 
/**
 * @var \yii\web\View $this
 * @var string $content
 */
 
AppAsset::register($this);
// FontAwesomeAsset::register($this);

 
?>
 
             <?php $this->beginPage() ?>
            
<!DOCTYPE html>
 
<html lang="<?= Yii::$app->language ?>">
 
<head>
 <meta charset="<?= Yii::$app->charset ?>"/>
    
<meta name="viewport" 
content="width=device-width, 
initial-scale=1">
    
    <?= Html::csrfMetaTags() ?>
    
<title><?= Html::encode($this->title) ?></title>
    
            <?php $this->head() ?>
    
</head>
 
<body>
            <?php $this->beginBody() ?>
 
    <div class="wrap">
    
    
<?php
            
  if (!Yii::$app->user->isGuest) {
  
      $es_admin = PermisosHelpers::requerirMinimoRol('Admin');
 
   NavBar::begin([
 
    'brandLabel' => 'Yii 2 Build Panel de Admin',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
           'class' => 'navbar-inverse navbar-fixed-top',
      ],
  ]);
 
  } else {
   
    NavBar::begin([
 
      'brandLabel' => 'Yii 2 Build <i class="fa fa-plug"></i>',
      'brandUrl' => Yii::$app->homeUrl,
      'options' => [
           'class' => 'navbar-inverse navbar-fixed-top',
      ],
  ]);
 
            
            
  $menuItems = [
      ['label' => 'Home', 'url' => ['site/index']],
  ];
  }
   
  if (!Yii::$app->user->isGuest && $es_admin) {
 
      $menuItems[] = ['label' => 'Usuarios', 'url' => ['user/index']];
            
      $menuItems[] = ['label' => 'Perfiles', 'url' => ['profile/index']];
            
      $menuItems[] = ['label' => 'Roles', 'url' => ['role/index']];
                
      $menuItems[] = ['label' => 'Tipos de Usuario', 'url' => ['user-type/index']];
           
      $menuItems[] = ['label' => 'Estados', 'url' => ['status/index']];
 
   }
  
  if (Yii::$app->user->isGuest) {
 
     $menuItems[] = ['label' => 'Login', 'url' => ['site/login']];
 
  } else {
 
      $menuItems[] = ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                      'url' => ['/site/logout'],
                      'linkOptions' => ['data-method' => 'post']
                ];
 
  } 
                                                                                                                  
  echo Nav::widget([
 
      'options' => ['class' => 'navbar-nav navbar-right'],
      'items' => $menuItems,
 
  ]);
 
  NavBar::end();
 
?>
 
         
<div class="container">
 
<?= Breadcrumbs::widget([
 
    'links' => isset($this->params['breadcrumbs']) ? 
    $this->params['breadcrumbs'] : [],
       
    ])?>
 
<?= $content ?>
 
        </div>
    </div>
 
    <footer class="footer">
 
        <div class="container">
 
        <p class="pull-left">&copy; Yii 2 Build <?= date('Y') ?></p>
 
        <p class="pull-right"><?= Yii::powered() ?></p>
 
        </div>
 
    </footer>
 
            <?php $this->endBody() ?>
 
</body>
</html>
 
<?php $this->endPage() ?>