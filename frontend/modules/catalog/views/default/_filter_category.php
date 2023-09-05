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

      <?= $this->render('_sort', [
          'searchModel' => $searchModel
      ]); ?>

    </div>
  </div>
</div>