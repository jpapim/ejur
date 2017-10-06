/*Adiciona um campo que permite marcar a prova que foi definida como avaliação definitiva*/
alter table prova add column bo_prova_definitiva char(1) after cs_ativo;

/*
Adicionar no controle de permissões as actions:
 - marcar-avaliacao-como-aplicada
 - aplicar-temporizador-questao-prova-ajax
 - liberar-temporizador-questao-prova-ajax

 Conceder o Permissionamento para o Administrador nos modulos>
  - Prova
*/