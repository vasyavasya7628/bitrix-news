<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новости");
?>

<section class="article">
  <header class="article__header">
    <h1 class="article__title">На&nbsp;Ямале непогода повлияла на&nbsp;работу транспорта</h1>
    <time class="article__publication-date" datetime="2019-06-13">13 июня 2019</time>
    <a class="back-link" href="/novosti/">
      <svg class="icon" role="img">
        <use xlink:href="<?=ASSET_PATH?>icons.svg#dropdown-arrow" /></svg>
      Пресс-центр
    </a>
  </header>
  <div class="article__content-wrapper">
    <div class="article__lead content-block">
      Лид&nbsp;&mdash; краткое изложение содержимого статьи. Например:
      &laquo;В&nbsp;пятницу, 14&nbsp;июня, на&nbsp;Ямале объявлен штормовой
      прогноз. Ожидаются неблагоприятные погодные условия: ночью
      по&nbsp;востоку округа сильные осадки&nbsp;&mdash; дождь, мокрый
      снег&raquo;.
      <br>
      Лид не&nbsp;является обязательным элементом статьи
    </div>
  </div>
  <div class="article__content-wrapper">
    <div class="article__content content-block">
      <img src="<?=ASSET_PATH?>stub/11.jpg" alt="Красивое изображение">
      <div class="image-caption">
        Подпись к&nbsp;фотографии. Как и&nbsp;сама фотография не&nbsp;является необходимой
      </div>
      <h2>Текстовые блоки</h2>
      Используется стандартный шрифт основного текста&nbsp;P (18, 28,
      #333333), отступ между абзацами&nbsp;&mdash; 20.
      <br>
      По&nbsp;данным Ямало-Ненецкого ЦГМС&nbsp;&mdash; филиала ФГБУ
      &laquo;Обь-Иртышского УГМС&raquo;, на&nbsp;территории округа
      прогнозируется неблагоприятное погодное явление: ночью
      по&nbsp;востоку округа сильные осадки (мокрый снег, дождь). Ветер
      северо-западный 6-11&nbsp;м/с., в&nbsp;Приуральском, Шурышкарском,
      Надымском, Тазовском районах порывы до&nbsp;16-21&nbsp;м/с.
      Температура ночью: &minus;1 до + 4. Температура днем: +2...+7.
      <h3>Цитаты</h3>
      Служат для выделения в&nbsp;тексте прямой речи. Данным блоком
      не&nbsp;рекомендуется злоупотреблять и&nbsp;не&nbsp;следует оформлять
      с&nbsp;его помощью большие массивы текста.
      Фотография необязательна.
      <blockquote class="blockquote" data-controller="polar-lights-masked"
        data-action="mousemove->polar-lights-masked#updateMaskPosition">

        Один паром у&nbsp;нас сегодня все-таки перевёз несколько автомашин.
        На&nbsp;11&nbsp;часов утра ветер на&nbsp;реке в&nbsp;районе переправы
        Салехард-Лабытнанги усилился до&nbsp;25&nbsp;метров в&nbsp;секунду. Паромы
        остановились. Прекращены также все перевозки водным транспортом. Из-за сильного
        северо-восточного ветра из&nbsp;аэропорта Салехард временно прекращён
        приём-выпуск вертолётных рейсов. Самолёты летают в&nbsp;штатном режиме
        <div class="person-info">
          <img class="person-info__photo" src="<?=ASSET_PATH?>stub/12.jpg" alt="Виталий Лагутин">
          <div class="person-info__description">
            <span class="person-info__name">Виталий Лагутин</span>
            <span class="person-info__position">директор дирекции транспорта ЯНАО</span>
          </div>
        </div>
        <div class="polar-lights polar-lights--dim">
          <div class="polar-lights__mask" data-target="polar-lights-masked.mask"></div>
        </div>
      </blockquote>
      Изображения помещаются в&nbsp;родительский контейнер шириной
      во&nbsp;всю область контента (для десктопов&nbsp;&mdash;
      6&nbsp;колонок сетки, 1120px) и&nbsp;максимальной высотой
      630&nbsp;px&nbsp;&mdash; пропорции 16&times;9. Внутри контейнера
      картинка масштабируется по&nbsp;наибольшей метрике. Искажение
      пропорций и&nbsp;кадрирование не&nbsp;допускается.
      <img src="http://placekitten.com/g/1520/1080" alt="Котик">
      <img src="http://placekitten.com/g/1080/1920" alt="Котик">
      <h3>Списки и&nbsp;ссылки в&nbsp;тексте</h3>
      <span>
        В&nbsp;дизайн-системе описывается построение маркированных
        и&nbsp;нумерованных списков, а&nbsp;также ссылок&nbsp;&mdash;
        <a href="http://standart.gov.design/design/typography" target="_blank"
          rel="nofollow noopener">http://standart.gov.design/design/typography</a>
      </span>
      <br>
      Вот так выглядит маркированный список с&nbsp;вложенными нумерованными и&nbsp;маркированными:
      <ul>
        <li>
          <!--
           -->заявление
          <ol>
            <li>
              <!--
               -->Первый пункт
              <ol>
                <li>Первый подпункт</li>
                <li>Второй подпункт</li>
                <li>Третий подпункт</li>
              </ol>
            </li>
            <li>
              <!--
               -->Второй пункт
              <ul>
                <li>Первый подпункт</li>
                <li>Второй подпункт</li>
                <li>Третий подпункт</li>
              </ul>
            </li>
            <li>Третий пункт</li>
            <li>Четвертый пункт</li>
            <li>Пятый пункт</li>
            <li>Шестой пункт</li>
            <li>Седьмой пункт</li>
            <li>Восьмой пункт</li>
            <li>Девятый пункт</li>
            <li>Десятый пункт</li>
            <li>Одиннадцатый пункт</li>
          </ol>
        </li>
        <li>
          <!--
           -->документ, удостоверяющий вашу личность:
          <ul>
            <li>
              <!--
               -->Паспорт
              <ol>
                <li>Первый подпункт</li>
                <li>Второй подпункт</li>
                <li>Третий подпункт</li>
              </ol>
            </li>
            <li>
              <!--
               -->Водительские права
              <ul>
                <li>Первый подпункт</li>
                <li>Второй подпункт</li>
                <li>Третий подпункт</li>
              </ul>
            </li>
            <li>Свидетельство о&nbsp;рождении</li>
          </ul>
        </li>
        <li>СНИЛС</li>
      </ul>
      <h4>Сложный нумерованный список</h4>
      <ol>
        <li>
          <!--
           -->заявление
          <ul>
            <li>
              <!--
               -->Первый пункт
              <ul>
                <li>Первый подпункт</li>
                <li>Второй подпункт</li>
                <li>Третий подпункт</li>
              </ul>
            </li>
            <li>
              <!--
               -->Второй пункт
              <ol>
                <li>Первый подпункт</li>
                <li>Второй подпункт</li>
                <li>Третий подпункт</li>
              </ol>
            </li>
            <li>Третий пункт</li>
            <li>Четвертый пункт</li>
            <li>Пятый пункт</li>
            <li>Шестой пункт</li>
            <li>Седьмой пункт</li>
            <li>Восьмой пункт</li>
            <li>Девятый пункт</li>
            <li>Десятый пункт</li>
            <li>Одиннадцатый пункт</li>
          </ul>
        </li>
        <li>
          <!--
           -->документ, удостоверяющий вашу личность:
          <ol>
            <li>
              <!--
               -->Паспорт
              <ul>
                <li>Первый подпункт</li>
                <li>Второй подпункт</li>
                <li>Третий подпункт</li>
              </ul>
            </li>
            <li>
              <!--
               -->Водительские права
              <ol>
                <li>Первый подпункт</li>
                <li>Второй подпункт</li>
                <li>Третий подпункт</li>
              </ol>
            </li>
            <li>Свидетельство о&nbsp;рождении</li>
          </ol>
        </li>
        <li>СНИЛС</li>
      </ol>
    </div>
  </div>
</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>