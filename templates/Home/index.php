<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @author    Kohei Koja
 */

echo $this->Html->css('koja_home', ['block' => 'css']);
echo $this->Html->script('home', ['block' => 'script']);
?>

<div class="purpose">
    <h1 class="">
        The purpose of this website
    </h1>
    <div class="fs-2">
    Hello, welcome to my website. There are several reasons why I decided to create this website.
        <ul class="">
            <li class="">
                To practice writing English. I'm creating a blog, it's more like an diary though.
                There, I want to share my story and my thought about living in different culture.
            </li>
            <li class="">
                To put together my portfolios. I want to gather them in one place.
            </li>
            <li class="">
                To practice developing website. I needed a personal side project I truly enjoy.
            </li>
        </ul>
    </div>
</div>

<div class="intro pt-5">
    <h1 class="">
        About Me
    </h1>
    <div class="fs-2">
        My name is Kohei (by the way, it's 'koh-hey' not 'koh-ee'). I'm from Okinawa, Japan,
        currently, an international MS computer science student at UCF. Expectedly, I will graduate in May, 2022.
    </div>
    <div class="row-photo row justify-content-end pt-3">
        <div class="col-4">
            <?= $this->Html->image('formal.jpg', [
                'alt' => 'formal',
                'id' => 'photoOfMe',
                'class' => [
                    'rounded-circle',
                    'mx-auto d-block'
                ]
            ]) ?>
        </div>
        <div class="col-4 d-flex flex-column my-auto">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" 
                onchange="changePhoto('formal')" checked>
                <label class="form-check-label" for="flexRadioDefault1"> Formal </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" 
                onchange="changePhoto('smug1')">
                <label class="form-check-label" for="flexRadioDefault2"> Smug 1 </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3" 
                onchange="changePhoto('smug2')">
                <label class="form-check-label" for="flexRadioDefault3"> Smug 2 </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4" 
                onchange="changePhoto('smile')">
                <label class="form-check-label" for="flexRadioDefault4"> Smile </label>
            </div>
        </div>
    </div>
</div>
