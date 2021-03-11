<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210311150414 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD order_list_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398CBD4BFC0 FOREIGN KEY (order_list_id) REFERENCES order_list (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F5299398CBD4BFC0 ON `order` (order_list_id)');
        $this->addSql('ALTER TABLE product CHANGE news_id news_id INT DEFAULT NULL, CHANGE order_list_id order_list_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE age age INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398CBD4BFC0');
        $this->addSql('DROP INDEX UNIQ_F5299398CBD4BFC0 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP order_list_id');
        $this->addSql('ALTER TABLE product CHANGE news_id news_id INT DEFAULT NULL, CHANGE order_list_id order_list_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE age age INT DEFAULT NULL');
    }
}
