# Веб-приложение для розыгрыша призов.

## Задание

После аутентификации пользователь может нажать на кнопку и получить случайный приз. 

Призы бывают 3х типов:

**Денежный приз**
- случайная сумма в интервале,
- может быть перечислен на счет пользователя в банке (HTTP запрос к API банка),
- может конвертироваться в баллы лояльности с учетом коэфициэнта.

**Бонусные баллы**
- случайная сумма в интервале, 
- могут быть зачислены на счет лояльности в приложении.

**Физический предмет**
- случайный предмет из списка, 
- может быть отправлен по почте (вручную работником).

От приза можно отказаться. 
Деньги и предметы ограничены, баллы лояльности - нет.

1. Нужно предоставть коротокое описание решения для коллеги не-программиста или менеджера 
   (например UML диаграммы, структура БД, мокапы интерфейса и т.п.).
2. Нужно предоставить прототип в PHP 5.6 или 7 без использования фреймворков и сторонних библиотек 
   для анализа коллегами программистами. Не обязательно использовать БД, данные можно хранить как угодно, 
   например, в файле на сервере.
3. Нужно добавить HTML разметку, CSS стили и JS скрипт для получения приза без перезагрузки страницы, 
   что бы показать прототип заказчику.
4. Реализация с помощью фреймворка (можно любой, но лучше Yii или Yii2), использованием БД.
5. Нужно добавить консольную команду которая будет отправлять денежные призы на счета пользователей, 
   которые еще не были отправлены, пачками по N штук.
6. Добавить юнит-тест конвертирования денежного приза в баллы лояльности.
