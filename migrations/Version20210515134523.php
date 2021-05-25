<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210515134523 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD status VARCHAR(255) NOT NULL, ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, DROP date, DROP order_list_id');
        $this->addSql('ALTER TABLE order_list ADD product_id INT NOT NULL, ADD order_ref_id INT NOT NULL, DROP price');
        $this->addSql('ALTER TABLE order_list ADD CONSTRAINT FK_939C20F4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE order_list ADD CONSTRAINT FK_939C20FE238517C FOREIGN KEY (order_ref_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_939C20F4584665A ON order_list (product_id)');
        $this->addSql('CREATE INDEX IDX_939C20FE238517C ON order_list (order_ref_id)');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADCBD4BFC0');
        $this->addSql('DROP INDEX IDX_D34A04ADCBD4BFC0 ON product');
        $this->addSql('ALTER TABLE product DROP order_list_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD date DATE NOT NULL, ADD order_list_id INT DEFAULT NULL, DROP status, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE order_list DROP FOREIGN KEY FK_939C20F4584665A');
        $this->addSql('ALTER TABLE order_list DROP FOREIGN KEY FK_939C20FE238517C');
        $this->addSql('DROP INDEX IDX_939C20F4584665A ON order_list');
        $this->addSql('DROP INDEX IDX_939C20FE238517C ON order_list');
        $this->addSql('ALTER TABLE order_list ADD price DOUBLE PRECISION NOT NULL, DROP product_id, DROP order_ref_id');
        $this->addSql('ALTER TABLE product ADD order_list_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADCBD4BFC0 FOREIGN KEY (order_list_id) REFERENCES order_list (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADCBD4BFC0 ON product (order_list_id)');
    }
}
