<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
\Bitrix\Main\Loader::IncludeModule("kvant.news");
\Bitrix\Main\Loader::includeModule('iblock');

use \kvant\Lists\Lists;
?>

<div id="news-container">
    <!-- News items will be inserted here -->

    <div class="news-item">
        <div class="news-image">
            <img src="https://images.unsplash.com/photo-1570126618953-d437176e8c79?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=988&q=80" alt="news image 1">
        </div>
        <div class="news-text">
            <div class="news-title">
                Компания XYZ открывает новый офис в Москве
            </div>
            <div class="news-desc">
                В центре Москвы открылся новый офис компании XYZ. Компания планирует нанять 100 новых сотрудников в ближайшие 6 месяцев.
            </div>
        </div>
    </div>

    <div class="news-item">
        <div class="news-image">
            <img src="https://images.unsplash.com/photo-1599583863916-e06c29087f51?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2568&q=80" alt="news image 1">
        </div>
        <div class="news-text">
            <div class="news-title">
                Инновационный стартап ABC планирует расширение
            </div>
            <div class="news-desc">
                ABC, стартап в области технологий, планирует открыть новый офис в технопарке Сколково. Руководство компании надеется привлечь талантливых разработчиков и ускорить рост бизнеса.
            </div>
        </div>
    </div>

    <div class="news-item">
        <div class="news-image">
            <img src="https://images.unsplash.com/photo-1570126618953-d437176e8c79?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=988&q=80" alt="news image 2">
        </div>
        <div class="news-text">
            <div class="news-title">
                DEF Corp успешно привлекла инвестиции
            </div>
            <div class="news-desc">
                DEF Corp, ведущая компания в сфере ИИ, успешно закрыла раунд инвестиций, привлек 10 млн долларов. Деньги планируется использовать для разработки новых продуктов и масштабирования бизнеса.
            </div>
        </div>
    </div>


</div>

<style>

    .news-item {
        display: flex;
        border: 1px solid #ddd;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        max-width: 600px;
    }

    .news-title {
        font-weight: bold;
        font-size: 1.2em;
    }

    .news-desc {
        margin-top: 10px;
    }

    .news-image img {
        width: 350px;
        height: 350px;
        object-fit: cover;
        border-radius: 5px;
    }

    .news-text {
        margin-left: 15px;
    }
</style>
