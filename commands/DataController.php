<?php

namespace app\commands;

use app\models\User;
use app\models\Category;
use app\models\Lot;
use app\models\Bet;
use Yii;
use yii\helpers\BaseInflector;
use yii\console\Controller;
use yii\console\ExitCode;

class DataController extends Controller
{
    const CATEGORIES = [
        [
            'name' => 'Бытовая техника',
            'inner_code' => 'home_appliances'
        ],
        [
            'name' => 'Смартфоны и фототехника',
            'inner_code' => 'smartphones_photo'
        ],
        [
            'name' => 'ТВ, консоли и аудио',
            'inner_code' => 'tv_consoles_audio'
        ],
        [
            'name' => 'ПК, ноутбуки и периферия',
            'inner_code' => 'pc_laptops'
        ],
        [
            'name' => 'Комплектующие для ПК',
            'inner_code' => 'pc_accessories'
        ],
    ];

    const CLOSING_REASONS = [
        ['reason' => 'Your reason'],
        ['reason' => 'Copyright Infringement'],
        ['reason' => 'Terms of Service Infringement'],
    ];

    public function actionImport()
    {
        $entities = [
            'category',
            'closing_reason'
        ];

        foreach ($entities as $entity) {
            $classname = '\app\models\\' . (new BaseInflector())->camelize(ucfirst($entity));
            $entity = (new BaseInflector())->pluralize($entity);
            $entity = strtoupper($entity);

            print($entity . "\n");
            foreach (constant("self::$entity") as $entity_item) {
                $entity = new $classname();
                foreach ($entity_item as $key => $value) {
                    if ($key === 'password') {
                        $entity->password_hash = Yii::$app->security->generatePasswordHash($value);
                    } else {
                        $entity->{$key} = $value;
                    }
                }
                $entity->save();
            }
        }

        return ExitCode::OK;
    }
}
