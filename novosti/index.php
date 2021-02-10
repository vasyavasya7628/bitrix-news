<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новости");
?>

<section class="press-center" data-controller="view-more">
  <header class="press-center__header">
    <h1 class="light">Новости</h1>
  </header>
  <div class="press-center__articles press-center__articles--wide-list" data-target="view-more.container">

    <article class="news-important" style="background-image: url(<?=ASSET_PATH?>stub/1.jpg)">
      <a href="/article.html" class="news-important__link">
        <h2 class="news-important__title">
          Стартовал прием заявок на&nbsp;I&nbsp;конкурс президентских
          грантов 2020&nbsp;года! Желающие уже с&nbsp;1 марта
          2020&nbsp;года получить грант Президента
        </h2>
      </a>
      <time class="news-important__publication-date" datetime="2019-10-15">15 октября 2019</time>
    </article>
    <article class="news news--wide">
      <div class="news__publication-info">
        <a href="/article.html" class="news__link">
          <h3 class="news__title content-block">
            <mark>
              Общественная палата&nbsp;РФ будет продвигать методические
              указания по&nbsp;госзакупкам услуг в&nbsp;сфере отлова
              и&nbsp;содержания животных без владельцев.
            </mark>
            <span>
              &nbsp;15&nbsp;ноября поговорили о&nbsp;проблемах
              правоприменения закона &laquo;Об&nbsp;ответственном обращении
              с&nbsp;животными&raquo;
            </span>
          </h3>
        </a>
        <time class="news__publication-date" datetime="2019-11-08">8 ноября 2019</time>
      </div>
      <div class="news__illustration" style="background-image: url(<?=ASSET_PATH?>stub/7.jpg)"></div>
    </article>
    <article class="news news--wide">
      <div class="news__publication-info">
        <a href="/article.html" class="news__link">
          <h3 class="news__title content-block">
            <mark>
              #ЩедрыйВторник пройдет 3&nbsp;декабря.
            </mark>
            <span>
              В&nbsp;100&nbsp;странах, включая Россию, в&nbsp;четвертый раз
              пройдет Международный день благотворительности
              #ЩедрыйВторник. Миллионы людей объединяются для проведения
              благотворительных мероприятий, вдохновляют других
              на&nbsp;добрые дела.
            </span>
          </h3>
        </a>
        <time class="news__publication-date" datetime="2019-10-24">24 октября 2019</time>
      </div>
      <div class="news__illustration" style="background-image: url(<?=ASSET_PATH?>stub/8.jpg)"></div>
    </article>
    <article class="news news--wide">
      <div class="news__publication-info">
        <a href="/article.html" class="news__link content-block">
          <h3 class="news__title">
            Заседание рабочей группы Общественной палаты Ямала
            по&nbsp;формированию системы гуманного обращения
            с&nbsp;животными
          </h3>
        </a>
        <time class="news__publication-date" datetime="2019-09-27">27 сентября 2019</time>
      </div>
      <div class="news__illustration" style="background-image: url(<?=ASSET_PATH?>stub/9.jpg)"></div>
    </article>
    <article class="news news--wide">
      <div class="news__publication-info">
        <a href="/article.html" class="news__link content-block">
          <h3 class="news__title content-block">
            <mark>
              На&nbsp;Ямале реализуется общественно-образовательный проект
              &laquo;Ямальские молодёжные инициативы&raquo;.
            </mark>
            <span>
              Его участники могут получить гранты в&nbsp;размере 200, 150
              и&nbsp;100&nbsp;тыс. рублей на&nbsp;реализацию своего
              социально-ориентированного проекта
            </span>
          </h3>
        </a>
        <time class="news__publication-date" datetime="2019-11-14">14 ноября 2019</time>
      </div>
      <div class="news__illustration" style="background-image: url(<?=ASSET_PATH?>stub/10.jpg)"></div>
    </article>
    <article class="news news--wide">
      <div class="news__publication-info">
        <a href="/article.html" class="news__link content-block">
          <h3 class="news__title content-block">
            <mark>
              Форум добровольцев Ямала соберет более 300&nbsp;участников.
            </mark>
            <span>
              В&nbsp;Новом Уренгое 13&nbsp;и&nbsp;14&nbsp;декабря пройдет
              форум добровольцев Ямала. Это долгожданное событие для
              волонтерского движения автономного округа
            </span>
          </h3>
        </a>
        <time class="news__publication-date" datetime="2019-11-14">14 ноября 2019</time>
      </div>
      <div class="news__illustration" style="background-image: url(<?=ASSET_PATH?>stub/4.jpg)"></div>
    </article>
  </div>
  <div class="grid-container">
    <a class="press-center__view-more button button--inverted" href="press-center.html" data-target="view-more.button"
      data-action="view-more#load">Показать более ранние материалы</a>
  </div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>