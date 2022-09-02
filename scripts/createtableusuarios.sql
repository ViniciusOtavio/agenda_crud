CREATE TABLE IF NOT EXISTS public.usuario
(
    nome character varying(100) COLLATE pg_catalog."default" NOT NULL,
    email character varying(50) COLLATE pg_catalog."default" NOT NULL,
    telefone character varying(20) COLLATE pg_catalog."default" NOT NULL,
    senha character varying(50) COLLATE pg_catalog."default" NOT NULL,
    data_nascimento date NOT NULL,
    CONSTRAINT usuario_pkey PRIMARY KEY (email)
)