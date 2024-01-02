<div class="catalog-bar mb-m">
  <div class="container">
    <div class="catalog-bar__wrapper">

      <div class="swiper catalog-bar__btn-wrapper">
        <div class="swiper-wrapper">

          <div class="swiper-slide">
            <button class="catalog-bar__btn catalog-bar__btn--filter btn-reset" type="button">
              <?= Yii::t('app', 'Filter Block'); ?>
              <svg>
                <use xlink:href="/img/sprite.svg#chevron-right"></use>
              </svg>
            </button>
          </div>

          <div class="swiper-slide mob-dis">
            <!-- TODO вставить id -->
              <label for="is_available" class="catalog-bar__btn btn-reset filter__category" data-search-name="is_available" data-search-value="1" type="button" <?= $searchModel->isAvailableActive(); ?>>
                <?= Yii::t('app', 'Only Available'); ?>
            </label>
          </div>

          <?php if (isset($groups) && !empty($groups)) : ?>
            <?php foreach ($groups as $group) : ?>
              <div class="swiper-slide mob-dis">
                <label for="<?= $group->id; ?>" class="catalog-bar__btn btn-reset filter__category" data-search-name="group_id[]" data-search-value="<?= $group->id; ?>" type="button" <?= $searchModel->isCategoryActive($group->id); ?>>
                  <?= $group->name; ?>
                </label>
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