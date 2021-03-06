<?php
/**
 * @see https://github.com/dotkernel/admin/ for the canonical source repository
 * @copyright Copyright (c) 2017 Apidemia (https://www.apidemia.com)
 * @license https://github.com/dotkernel/admin/blob/master/LICENSE.md MIT License
 */

declare(strict_types=1);

namespace Admin\User;

use Admin\User\Entity\UserEntity;
use Admin\User\Factory\UserDbMapperFactory;
use Admin\User\Factory\UserFieldsetFactory;
use Admin\User\Factory\UserHydratorFactory;
use Admin\User\Form\UserDetailsFieldset;
use Admin\User\Form\UserFieldset;
use Admin\User\Form\UserForm;
use Admin\User\Hydrator\UserHydrator;
use Admin\User\Mapper\UserDbMapper;
use Zend\ServiceManager\Factory\InvokableFactory;

/**
 * Class ConfigProvider
 * @package Admin\User
 */
class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),

            'dot_form' => $this->getForms(),

            'dot_hydrator' => $this->getHydrators(),

            'templates' => $this->getTemplates(),

            'dot_mapper' => $this->getMappers(),
        ];
    }

    public function getDependencies(): array
    {
        return [

        ];
    }

    public function getTemplates(): array
    {
        return [
            'paths' => [
                'app' => [__DIR__ . '/../templates/app']
            ]
        ];
    }

    public function getForms(): array
    {
        return [
            'form_manager' => [
                'factories' => [
                    UserFieldset::class => UserFieldsetFactory::class,
                    UserDetailsFieldset::class => InvokableFactory::class,
                    UserForm::class => InvokableFactory::class,
                ],
                'aliases' => [
                    'F_UserFieldset' => UserFieldset::class,
                    'F_UserDetailsFieldset' => UserDetailsFieldset::class,
                    'User' => UserForm::class,
                ]
            ]
        ];
    }

    public function getHydrators(): array
    {
        return [
            'hydrator_manager' => [
                'factories' => [
                    UserHydrator::class => UserHydratorFactory::class,
                ],
                'aliases' => [
                    'UserHydrator' => UserHydrator::class,
                ]
            ]
        ];
    }

    public function getMappers(): array
    {
        return [
            'mapper_manager' => [
                'factories' => [
                    UserDbMapper::class => UserDbMapperFactory::class,
                ],
                'aliases' => [
                    UserEntity::class => UserDbMapper::class,
                ]
            ]
        ];
    }
}
