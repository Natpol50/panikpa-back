-- Creating and using the database
DROP DATABASE IF EXISTS PANIKPA;
CREATE DATABASE IF NOT EXISTS PANIKPA;
USE PANIKPA;

-- Creating tables in order of dependencies

-- Table: Enterprise
CREATE TABLE Enterprise(
    id_enterprise              Varchar(3) NOT NULL,
    enterprise_name            Varchar(255) NOT NULL,
    enterprise_phone           Varchar(20) NOT NULL,
    enterprise_description_url Varchar(255) NULL,
    enterprise_email           Varchar(255) NOT NULL,
    enterprise_photo_url       BLOB NULL,
    enterprise_site            Varchar(255) NULL,
    CONSTRAINT Enterprise_PK PRIMARY KEY (id_enterprise)
)ENGINE=InnoDB;

-- Table: Acctype
CREATE TABLE Acctype(
    id_acctype                         Int NOT NULL,
    acctype_name                       Varchar(50) NOT NULL,
    perm_company_creation              Bool NOT NULL,
    perm_modify_comp_info              Bool NOT NULL,
    perm_grade_company                 Bool NOT NULL,
    perm_create_offer                  Bool NOT NULL,
    perm_modify_offer                  Bool NOT NULL,
    perm_delete_offer                  Bool NOT NULL,
    perm_delete_tutor                  Bool NOT NULL,
    perm_search_tutor                  Bool NOT NULL,
    perm_modify_tutor                  Bool NOT NULL,
    perm_search_student                Bool NOT NULL,
    perm_create_student                Bool NOT NULL,
    perm_modify_student                Bool NOT NULL,
    perm_delete_student                Bool NOT NULL,
    perm_consult_students_stats        Bool NOT NULL,
    perm_consult_students_applications Bool NOT NULL,
    perm_wishlist                      Bool NOT NULL,
    perm_offer_apply                   Bool NOT NULL,
    perm_consult_offer_applications    Bool NOT NULL,
    perm_reply_offer_applications      Bool NOT NULL,
    perm_create_admin                  Bool NOT NULL,
    perm_modify_admin                  Bool NOT NULL,
    perm_delete_admin                  Bool NOT NULL,
    CONSTRAINT Acctype_PK PRIMARY KEY (id_acctype)
)ENGINE=InnoDB;

-- Table: User
CREATE TABLE User(
    id_user                 Varchar(255) NOT NULL,
    user_phash              Varchar(255) NOT NULL,
    user_name               Varchar(100) NOT NULL,
    user_fname              Varchar(100) NOT NULL,
    user_stype              Bool NOT NULL,
    user_email              Varchar(255) NULL,
    user_phone              Varchar(20) NULL,
    user_gender             Varchar(10) NULL,
    user_photo_url          BLOB NULL,
    user_creation_date      Date NOT NULL,
    user_refresh_token_date Date NULL,
    user_refresh_token      Varchar(255) NULL,
    id_acctype              Int NOT NULL,
    CONSTRAINT User_PK PRIMARY KEY (id_user),
    CONSTRAINT User_Acctype_FK FOREIGN KEY (id_acctype) REFERENCES Acctype(id_acctype)
)ENGINE=InnoDB;

-- Table: City
CREATE TABLE City(
    id_city     Int Auto_increment NOT NULL,
    city_name   Varchar(100) NOT NULL,
    city_postal Int NOT NULL,
    city_lat    Float NOT NULL,
    city_long   Float NOT NULL,
    CONSTRAINT City_PK PRIMARY KEY (id_city)
)ENGINE=InnoDB;

-- Table: Offer
CREATE TABLE Offer(
    id_offer           Int Auto_increment NOT NULL,
    offer_title        Varchar(255) NOT NULL,
    offer_remuneration Varchar(50) NOT NULL,
    offer_level        Varchar(50) NOT NULL,
    offer_duration     Varchar(50) NOT NULL,
    offer_start        Date NOT NULL,
    offer_type         Bool NOT NULL,
    offer_publish_date Date NOT NULL,
    offer_content_url  BLOB NOT NULL,
    id_enterprise      Varchar(3) NOT NULL,
    id_city            Int NOT NULL,
    CONSTRAINT Offer_PK PRIMARY KEY (id_offer),
    CONSTRAINT Offer_Enterprise_FK FOREIGN KEY (id_enterprise) REFERENCES Enterprise(id_enterprise),
    CONSTRAINT Offer_City0_FK FOREIGN KEY (id_city) REFERENCES City(id_city)
)ENGINE=InnoDB;

-- Table: Tag
CREATE TABLE Tag(
    id_tag   Int Auto_increment NOT NULL,
    tag_name Varchar(50) NOT NULL,
    CONSTRAINT Tag_PK PRIMARY KEY (id_tag)
)ENGINE=InnoDB;

-- Table: Offer_tag
CREATE TABLE Offer_tag(
    id_offer Int NOT NULL,
    id_tag   Int NOT NULL,
    optional Bool NOT NULL,
    CONSTRAINT Offer_tag_PK PRIMARY KEY (id_offer,id_tag),
    CONSTRAINT Offer_tag_Offer_FK FOREIGN KEY (id_offer) REFERENCES Offer(id_offer),
    CONSTRAINT Offer_tag_Tag0_FK FOREIGN KEY (id_tag) REFERENCES Tag(id_tag)
)ENGINE=InnoDB;

-- Table: User_tag
CREATE TABLE User_tag(
    id_tag  Int NOT NULL,
    id_user Varchar(255) NOT NULL,
    CONSTRAINT User_tag_PK PRIMARY KEY (id_tag,id_user),
    CONSTRAINT User_tag_Tag_FK FOREIGN KEY (id_tag) REFERENCES Tag(id_tag),
    CONSTRAINT User_tag_User0_FK FOREIGN KEY (id_user) REFERENCES User(id_user)
)ENGINE=InnoDB;


-- Table: Promotion
CREATE TABLE Promotion(
    promotion_code Varchar(50) NOT NULL,
    id_user        Varchar(255) NOT NULL,
    CONSTRAINT Promotion_PK PRIMARY KEY (promotion_code,id_user),
    CONSTRAINT Promotion_User_FK FOREIGN KEY (id_user) REFERENCES User(id_user)
)ENGINE=InnoDB;


-- Table: Interaction
CREATE TABLE Interaction(
    id_offer                            Int NOT NULL,
    id_user                             Varchar(255) NOT NULL,
    interaction_cv_url                  Varchar(255) NOT NULL,
    interaction_first_date              Date NOT NULL,
    interaction_followup_date           Date NULL,
    interaction_followup_interview_date Date NULL,
    interaction_cover_letter_url        BLOB NOT NULL,
    interaction_followup_reply_type     Bool NULL,
    interaction_followup_reply          BLOB NULL,
    CONSTRAINT Interaction_PK PRIMARY KEY (id_offer,id_user),
    CONSTRAINT Interaction_Offer_FK FOREIGN KEY (id_offer) REFERENCES Offer(id_offer),
    CONSTRAINT Interaction_User0_FK FOREIGN KEY (id_user) REFERENCES User(id_user)
)ENGINE=InnoDB;

-- Table : Comment
CREATE TABLE Comment(
    id_enterprise    Varchar(3) NOT NULL,
    id_user          Varchar(200) NOT NULL,
    grade_UE         Int NOT NULL,
    grade_comment    Varchar(255) NULL,
    grade_date       Date NOT NULL,
    CONSTRAINT Comment_PK PRIMARY KEY (id_enterprise,id_user),
    CONSTRAINT Comment_enterprise_FK FOREIGN KEY (id_enterprise) REFERENCES Offer(id_enterprise),
    CONSTRAINT Comment_user_FK FOREIGN KEY (id_user) REFERENCES User(id_user)
)ENGINE=InnoDB;

-- Table: Wishlist
CREATE TABLE Wishlist(
    id_user         Varchar(255) NOT NULL,
    id_offer        Int NOT NULL,
    CONSTRAINT Wishlist_PK PRIMARY KEY (id_user,id_offer),
    CONSTRAINT Wishlist_Offer_FK FOREIGN KEY (id_offer) REFERENCES Offer(id_offer),
    CONSTRAINT Wishlist_User_FK FOREIGN KEY (id_user) REFERENCES User(id_user)
)ENGINE=InnoDB;

-- Table: CompanyUsers
CREATE TABLE CompanyUsers (
	id_user         Varchar(255) NOT NULL,
    id_enterprise   Varchar(3) NOT NULL,
    CONSTRAINT Companyusers_PK PRIMARY KEY (id_enterprise,id_user),
    CONSTRAINT CompanyUsers_enterprise_FK FOREIGN KEY (id_enterprise) REFERENCES Offer(id_enterprise),
    CONSTRAINT CompanyUsers_user_FK FOREIGN KEY (id_user) REFERENCES User(id_user)
)ENGINE=INNODB;

DROP USER IF EXISTS 'server'@'%';
CREATE USER 'server'@'%' IDENTIFIED BY 'panikpa';
GRANT ALL PRIVILEGES ON PANIKPA.* TO 'server'@'%' WITH GRANT OPTION;
SELECT user, host FROM mysql.user WHERE user = 'server';
SHOW GRANTS FOR 'server'@'%';