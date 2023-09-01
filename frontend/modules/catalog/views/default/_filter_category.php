<div class="catalog-bar mb-m">
  <div class="container">
    <div class="catalog-bar__wrapper">

      <div class="swiper catalog-bar__btn-wrapper">
        <div class="swiper-wrapper">

          <div class="swiper-slide">
            <button class="catalog-bar__btn catalog-bar__btn--filter btn-reset" type="button">
              Фильтр
              <svg>
                <use xlink:href="/img/sprite.svg#chevron-right"></use>
              </svg>
            </button>
          </div>

          <div class="swiper-slide mob-dis">
            <button class="catalog-bar__btn btn-reset filter__category" data-search-name="is_available" data-search-value="1" type="button" <?= $searchModel->isAvailableActive(); ?>>
              Только в наличии
            </button>
          </div>

          <?php if (isset($categories) && !empty($categories)) : ?>
            <?php foreach ($categories as $category) : ?>
              <div class="swiper-slide mob-dis">
                <button class="catalog-bar__btn btn-reset filter__category" data-search-name="category_id[]" data-search-value="<?= $category->id; ?>" type="button" <?= $searchModel->isCategoryActive($category->id); ?>>
                  <?= $category->name; ?>
                </button>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>

        </div>
      </div>
      <div class="catalog-bar__sort-wrapper catalog-bar__sort-wrapper--active">
        <button class="btn-reset catalog-bar__sort-title">Сортировать по: <i><span class="catalog-bar__sort-title--select">Наименование</span><svg width="11" class="sort-arrow" height="6" viewBox="0 0 11 6" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M1 1L5.5 5L10 1" stroke="#373737" stroke-linecap="round" stroke-linejoin="round" />
            </svg></i></button>
        <div class="catalog-bar__sort-toogle catalog-bar__sort-toogle--active">
          <div class="catalog-bar__sort-list">
            <button class="btn-reset catalog-bar__sort-item">Наименование</button>
            <button class="btn-reset catalog-bar__sort-item">Популярные</button>
            <button class="btn-reset catalog-bar__sort-item catalog-bar__sort-item--active">Дороже</button>
            <button class="btn-reset catalog-bar__sort-item">Дешевле</button>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>