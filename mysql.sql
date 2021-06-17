-- php artisan storage:link
INSERT INTO estandars (id, factor, dimension, estandar, denominacion) VALUES
(1, 'F1', 'GE', '1', 'Propósitos articulados'),
(2, 'F1', 'GE', '2', 'Participación de los grupos de interés'),
(3, 'F1', 'GE', '3', 'Revision periodica y participativa de las politicas'),
(4, 'F1', 'GE', '4', 'Sostenibilidad');

INSERT INTO resultados (id, codigo, detalle) VALUES
(1, '[a]', 'Conocimientos de computacion: la capacidad'),
(2, '[b]', 'Analisis de Problemas: La capacidad'),
(3, '[c]', 'Conocimientos de computacion: la capacidad'),
(4, '[d]', 'Analisis de Problemas: La capacidad'),
(5, '[e]', 'Analisis de Problemas: La capacidad'),
(6, '[f]', 'Analisis de Problemas: La capacidad');

INSERT INTO indicadors (id, codigo, detalle) VALUES
(1, 'A1', 'Aplica conocimientos de ciencias'),
(2, 'A2', 'Maneja y utiliza herramientas');