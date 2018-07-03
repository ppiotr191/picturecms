<?php

namespace app\modules\profile;
use Yii;

/**
 * profile module definition class
 */
class ProfileModule extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\profile\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }
    public function registerTranslations()
    {
        Yii::$app->i18n->translations['modules/profile/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => '',
            'basePath' => '@app/modules/profile/messages',
            'fileMap' => [
                'modules/profile/main' => 'main.php',
                'modules/profile/form' => 'form.php',
            ],
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/profile/' . $category, $message, $params, $language);
    }
}
