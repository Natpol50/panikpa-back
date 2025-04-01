------------------------------------------------------------
--        Script Postgre 
------------------------------------------------------------



------------------------------------------------------------
-- Table: Enterprise
------------------------------------------------------------
CREATE TABLE public.Enterprise(
	id_enterprise                VARCHAR (-1) NOT NULL ,
	enterprise_name              VARCHAR (-1) NOT NULL ,
	enterprise_phone             VARCHAR (-1) NOT NULL ,
	enterprise_description_url   VARCHAR (-1) NOT NULL ,
	enterprise_email             VARCHAR (-1) NOT NULL ,
	enterprise_photo_url         BYTEA  NOT NULL ,
	enterprise_site              VARCHAR (50) NOT NULL  ,
	CONSTRAINT Enterprise_PK PRIMARY KEY (id_enterprise)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Acctype
------------------------------------------------------------
CREATE TABLE public.Acctype(
	id_acctype                           INT  NOT NULL ,
	acctype_name                         VARCHAR (-1) NOT NULL ,
	perm_company_creation                BOOL  NOT NULL ,
	perm_modify_comp_info                BOOL  NOT NULL ,
	perm_grade_company                   BOOL  NOT NULL ,
	perm_create_offer                    BOOL  NOT NULL ,
	perm_modify_offer                    BOOL  NOT NULL ,
	perm_delete_offer                    BOOL  NOT NULL ,
	perm_delete_tutor                    BOOL  NOT NULL ,
	perm_search_tutor                    BOOL  NOT NULL ,
	perm_modify_tutor                    BOOL  NOT NULL ,
	perm_search_student                  BOOL  NOT NULL ,
	perm_create_student                  BOOL  NOT NULL ,
	perm_modify_student                  BOOL  NOT NULL ,
	perm_delete_student                  BOOL  NOT NULL ,
	perm_consult_students_stats          BOOL  NOT NULL ,
	perm_consult_students_applications   BOOL  NOT NULL ,
	perm_wishlist                        BOOL  NOT NULL ,
	perm_offer_apply                     BOOL  NOT NULL ,
	perm_consult_offer_applications      BOOL  NOT NULL ,
	perm_reply_offer_applications        BOOL  NOT NULL ,
	perm_create_admin                    BOOL  NOT NULL ,
	perm_modify_admin                    BOOL  NOT NULL ,
	perm_delete_admin                    BOOL  NOT NULL  ,
	CONSTRAINT Acctype_PK PRIMARY KEY (id_acctype)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: User
------------------------------------------------------------
CREATE TABLE public.User(
	id_user                   VARCHAR (-1) NOT NULL ,
	user_phash                VARCHAR (-1) NOT NULL ,
	user_name                 VARCHAR (-1) NOT NULL ,
	user_fname                VARCHAR (-1) NOT NULL ,
	user_stype                VARCHAR (-1) NOT NULL ,
	user_email                VARCHAR (-1) NOT NULL ,
	user_phone                VARCHAR (-1) NOT NULL ,
	user_gender               VARCHAR (-1) NOT NULL ,
	user_photo                BYTEA  NOT NULL ,
	user_creation_date        DATE  NOT NULL ,
	user_refresh_token_date   DATE  NOT NULL ,
	user_refresh_token        VARCHAR (50) NOT NULL ,
	user_promo_code           VARCHAR (50) NOT NULL ,
	id_acctype                INT  NOT NULL  ,
	CONSTRAINT User_PK PRIMARY KEY (id_user)

	,CONSTRAINT User_Acctype_FK FOREIGN KEY (id_acctype) REFERENCES public.Acctype(id_acctype)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: City
------------------------------------------------------------
CREATE TABLE public.City(
	id_city       SERIAL NOT NULL ,
	city_name     VARCHAR (-1) NOT NULL ,
	city_postal   INT  NOT NULL ,
	city_lat      FLOAT  NOT NULL ,
	city_long     FLOAT  NOT NULL  ,
	CONSTRAINT City_PK PRIMARY KEY (id_city)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Offer
------------------------------------------------------------
CREATE TABLE public.Offer(
	id_offer             SERIAL NOT NULL ,
	offer_title          VARCHAR (-1) NOT NULL ,
	offer_remuneration   VARCHAR (-1) NOT NULL ,
	offer_level          VARCHAR (-1) NOT NULL ,
	offer_duration       VARCHAR (-1) NOT NULL ,
	offer_start          DATE  NOT NULL ,
	offer_type           BOOL  NOT NULL ,
	offer_publish_date   DATE  NOT NULL ,
	offer_content_url    BYTEA  NOT NULL ,
	offer_applicant_nb   INT  NOT NULL ,
	id_enterprise        VARCHAR (-1) NOT NULL ,
	id_city              INT  NOT NULL  ,
	CONSTRAINT Offer_PK PRIMARY KEY (id_offer)

	,CONSTRAINT Offer_Enterprise_FK FOREIGN KEY (id_enterprise) REFERENCES public.Enterprise(id_enterprise)
	,CONSTRAINT Offer_City0_FK FOREIGN KEY (id_city) REFERENCES public.City(id_city)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Tag
------------------------------------------------------------
CREATE TABLE public.Tag(
	id_tag     SERIAL NOT NULL ,
	tag_name   VARCHAR (-1) NOT NULL  ,
	CONSTRAINT Tag_PK PRIMARY KEY (id_tag)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Offer_tag
------------------------------------------------------------
CREATE TABLE public.Offer_tag(
	id_offer   INT  NOT NULL ,
	id_tag     INT  NOT NULL ,
	optional   BOOL  NOT NULL  ,
	CONSTRAINT Offer_tag_PK PRIMARY KEY (id_offer,id_tag)

	,CONSTRAINT Offer_tag_Offer_FK FOREIGN KEY (id_offer) REFERENCES public.Offer(id_offer)
	,CONSTRAINT Offer_tag_Tag0_FK FOREIGN KEY (id_tag) REFERENCES public.Tag(id_tag)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: User_tag
------------------------------------------------------------
CREATE TABLE public.User_tag(
	id_tag    INT  NOT NULL ,
	id_user   VARCHAR (-1) NOT NULL  ,
	CONSTRAINT User_tag_PK PRIMARY KEY (id_tag,id_user)

	,CONSTRAINT User_tag_Tag_FK FOREIGN KEY (id_tag) REFERENCES public.Tag(id_tag)
	,CONSTRAINT User_tag_User0_FK FOREIGN KEY (id_user) REFERENCES public.User(id_user)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Interaction
------------------------------------------------------------
CREATE TABLE public.Interaction(
	id_offer                              INT  NOT NULL ,
	id_user                               VARCHAR (-1) NOT NULL ,
	id_interaction                        VARCHAR (-1) NOT NULL ,
	interaction_cv_url                    VARCHAR (-1) NOT NULL ,
	interaction_first_date                DATE  NOT NULL ,
	interaction_followup_date             DATE  NOT NULL ,
	interaction_followup_interview_date   DATE  NOT NULL ,
	interaction_cover_letter_url          BYTEA  NOT NULL ,
	interaction_followup_reply_type       BOOL  NOT NULL ,
	interaction_followup_reply            BYTEA  NOT NULL  ,
	CONSTRAINT Interaction_PK PRIMARY KEY (id_offer,id_user)

	,CONSTRAINT Interaction_Offer_FK FOREIGN KEY (id_offer) REFERENCES public.Offer(id_offer)
	,CONSTRAINT Interaction_User0_FK FOREIGN KEY (id_user) REFERENCES public.User(id_user)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Comment
------------------------------------------------------------
CREATE TABLE public.Comment(
	id_enterprise   VARCHAR (-1) NOT NULL ,
	id_user         VARCHAR (-1) NOT NULL ,
	grade_UE        INT  NOT NULL ,
	grade_comment   VARCHAR (50) NOT NULL ,
	grade_date      DATE  NOT NULL  ,
	CONSTRAINT Comment_PK PRIMARY KEY (id_enterprise,id_user)

	,CONSTRAINT Comment_Enterprise_FK FOREIGN KEY (id_enterprise) REFERENCES public.Enterprise(id_enterprise)
	,CONSTRAINT Comment_User0_FK FOREIGN KEY (id_user) REFERENCES public.User(id_user)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Wishlist
------------------------------------------------------------
CREATE TABLE public.Wishlist(




	=======================================================================
	   Désolé, il faut activer cette version pour voir la suite du script ! 
	=======================================================================
