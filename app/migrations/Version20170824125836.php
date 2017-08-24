<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170824125836 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE exemple_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, content LONGTEXT DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_C4DE0CEA2C2AC5D3 (translatable_id), UNIQUE INDEX exemple_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exemple (id INT AUTO_INCREMENT NOT NULL, media LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:media)\', media_collection LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:media_collection)\', image VARCHAR(255) DEFAULT NULL, contract VARCHAR(255) DEFAULT NULL, updated_at DATETIME NOT NULL, date DATE NOT NULL, position INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fos_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_957A647992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_957A6479A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_957A6479C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_block (id VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_block_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id VARCHAR(40) DEFAULT NULL, content LONGTEXT DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_E16089032C2AC5D3 (translatable_id), UNIQUE INDEX page_block_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exemple_translation ADD CONSTRAINT FK_C4DE0CEA2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES exemple (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE page_block_translation ADD CONSTRAINT FK_E16089032C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES page_block (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE exemple_translation DROP FOREIGN KEY FK_C4DE0CEA2C2AC5D3');
        $this->addSql('ALTER TABLE page_block_translation DROP FOREIGN KEY FK_E16089032C2AC5D3');
        $this->addSql('DROP TABLE exemple_translation');
        $this->addSql('DROP TABLE exemple');
        $this->addSql('DROP TABLE fos_user');
        $this->addSql('DROP TABLE page_block');
        $this->addSql('DROP TABLE page_block_translation');
    }
}
