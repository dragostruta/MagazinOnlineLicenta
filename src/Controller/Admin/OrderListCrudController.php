<?php

namespace App\Controller\Admin;

use App\Entity\OrderList;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OrderListCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OrderList::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('quantity'),
            NumberField::new('price'),
            NumberField::new('total')->hideOnForm(),
            AssociationField::new('products'),
        ];
    }
}
