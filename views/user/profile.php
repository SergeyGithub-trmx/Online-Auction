<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = Yii::$app->name . ' | Профиль';

$accordion_items = [
    [
        'label' => 'Зарегистрирован',
        'body' => '[registration time]'
    ],
    [
        'label' => 'Последняя активность',
        'body' => '[last seen time]'
    ],
    [
        'label' => 'Страна',
        'body' => '[country here]'
    ],
    [
        'label' => 'Город',
        'body' => '[town/city here]'
    ],
    [
        'label' => 'Рейтинг',
        'body' => '[rating here]'
    ]
];

?>
<section class="section-min-height section-py">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h1 class="fs-2">Профиль</h1>
                <div class="accordion mt-4" id="accordionPanelsStayOpenExample">

                    <?php foreach ($accordion_items as $i => $item): ?>
                        <div class="accordion-item border-secondary">
                            <h2 class="accordion-header">
                                <button
                                    class="accordion-button collapsed fw-bold"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapse<?= $i ?>"
                                    aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapse<?= $i ?>"
                                ><?= Html::encode($item['label']) ?></button>
                            </h2>
                            <div id="panelsStayOpen-collapse<?= $i ?>" class="accordion-collapse collapse">
                                <div class="accordion-body"><?= Html::encode($item['body']) ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</section>