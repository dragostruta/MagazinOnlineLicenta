<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CurrencyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setIcon('fas fa-box')->addCssClass('btn btn-succes')->setLabel('Adauga un produs');
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
        $imageFile = Field::new('image')
                ->setFormType(TextType::class)->setLabel('Imaginea de coperta');
        $image =  ImageField::new('image')
            ->setFormType(VichImageType::class)->setLabel('Imaginea de coperta');
        $fields = [
            IntegerField::new('id')
                ->hideOnForm(),
            TextField::new('title', 'Titlu'),
            TextField::new('brand', 'Brand'),
            TextareaField::new('description', 'Descriere'),
            NumberField::new('price', 'Pret'),
            AssociationField::new('productCategory', 'Subcategoria'),
            Field::new('image_one', 'Imagine 1')->setFormType(TextType::class)->hideOnIndex(),
            Field::new('image_two', 'Imagine 2')->setFormType(TextType::class)->hideOnIndex(),
            Field::new('image_three', 'Imagine 3')->setFormType(TextType::class)->hideOnIndex(),
        ];

        if($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL){
            $fields[] = $image;
        }else{
            $fields[] = $imageFile;
        }
        return $fields;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters ->add('title')
                        ->add('brand')
                        ->add('price')
                        ->add('productCategory');
    }
}
