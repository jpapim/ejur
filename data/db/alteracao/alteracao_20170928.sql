/*Alterando um campo nao utilizado para controlar quando as questões devem ser bloqueadas ou desbloqueadas para uso.*/
alter table questao change bo_ativo bo_bloqueada_temporizador char(1);