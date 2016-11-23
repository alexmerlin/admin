<?php
/**
 * @copyright: DotKernel
 * @library: dotkernel/dot-admin
 * @author: n3vrax
 * Date: 11/4/2016
 * Time: 7:45 PM
 */

namespace Dot\Admin\Factory\Admin;


use Dot\Admin\Controller\AdminController;
use Dot\Admin\Form\Admin\AdminForm;
use Dot\Admin\Form\ConfirmDeleteForm;
use Dot\Admin\Service\AdminService;
use Dot\Admin\Service\EntityServiceExtensionInterface;
use Interop\Container\ContainerInterface;

/**
 * Class AdminControllerFactory
 * @package Dot\Authentication\Authentication\Factory
 */
class AdminControllerFactory
{
    /**
     * @param ContainerInterface $container
     * @return AdminController
     */
    public function __invoke(ContainerInterface $container)
    {
        /** @var EntityServiceExtensionInterface $service */
        $service = $container->get(AdminService::class);
        $userForm = $container->get(AdminForm::class);

        $confirmDeleteForm = new ConfirmDeleteForm();
        $confirmDeleteForm->init();

        $controller = new AdminController($service, $userForm, $confirmDeleteForm);
        $controller->setDebug($container->get('config')['debug']);

        return $controller;
    }

}