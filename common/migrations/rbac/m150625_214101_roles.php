<?php

use common\rbac\Migration;
use common\models\User;

class m150625_214101_roles extends Migration
{
    public function up()
    {
        $this->auth->removeAll();

        $viewer = $this->auth->createRole(User::ROLE_VIEWER);
        $this->auth->add($viewer);

        $techopr = $this->auth->createRole(User::ROLE_TECHOPR);
        $this->auth->add($techopr);

        $orgopr = $this->auth->createRole(User::ROLE_ORGOPR);
        $this->auth->add($orgopr);

        $techadm = $this->auth->createRole(User::ROLE_TECHADM);
        $this->auth->add($techadm);

        $orgadm = $this->auth->createRole(User::ROLE_ORGADM);
        $this->auth->add($orgadm);

        $superadm = $this->auth->createRole(User::ROLE_SUPERADM);
        $this->auth->add($superadm);
            $this->auth->addChild($superadm, $orgadm);
            $this->auth->addChild($superadm, $techadm);
            $this->auth->addChild($superadm, $orgopr);
            $this->auth->addChild($superadm, $techopr);
            $this->auth->addChild($superadm, $viewer);
        
        $this->auth->assign($superadm, 1);
        /*
        $this->auth->assign($admin, 1);
        $this->auth->assign($manager, 2);
        $this->auth->assign($user, 3);
         * 
         */
    }

    public function down()
    {
        $this->auth->remove($this->auth->getRole(User::ROLE_SUPERADM));
        $this->auth->remove($this->auth->getRole(User::ROLE_ORGADM));
        $this->auth->remove($this->auth->getRole(User::ROLE_TECHADM));
        $this->auth->remove($this->auth->getRole(User::ROLE_ORGOPR));
        $this->auth->remove($this->auth->getRole(User::ROLE_TECHOPR));
        $this->auth->remove($this->auth->getRole(User::ROLE_VIEWER));
    }
}
