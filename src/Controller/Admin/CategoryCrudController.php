<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setIcon('fas fa-folder-open')->addCssClass('btn btn-succes')->setLabel('Adauga Categorie');
            })
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->setIcon('fas fa-edit')->addCssClass('btn btn-warning')->setLabel('Editeaza');
            })
            ->update(Crud::PAGE_INDEX, Action::DETAIL, function (Action $action){
                return $action->setIcon('fas fa-eye')->addCssClass('btn btn-info')->setLabel('Vizualizeaza');
            })
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action){
               return $action->setIcon('fas fa-trash')->addCssClass('btn btn-outline-danger')->setLabel('Sterge');
            });
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')
                        ->hideOnForm(),
            TextField::new('name')
                        ->setLabel('Titlu Categorie'),
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters->add('name');
    }

}
