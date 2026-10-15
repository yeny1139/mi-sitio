CREATE TABLE IF NOT EXISTS mensajes (
    id         BIGSERIAL PRIMARY KEY,
    nombre     VARCHAR(100) NOT NULL,
    asunto     VARCHAR(150) NOT NULL DEFAULT '',
    email      VARCHAR(150) NOT NULL,
    mensaje    TEXT         NOT NULL,
    creado_en  TIMESTAMPTZ  NOT NULL DEFAULT now()
);