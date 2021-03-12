<?php

use common\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;

use yii\widgets\ActiveForm;

$this->params['breadcrumbs'][] = Yii::t('app', 'account');

?>

<!-- personal page headline -->
<div class="pers-headline container">
    <p class="pers-headline__title"><?= Yii::t('app', 'Personal details') ?></p>
    <div class="pers-headline__wrap">
        <a href="<?= Url::to(['default/edit']) ?>" class="link link_blue-ud-line pers-headline__link pers-headline__link_pen"><?= Yii::t('app', 'Edit') ?></a>
        <a href="#" class="link link_blue-ud-line pers-headline__link uk-hidden@m"><?= Yii::t('app', 'Cancel') ?></a>
    </div>
</div>
<!-- personal page headline end -->


<!-- personal page -->
<div class="container pers-pg">
    <div uk-grid="">
        <div class="uk-width-5-12@l">
            <div class="wrapper-fm">
                <p class="wrapper-fm__title"><?= Yii::t('app', 'Personal details') ?></p>
                <div class="form ">
                    <div class="form__grid form__grid_data">
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__title"><?= $model->getAttributeLabel('first_name') ?></p>
                        </div>
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__user-data"><?= $model->first_name ?></p>
                        </div>
                    </div>
                    <div class="form__grid form__grid_data">
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__title"><?= $model->getAttributeLabel('middle_name') ?></p>
                        </div>
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__user-data"><?= $model->middle_name ?></p>
                        </div>
                    </div>
                    <div class="form__grid form__grid_data">
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__title"><?= $model->getAttributeLabel('surname') ?></p>
                        </div>
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__user-data"><?= $model->surname ?></p>
                        </div>
                    </div>
                    <div class="form__grid form__grid_data">
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__title"><?= $model->getAttributeLabel('birthdayDateFormatted') ?></p>
                        </div>
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__user-data"><?= $model->birthdayDateFormatted ?></p>
                        </div>
                    </div>
                    <div class="form__grid form__grid_data">
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__title"><?= $model->getAttributeLabel('gender') ?></p>
                        </div>
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__user-data"><?= $model->genderText ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wrapper-fm">
                <p class="wrapper-fm__title"><?= Yii::t('app', 'Identification') ?></p>
                <div class="form ">
                    <div class="form__grid form__grid_data">
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__title"><?= $model->getAttributeLabel('passport_number') ?></p>
                        </div>
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__user-data"><?= $model->passport_number ?></p>
                        </div>
                    </div>
                    <div class="form__grid form__grid_data">
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__title"><?= $model->getAttributeLabel('passport_country_id') ?></p>
                        </div>
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__user-data"><?= $model->countryName ?></p>
                        </div>
                    </div>
                    <div class="form__grid form__grid_data">
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__title"><?= $model->getAttributeLabel('passport_date_issue') ?></p>
                        </div>
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__user-data"><?= $model->passportCountryName ?></p>
                        </div>
                    </div>
                    <div class="form__grid form__grid_data">
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__title"><?= $model->getAttributeLabel('passport_date_expiry') ?></p>
                        </div>
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__user-data"><?= $model->passportDateIssueFormatted ?></p>
                        </div>
                    </div>
                    <div class="form__grid form__grid_data">
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__title"><?= Yii::t('app', 'Passport/ID') ?></p>
                        </div>
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__user-data <?= $model->passportDocs ? 'valid' : 'invalid' ?>"></p>
                        </div>
                    </div>
                    <div class="form__grid form__grid_data">
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__title"><?= Yii::t('app', 'Working permit (Visa)') ?></p>
                        </div>
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__user-data <?= $model->workDocs ? 'valid' : 'invalid' ?>"></p>
                        </div>
                    </div>
                </div>
            </div>
            <a href="<?= Url::to(['default/change-password']) ?>" class="link link_blue-ud-line pers-pg__link uk-visible@l"><?= Yii::t('app', 'Change password') ?></a>
        </div>
        <div class="uk-width-7-12@l">
            <div class="wrapper-fm">
                <p class="wrapper-fm__title"><?= Yii::t('app', 'Adresses') ?></p>
                <div class="uk-child-width-1-1" uk-grid="">
                    <div>
                        <div class="form ">
                            <div class="form__grid form__grid_data">
                                <div class="form__grid-el form__grid-el_4-6">
                                    <p class="form__title"><?= $model->getAttributeLabel('address') ?></p>
                                </div>
                                <div class="form__grid-el form__grid-el_4-6">
                                    <p class="form__user-data"><?= $model->address ?></p>
                                </div>
                            </div>
                            <div class="form__grid form__grid_data">
                                <div class="form__grid-el form__grid-el_4-6">
                                    <p class="form__title"><?= $model->getAttributeLabel('city') ?></p>
                                </div>
                                <div class="form__grid-el form__grid-el_4-6">
                                    <p class="form__user-data"><?= $model->city ?></p>
                                </div>
                            </div>
                            <div class="form__grid form__grid_data">
                                <div class="form__grid-el form__grid-el_4-6">
                                    <p class="form__title"><?= $model->getAttributeLabel('zipcode') ?></p>
                                </div>
                                <div class="form__grid-el form__grid-el_4-6">
                                    <p class="form__user-data"><?= $model->zipcode ?></p>
                                </div>
                            </div>
                            <div class="form__grid form__grid_data">
                                <div class="form__grid-el form__grid-el_4-6">
                                    <p class="form__title"><?= $model->getAttributeLabel('province') ?></p>
                                </div>
                                <div class="form__grid-el form__grid-el_4-6">
                                    <p class="form__user-data"><?= $model->province ?></p>
                                </div>
                            </div>
                            <div class="form__grid form__grid_data">
                                <div class="form__grid-el form__grid-el_4-6">
                                    <p class="form__title"><?= $model->getAttributeLabel('country_id') ?></p>
                                </div>
                                <div class="form__grid-el form__grid-el_4-6">
                                    <p class="form__user-data"><?= $model->countryName ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wrapper-fm">
                <p class="wrapper-fm__title"><?= Yii::t('app', 'Contacts') ?></p>
                <div class="form ">
                    <div class="form__grid form__grid_data">
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__title"><?= $model->getAttributeLabel('phone') ?></p>
                        </div>
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__user-data"><?= $model->phone ?></p>
                        </div>
                    </div>
                    <div class="form__grid form__grid_data">
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__title"><?= $model->getAttributeLabel('phone_1') ?></p>
                        </div>
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__user-data"><?= $model->phone_1 ?></p>
                        </div>
                    </div>
                    <div class="form__grid form__grid_data">
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__title"><?= $model->getAttributeLabel('email') ?></p>
                        </div>
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__user-data form__user-email"><?= $model->email ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wrapper-fm">
                <p class="wrapper-fm__title"><?= Yii::t('app', 'Place of work') ?></p>
                <div class="form ">
                    <div class="form__grid form__grid_data">
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__title"><?= $model->getAttributeLabel('work_place') ?></p>
                        </div>
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__user-data"><?= $model->work_place ?></p>
                        </div>
                    </div>
                    <div class="form__grid form__grid_data">
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__title"><?= $model->getAttributeLabel('work_name') ?></p>
                        </div>
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__user-data"><?= $model->work_name ?></p>
                        </div>
                    </div>
                    <div class="form__grid form__grid_data">
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__title"><?= $model->getAttributeLabel('work_permit') ?></p>
                        </div>
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__user-data"><?= $model->workingPermitText ?></p>
                        </div>
                    </div>
                    <div class="form__grid form__grid_data">
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__title"><?= $model->getAttributeLabel('work_valid_until') ?></p>
                        </div>
                        <div class="form__grid-el form__grid-el_4-6">
                            <p class="form__user-data"><?= $model->workValidUntilFormatted ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="<?= Url::to(['default/change-password']) ?>" class="link link_blue-ud-line pers-pg__link uk-hidden@l"><?= Yii::t('app', 'Change password') ?></a>
</div>
<!-- login page end -->

