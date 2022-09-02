CREATE TABLE IF NOT EXISTS public.contatos
(
    id integer NOT NULL DEFAULT nextval('anuncio_id_seq'::regclass),
    nome character varying(50) COLLATE pg_catalog."default" NOT NULL,
    email character varying(50) COLLATE pg_catalog."default" NOT NULL,
    celular character varying(50) COLLATE pg_catalog."default" NOT NULL,
    email_usuario character varying(50) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT anuncio_pkey PRIMARY KEY (id),
    CONSTRAINT fk_email_usuario FOREIGN KEY (email_usuario)
        REFERENCES public.usuario (email) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
)