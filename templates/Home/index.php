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

<h1 class="">
    Welcome to my website!
</h1>

<div id="purpose">
    <h2 class="">
        The purpose of this website
    </h2>
    <div class="paragraph">
    Hello, welcome to my website. There are several reasons why I decided to create this website.
        <ul class="">
            <li class="">
                To practice writing English. I'm writing a blog, it's more like an diary though.
                There, I want to share my story and my thought about living in Murica.
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

<div class="pt-5" id="interest">
    <h2 class="">
        My Hobbies and interests
    </h2>
    <div class="paragraph">
    I like working out. I started lifting weights when I was 19 years old. Since then, I liked to gain
    some muscles on my body but recently, I got more into olympic weightlifting. Though I planned to 
    start weightlifting in America, I still cannot find places to learn basics becuase of covid.<br><br>
    I'm into cars, too. Especially what people call JDM(Japanese Dometic Market) cars. My most favorite car is
    Toyots's Chaser (JZX100). Of course Cresta and MarkII are nice as well. My grandfather recently gave up
    his MarkII (GX100), one of my dreams is to cutomize his car, like swapping engines(G->1JZ) and transmissions 
    and go like ... vuuuuuuuu⤴︎ pshusllshsuslsus⤵︎<br><br>
    Also, listening to music is one of my favorite things to do. I usually listen to Japanese songs. Here are
    some of my most-liked artists.
        <ul class="">
            <li class="">
                Kariyushi 58 (from Okinawa) &nbsp;
                <a href="https://music.apple.com/us/artist/kariyushi-58/128915911" target="_blank">
                    Apple Music
                </a>
            </li>
            <li class="">
                Mongol 800 (from Okinawa) &nbsp;
                <a href="https://music.apple.com/us/artist/mongol800/202191113" target="_blank">
                    Apple Music
                </a>
            </li>
            <li class="">
                Taiga Yogi (my friend) &nbsp;
                <audio controls preload="none" class="py-3">
                    <source src="audio/recording.m4a" type="audio/mp4" />
                    <source src="audio/recording.mp3" type="audio/mp3" />
                    Your browser does not support the <code>audio</code> element.
                </audio>
            </li>
        </ul>
    </div>
</div>

<div class="intro pt-5">
    <h2 class="">
        About Me
    </h2>
    <div class="paragraph">
        My name is Kohei (by the way, it's 'koh-hey' not 'koh-ee'). I'm from Okinawa, Japan,
        currently, an international MS computer science student at UCF. Expectedly, I will graduate in May, 2022...
        I mean ... hopefully.
    </div>
    <div class="row-photo row justify-content-end pt-3">
        <div class="col-4">
            <?= $this->Html->image('home/formal.jpg', [
                'alt' => 'me',
                'id' => 'photoOfMe',
                'class' => [
                    'rounded-circle',
                    'mx-auto d-block',
                ]
            ]) ?>
        </div>
        <div class="col-4 d-flex flex-column my-auto">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" 
                onchange="changePhoto('formal')" checked>
                <label class="form-check-label" for="flexRadioDefault1"> Formal AF </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" 
                onchange="changePhoto('smug3')">
                <label class="form-check-label" for="flexRadioDefault2"> When I get you</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3" 
                onchange="changePhoto('smug2')">
                <label class="form-check-label" for="flexRadioDefault3"> When I'm home alone </label>
            </div>
            <!-- <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4" 
                onchange="changePhoto('huh')">
                <label class="form-check-label" for="flexRadioDefault4"> When I'm playing poker </label>
            </div> -->
            <!-- <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault5" 
                onchange="changePhoto('dream')">
                <label class="form-check-label" for="flexRadioDefault5"> Me in my dream </label>
            </div> -->
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault6" 
                onchange="changePhoto('smile')">
                <label class="form-check-label" for="flexRadioDefault6"> Smile </label>
            </div>
        </div>
    </div>
</div>
