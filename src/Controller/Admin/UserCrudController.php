<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setIcon('fas fa-user')->addCssClass('btn btn-succes')->setLabel('Adauga utilizator');
            })
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->setIcon('fas fa-edit')->addCssClass('btn btn-warning')->setLabel('Modifica');
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
            TextField::new('first_name', 'Nume'),
            TextField::new('last_name', 'Prenume'),
            EmailField::new('email', 'E-mail'),
            TextField::new('country', 'Tara'),
            TextField::new('city', 'Localitate'),
            TextField::new('region', 'Judet'),
            TextField::new('adress', 'Adresa'),
            IntegerField::new('zipcode', 'Cod postal'),
            NumberField::new('age', 'Varsta'),
            TelephoneField::new('phone', 'Telefon'),
            TextField::new('username', 'Nume utilizator'),
            TextField::new('password', 'Parola')->hideOnIndex(),
            ArrayField::new('roles', 'Rol')->setValue('ROLE_USER'),
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters->add('first_name')
                        ->add('last_name')
                        ->add('email')
                        ->add('country')
                        ->add('city')
                        ->add('region')
                        ->add('adress')
                        ->add('username');
    }

}
