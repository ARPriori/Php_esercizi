/* ------ ESERCIZI RAGGRUPPAMENTO (GROUP BY) ------ */

SELECT COUNT(*) as totStudenti FROM studenti;
SELECT s.anno_immatricolazione, COUNT(*) as numStudenti FROM studenti s GROUP BY s.anno_immatricolazione;
SELECT s.id_studente, AVG(e.voto) as media_voti FROM studenti s JOIN esami e ON s.id_studente = e.id_studente GROUP BY s.id_studente, s.nome;
SELECT c.id_corso, MAX(e.voto) as votoMax, MIN(e.voto) as votoMin FROM corsi c JOIN esami e ON c.id_corso = e.id_corso GROUP BY c.id_corso;
SELECT d.id_docente, CONCAT(d.nome, " ", d.cognome) as nome_docente, SUM(c.cfu) FROM docenti d JOIN corsi c ON d.id_docente = c.id_docente GROUP BY d.id_docente;
SELECT s.id_studente, AVG(e.voto) as media_voti FROM studenti s JOIN esami e ON s.id_studente = e.id_studente GROUP BY s.id_studente, s.nome HAVING media_voti > 25;
SELECT c.id_corso, c.nome_corso, COUNT(e.id_esame) as tot_esami FROM corsi c JOIN esami e ON c.id_corso = e.id_corso GROUP BY c.id_corso ORDER BY tot_esami DESC;
SELECT dip.id_dipartimento, dip.nome_dip, COUNT(doc.id_docente) as num_docenti FROM dipartimenti dip JOIN docenti doc ON dip.id_dipartimento = doc.id_dipartimento GROUP BY dip.id_dipartimento;
SELECT c.id_corso, c.nome_corso, COUNT(e.voto) as num_lodi FROM corsi c JOIN esami e ON c.id_corso = e.id_corso WHERE e.voto = 31 GROUP BY c.id_corso;
SELECT dip.nome_dip, c.nome_corso, AVG(e.voto) as media_voti FROM dipartimenti dip JOIN docenti doc ON dip.id_dipartimento = doc.id_dipartimento JOIN corsi c ON dip.id_dipartimento = c.id_docente JOIN esami e ON c.id_corso = e.id_corso GROUP BY dip.id_dipartimento, dip.nome_dip, c.id_corso, c.nome_corso;

/* ------ ESERCIZI SUBQUERY ------ */

SELECT s.nome, s.cognome FROM studenti s JOIN esami e ON s.id_studente = e.id_studente WHERE e.voto > (SELECT AVG(e.voto) FROM esami e) GROUP BY s.id_studente, s.nome;
SELECT nome, cognome FROM docenti WHERE id_dipartimento IN (SELECT id_dipartimento FROM dipartimenti WHERE nome_dip LIKE '%Informatica%');
SELECT id_corso, nome_corso FROM corsi WHERE id_corso NOT IN (SELECT id_corso FROM esami);
SELECT id_corso, nome_corso FROM corsi WHERE cfu = (SELECT MAX(cfu) FROM corsi);
SELECT c.nome_corso, (SELECT COUNT(e.voto) FROM esami e WHERE e.id_corso = c.id_corso AND e.voto = 31) as tot_lodi FROM corsi c;
SELECT s.id_studente, CONCAT(s.nome, " ", s.cognome) as nome_studente FROM studenti s WHERE s.id_studente IN (SELECT e.id_studente FROM esami e WHERE e.id_corso = (SELECT c.id_corso FROM corsi c WHERE c.nome_corso = "Basi di Dati"));
SELECT AVG(tab_medie.media_stud) as media_tot FROM (SELECT AVG(e.voto) as media_stud FROM studenti s JOIN esami e ON s.id_studente = e.id_studente GROUP BY s.id_studente) as tab_medie;
SELECT c.id_corso, c.nome_corso, c.cfu FROM corsi c WHERE c.cfu > (SELECT AVG(c2.cfu) FROM corsi c2 JOIN docenti d ON c2.id_docente = d.id_docente JOIN dipartimenti dip ON d.id_dipartimento = dip.id_dipartimento WHERE dip.nome_dip = 'Lettere');
SELECT d.id_docente, CONCAT(d.nome, " ", d.cognome) as nome_docente FROM docenti d WHERE d.id_docente IN (SELECT c.id_docente FROM corsi c WHERE c.id_corso IN (SELECT e.id_corso FROM esami e WHERE e.id_studente = (SELECT s.id_studente FROM studenti s WHERE s.nome = "Mario" AND s.cognome = "Rossi")));
SELECT s.nome, (SELECT COUNT(*) FROM esami e WHERE e.id_studente = s.id_studente AND e.voto > (SELECT AVG(e1.voto) FROM esami e1 WHERE e1.id_studente = s.id_studente)) as num_esami FROM studenti s;