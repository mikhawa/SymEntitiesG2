<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240910131932 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE section (id INT UNSIGNED AUTO_INCREMENT NOT NULL, section_title VARCHAR(120) NOT NULL, section_description VARCHAR(500) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE section_post (section_id INT UNSIGNED NOT NULL, post_id INT UNSIGNED NOT NULL, INDEX IDX_DF348086D823E37A (section_id), INDEX IDX_DF3480864B89032C (post_id), PRIMARY KEY(section_id, post_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE section_post ADD CONSTRAINT FK_DF348086D823E37A FOREIGN KEY (section_id) REFERENCES section (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE section_post ADD CONSTRAINT FK_DF3480864B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE section_post DROP FOREIGN KEY FK_DF348086D823E37A');
        $this->addSql('ALTER TABLE section_post DROP FOREIGN KEY FK_DF3480864B89032C');
        $this->addSql('DROP TABLE section');
        $this->addSql('DROP TABLE section_post');
    }
}
