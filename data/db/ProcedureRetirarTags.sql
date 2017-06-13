
#ALTER TABLE questao DROP COLUMN flag;
ALTER TABLE questao add COLUMN flag int DEFAULT 0;

delimiter $
create procedure RetirarTargs()
begin
DECLARE id_questao int;
DECLARE texto text;
declare textoQuestao text;

loop_questao:loop
set id_questao = ( SELECT questao.id_questao from questao WHERE questao.flag =0  limit 1 );

if id_questao is null then 
ALTER TABLE questao DROP COLUMN flag;
LEAVE loop_questao;
end if;


set texto= (SELECT questao.tx_enunciado from questao WHERE questao.id_questao =id_questao) ;


if texto like '%<span style="font-family:&quot;Arial&quot;,sans-serif">%' THEN
set textoQuestao = (REPLACE(texto,'<span style="font-family:&quot;Arial&quot;,sans-serif">','<span>'));
UPDATE questao set questao.tx_enunciado=textoQuestao WHERE questao.id_questao=id_questao;
end if;

if texto like '%<p style="margin-left:-7.1pt; margin-right:0cm; text-align:justify">%' then
set textoQuestao = (REPLACE(TextoQuestao,'<p style="margin-left:-7.1pt; margin-right:0cm; text-align:justify">','<p>'));
UPDATE questao set questao.tx_enunciado=textoQuestao WHERE questao.id_questao=id_questao;
end if;

if texto like '%<span style="font-size:9.5pt">%' then
set textoQuestao = (REPLACE(TextoQuestao,'<span style="font-size:9.5pt">','<span>'));
UPDATE questao set questao.tx_enunciado=textoQuestao WHERE questao.id_questao=id_questao;
end if;


if texto like '%<p style="margin-left:35.4pt; margin-right:0cm; text-align:justify">%' then
set textoQuestao = (REPLACE(TextoQuestao,'<p style="margin-left:35.4pt; margin-right:0cm; text-align:justify">','<p>'));
UPDATE questao set questao.tx_enunciado=textoQuestao WHERE questao.id_questao=id_questao;
end if;


if texto like '%<p style="margin-left:35.45pt; margin-right:0cm; text-align:justify">%' then
set textoQuestao = (REPLACE(TextoQuestao,'<p style="margin-left:35.45pt; margin-right:0cm; text-align:justify">','<p>'));
UPDATE questao set questao.tx_enunciado=textoQuestao WHERE questao.id_questao=id_questao;
end if;




if texto like '%<span style="font-size:12.0pt">%' then
set textoQuestao = (REPLACE(TextoQuestao,'<span style="font-size:12.0pt">','<span>'));
UPDATE questao set questao.tx_enunciado=textoQuestao WHERE questao.id_questao=id_questao;
end if;




if texto like '%<p style="text-align:justify">%' then
set textoQuestao = (REPLACE(TextoQuestao,'<p style="text-align:justify">','<p>'));
UPDATE questao set questao.tx_enunciado=textoQuestao WHERE questao.id_questao=id_questao;
end if;


set texto= (SELECT questao.tx_enunciado from questao WHERE questao.id_questao =id_questao) ;

if texto like '%style="margin%' then
set textoQuestao = (REPLACE(texto,'style="margin','stylea='));
UPDATE questao set questao.tx_enunciado=textoQuestao WHERE questao.id_questao=id_questao;
end if;


if texto  like '%style="font%' then
set textoQuestao = (REPLACE(textoQuestao,'style="font','stylea='));
UPDATE questao set questao.tx_enunciado=textoQuestao WHERE questao.id_questao=id_questao;
end if;


if texto  like '%style="text%' then
set textoQuestao = (REPLACE(textoQuestao,'style="text','stylea='));
UPDATE questao set questao.tx_enunciado=textoQuestao WHERE questao.id_questao=id_questao;
end if;







UPDATE questao set questao.flag=1 WHERE questao.id_questao=id_questao;


end LOOP loop_questao;


end
$
delimiter; 
call RetirarTargs();