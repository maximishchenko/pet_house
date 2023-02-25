
<div class="container">
  <div class="breadcrumbs">
    <a class="breadcrumbs__link" href="#">Главная</a>
    <span class="breadcrumbs__space">/</span>
    <a class="breadcrumbs__link" href="#">Шиншиллы</a>
    <span class="breadcrumbs__space">/</span>
    <a class="breadcrumbs__link" href="#">Витрины для шиншилл, дегу</a>
    <span class="breadcrumbs__space">/</span>
    <a class="breadcrumbs__link breadcrumbs__link--dis">D10 Двойная витрина</a>
  </div>
</div>

<!-- <main class="main"> -->
    <div class="container">
        <section class="product">
            <div class="product__col">
            
                <!-- Галлерея -->
                <?= $this->render('product/_gallery', []); ?>

                <div class="product__optional">
                    <!-- Аксессуары -->
                    <?= $this->render('product/_accessories', []); ?>

                    <!-- Промо -->
                    <?= $this->render('product/_promo', []); ?>

                    <!-- Отзывы -->
                    <?= $this->render('product/_faq', []); ?>

                    <!-- Вопросы и ответы -->
                    <?= $this->render('product/_review', []); ?>
                </div>

            </div>

          <!-- Конструктор -->
          <?= $this->render('product/_sidebar', []); ?>

        </section>
      </div>
    
      <!-- Хиты продаж -->
      <?= $this->render('product/_top_sales', []); ?>

    </main>


    <?= $this->render('product/_subscribe', []); ?>

<?= $this->render('product/_faq_bottom', []); ?>