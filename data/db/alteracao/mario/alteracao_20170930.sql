-- Adiciona a coluna nm_filtro_prova para armazenar o nome do filtro pre definido
alter table filtro_prova add column nm_filtro_prova varchar(45) COMMENT 'Campo utilizado para armazenar o nome do filtro já pré definido';
