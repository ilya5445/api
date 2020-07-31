# api

Получение списка отзывов GET
/api/reviews/review_list.php

Параметры:
page - указывается номер страницы
sort - ASC и DESC.
field - rating и create

Получение отзыва GET
/api/reviews/search.php

Параметры:
s - параметр поиска
fields - через запятую дополнительные поля (description - описание, allphoto - все фото)

Создание отзыва POST
/api/reviews/create.php

Параметры:
user - имя
rating - рейтинг
description - описание
photo - массив с ссылками на фото
