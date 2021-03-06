<?php

use yii\db\Migration;

/**
 * Class m190526_171910_rbac_init
 */
class m190526_171910_rbac_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $am = Yii::$app->authManager;

        $permissionTaskCreate = $am->createPermission('TaskCreate');
        $permissionTaskUpdate = $am->createPermission('TaskUpdate');
        $permissionTaskDelete = $am->createPermission('TaskDelete');

        $am->add($permissionTaskCreate);
        $am->add($permissionTaskUpdate);
        $am->add($permissionTaskDelete);

        $admin = $am->createRole('admin');
        $moder = $am->createRole('moder');

        $am->add($admin);
        $am->add($moder);

        $am->addChild($admin, $permissionTaskCreate);
        $am->addChild($admin, $permissionTaskUpdate);
        $am->addChild($admin, $permissionTaskDelete);

        $am->addChild($moder, $permissionTaskCreate);
        $am->addChild($moder, $permissionTaskUpdate);

        $am->assign($admin, 1);
        $am->assign($moder, 2);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190526_171910_rbac_init cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190526_171910_rbac_init cannot be reverted.\n";

        return false;
    }
    */
}
