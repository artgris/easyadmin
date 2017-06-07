<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170607082516 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE product');
        $this->addSql('DROP INDEX IDX_C4DE0CEA2C2AC5D3');
        $this->addSql('DROP INDEX exemple_translation_unique_translation');
        $this->addSql('CREATE TEMPORARY TABLE __temp__exemple_translation AS SELECT id, translatable_id, title, content, locale FROM exemple_translation');
        $this->addSql('DROP TABLE exemple_translation');
        $this->addSql('CREATE TABLE exemple_translation (id INTEGER NOT NULL, translatable_id INTEGER DEFAULT NULL, title VARCHAR(255) DEFAULT NULL COLLATE BINARY, content CLOB DEFAULT NULL COLLATE BINARY, locale VARCHAR(255) NOT NULL COLLATE BINARY, PRIMARY KEY(id), CONSTRAINT FK_C4DE0CEA2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES exemple (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO exemple_translation (id, translatable_id, title, content, locale) SELECT id, translatable_id, title, content, locale FROM __temp__exemple_translation');
        $this->addSql('DROP TABLE __temp__exemple_translation');
        $this->addSql('CREATE INDEX IDX_C4DE0CEA2C2AC5D3 ON exemple_translation (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX exemple_translation_unique_translation ON exemple_translation (translatable_id, locale)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__exemple AS SELECT id, image, contract, updated_at, date, position, media, media_collection FROM exemple');
        $this->addSql('DROP TABLE exemple');
        $this->addSql('CREATE TABLE exemple (id INTEGER NOT NULL, image VARCHAR(255) DEFAULT NULL COLLATE BINARY, contract VARCHAR(255) DEFAULT NULL COLLATE BINARY, updated_at DATETIME NOT NULL, date DATE NOT NULL, position INTEGER NOT NULL, media CLOB DEFAULT NULL, media_collection CLOB DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO exemple (id, image, contract, updated_at, date, position, media, media_collection) SELECT id, image, contract, updated_at, date, position, media, media_collection FROM __temp__exemple');
        $this->addSql('DROP TABLE __temp__exemple');
        $this->addSql('DROP INDEX UNIQ_957A647992FC23A8');
        $this->addSql('DROP INDEX UNIQ_957A6479A0D96FBF');
        $this->addSql('DROP INDEX UNIQ_957A6479C05FB297');
        $this->addSql('CREATE TEMPORARY TABLE __temp__fos_user AS SELECT id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, confirmation_token, password_requested_at, roles FROM fos_user');
        $this->addSql('DROP TABLE fos_user');
        $this->addSql('CREATE TABLE fos_user (id INTEGER NOT NULL, username VARCHAR(180) NOT NULL COLLATE BINARY, username_canonical VARCHAR(180) NOT NULL COLLATE BINARY, email VARCHAR(180) NOT NULL COLLATE BINARY, email_canonical VARCHAR(180) NOT NULL COLLATE BINARY, enabled BOOLEAN NOT NULL, salt VARCHAR(255) DEFAULT NULL COLLATE BINARY, password VARCHAR(255) NOT NULL COLLATE BINARY, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL COLLATE BINARY, password_requested_at DATETIME DEFAULT NULL, roles CLOB NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO fos_user (id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, confirmation_token, password_requested_at, roles) SELECT id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, confirmation_token, password_requested_at, roles FROM __temp__fos_user');
        $this->addSql('DROP TABLE __temp__fos_user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A647992FC23A8 ON fos_user (username_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A6479A0D96FBF ON fos_user (email_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A6479C05FB297 ON fos_user (confirmation_token)');
        $this->addSql('DROP INDEX IDX_E16089032C2AC5D3');
        $this->addSql('DROP INDEX page_block_translation_unique_translation');
        $this->addSql('CREATE TEMPORARY TABLE __temp__page_block_translation AS SELECT id, translatable_id, content, locale FROM page_block_translation');
        $this->addSql('DROP TABLE page_block_translation');
        $this->addSql('CREATE TABLE page_block_translation (id INTEGER NOT NULL, translatable_id VARCHAR(40) DEFAULT NULL COLLATE BINARY, content CLOB DEFAULT NULL COLLATE BINARY, locale VARCHAR(255) NOT NULL COLLATE BINARY, PRIMARY KEY(id), CONSTRAINT FK_E16089032C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES page_block (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO page_block_translation (id, translatable_id, content, locale) SELECT id, translatable_id, content, locale FROM __temp__page_block_translation');
        $this->addSql('DROP TABLE __temp__page_block_translation');
        $this->addSql('CREATE INDEX IDX_E16089032C2AC5D3 ON page_block_translation (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX page_block_translation_unique_translation ON page_block_translation (translatable_id, locale)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE product (id INTEGER NOT NULL, image VARCHAR(255) DEFAULT NULL COLLATE BINARY, contract VARCHAR(255) DEFAULT NULL COLLATE BINARY, updated_at DATETIME NOT NULL, date DATE NOT NULL, position INTEGER NOT NULL, media CLOB DEFAULT NULL COLLATE BINARY, media_collection CLOB DEFAULT NULL COLLATE BINARY, PRIMARY KEY(id))');
        $this->addSql('CREATE TEMPORARY TABLE __temp__exemple AS SELECT id, media, media_collection, image, contract, updated_at, date, position FROM exemple');
        $this->addSql('DROP TABLE exemple');
        $this->addSql('CREATE TABLE exemple (id INTEGER NOT NULL, image VARCHAR(255) DEFAULT NULL, contract VARCHAR(255) DEFAULT NULL, updated_at DATETIME NOT NULL, date DATE NOT NULL, position INTEGER NOT NULL, media CLOB DEFAULT NULL COLLATE BINARY, media_collection CLOB DEFAULT NULL COLLATE BINARY, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO exemple (id, media, media_collection, image, contract, updated_at, date, position) SELECT id, media, media_collection, image, contract, updated_at, date, position FROM __temp__exemple');
        $this->addSql('DROP TABLE __temp__exemple');
        $this->addSql('DROP INDEX IDX_C4DE0CEA2C2AC5D3');
        $this->addSql('DROP INDEX exemple_translation_unique_translation');
        $this->addSql('CREATE TEMPORARY TABLE __temp__exemple_translation AS SELECT id, translatable_id, title, content, locale FROM exemple_translation');
        $this->addSql('DROP TABLE exemple_translation');
        $this->addSql('CREATE TABLE exemple_translation (id INTEGER NOT NULL, translatable_id INTEGER DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, content CLOB DEFAULT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO exemple_translation (id, translatable_id, title, content, locale) SELECT id, translatable_id, title, content, locale FROM __temp__exemple_translation');
        $this->addSql('DROP TABLE __temp__exemple_translation');
        $this->addSql('CREATE INDEX IDX_C4DE0CEA2C2AC5D3 ON exemple_translation (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX exemple_translation_unique_translation ON exemple_translation (translatable_id, locale)');
        $this->addSql('DROP INDEX UNIQ_957A647992FC23A8');
        $this->addSql('DROP INDEX UNIQ_957A6479A0D96FBF');
        $this->addSql('DROP INDEX UNIQ_957A6479C05FB297');
        $this->addSql('CREATE TEMPORARY TABLE __temp__fos_user AS SELECT id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, confirmation_token, password_requested_at, roles FROM fos_user');
        $this->addSql('DROP TABLE fos_user');
        $this->addSql('CREATE TABLE fos_user (id INTEGER NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled BOOLEAN NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles CLOB NOT NULL COLLATE BINARY, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO fos_user (id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, confirmation_token, password_requested_at, roles) SELECT id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, confirmation_token, password_requested_at, roles FROM __temp__fos_user');
        $this->addSql('DROP TABLE __temp__fos_user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A647992FC23A8 ON fos_user (username_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A6479A0D96FBF ON fos_user (email_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A6479C05FB297 ON fos_user (confirmation_token)');
        $this->addSql('DROP INDEX IDX_E16089032C2AC5D3');
        $this->addSql('DROP INDEX page_block_translation_unique_translation');
        $this->addSql('CREATE TEMPORARY TABLE __temp__page_block_translation AS SELECT id, translatable_id, content, locale FROM page_block_translation');
        $this->addSql('DROP TABLE page_block_translation');
        $this->addSql('CREATE TABLE page_block_translation (id INTEGER NOT NULL, translatable_id VARCHAR(40) DEFAULT NULL, content CLOB DEFAULT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO page_block_translation (id, translatable_id, content, locale) SELECT id, translatable_id, content, locale FROM __temp__page_block_translation');
        $this->addSql('DROP TABLE __temp__page_block_translation');
        $this->addSql('CREATE INDEX IDX_E16089032C2AC5D3 ON page_block_translation (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX page_block_translation_unique_translation ON page_block_translation (translatable_id, locale)');
    }
}
