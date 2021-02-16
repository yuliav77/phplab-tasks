SELECT DISTINCT origin_city 
FROM students
LIMIT 5

SELECT first_name, last_name, birth_date 
FROM students
WHERE first_name NOT IN ('David', 'Daniel', 'Max')

SELECT a.id AS application_id, s.first_name, s.last_name, s.birth_date, s.origin_city
FROM students s
INNER JOIN applications a
ON s.id = a.student_id
WHERE (s.birth_date BETWEEN '1980/01/01' AND '1990/01/01') OR (s.origin_city = 'New York')
ORDER BY application_id

SELECT a.id AS application_id, s.first_name, s.last_name, s.birth_date, s.origin_city, p.payment_amount
FROM students s
LEFT JOIN applications a
ON s.id = a.student_id
LEFT JOIN payments p
ON s.id = p.student_id
ORDER BY application_id

(SELECT CONCAT(s.first_name, ' ', s.last_name) AS student_name, c.title AS course_title, SUM(p.payment_amount) as payment_amount
FROM courses c
RIGHT JOIN payments p 
ON p.course_id = c.id
LEFT JOIN students s 
ON p.student_id = s.id
GROUP BY p.student_id, p.course_id)
UNION
(SELECT 'Total sum of course', c.title AS course_title, SUM(p.payment_amount) AS total_sum
FROM courses c
RIGHT JOIN payments p 
ON p.course_id = c.id
GROUP BY c.id)
ORDER BY course_title, payment_amount


SELECT c.title AS course_title, COUNT(a.student_id) AS total_count_of_applications, 
	( SELECT COUNT(a.student_id) FROM applications a
    WHERE (approved = TRUE) AND (a.course_id = c.id)
    ) AS count_of_approved_applications
FROM applications a, courses c
WHERE a.course_id = c.id
GROUP BY c.id


SELECT MAX(c.fee) AS max_fee, MIN(c.fee) AS min_fee, AVG(c.fee) AS average_fee
FROM courses AS c

SELECT b.title, b.discount, COUNT(a.id) AS count_of_application
FROM bonuses b
JOIN applications a
ON b.id = a.bonus_id
WHERE a.approved = TRUE
GROUP BY b.id
HAVING count_of_application > 3

SELECT a.id AS application_id, a.approved, CONCAT(s.first_name, ' ', s.last_name) AS student_name, CONCAT(b.discount, '*',c.fee, '=', c.fee-c.fee*b.discount) AS 'discount*fee=result_fee', p.payment_amount as payment
FROM students s
JOIN applications a
ON s.id = a.student_id
JOIN bonuses b
ON b.id = a.bonus_id
JOIN courses c
ON c.id = a.course_id
LEFT JOIN payments p
ON p.student_id = s.id
WHERE a.bonus_id > 1
ORDER BY s.id


SET SQL_SAFE_UPDATES = 0;
UPDATE applications a
LEFT JOIN (
	SELECT p.student_id, p.course_id, SUM(p.payment_amount) AS total_payment
	FROM payments p
	GROUP BY p.student_id, p.course_id
) AS s ON s.student_id = a.student_id
LEFT JOIN courses c ON c.id = a.course_id
LEFT JOIN bonuses b ON b.id = a.bonus_id 
SET a.approved = if(total_payment >= c.fee-c.fee*b.discount, TRUE, FALSE),
	a.app_comment = if(total_payment >= c.fee-c.fee*b.discount, 'Paid', if (total_payment > 0, CONCAT('Not enough funds: ', total_payment), 'Has not paid'))
WHERE a.approved = FALSE

