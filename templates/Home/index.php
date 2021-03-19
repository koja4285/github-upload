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


<div class="bg-group-shot">
    <h1 class="text-white" id="">
        Welcome to my website!
    </h1>
</div>

<div class="row text-center block text-white" id="purpose">
    <h2 class="text-white">
        The purpose of this website
    </h2>
    <h4 class="paragraph text-white">
        Hello, welcome to my website. There are several reasons why I decided to create this website.
    </h4>
    <div class="row text-start">
        <div class="col">
            1. To practice writing English. I'm writing a blog, it's more like an diary though.
            There, I want to share my story and my thought about living in Murica.
        </div>
        <div class="col">
            2. To put together my portfolios. I want to gather them in one place.
        </div>
        <div class="col">
            3. To practice developing website. I needed a personal side project I truly enjoy.
        </div>
    </div>
</div>

<div class="row text-center block" id="hobby">
    <h2 class="mb-3">
        My Hobbies and interests
    </h2>
    <div class="row">
        <div class="col">
            <h4><i class="bi bi-gear"></i>&nbspCARS</h4>
            <div class=" text-start">
                Especially what people call JDM(Japanese Dometic Market) cars. My most favorite car is
                Toyots's Chaser tourerV (JZX100). Cresta and MarkII are nice as well. My grandfather recently gave up
                his MarkII (GX100), one of my dreams is to cutomize his car, like swapping engines(G->1JZ) and transmissions 
                and go like ... vuuuuuuuu⤴︎ pshusllshsuslsus⤵︎
            </div>
        </div>
        <div class="col">
            <h4><i class="bi bi-music-player"></i>&nbspMUSIC</h4>
            <div class="text-start">
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
        <div class="col">
            <h4><i class="bi bi-shield-plus"></i>&nbspWORK OUT</h4>
            <div class="text-start">
                I'm into olympic weightlifting. Though I planned to 
                start olympic weightlifting in America, I still cannot find places to learn becuase of covid.
            </div>
        </div>
    </div>
</div>

<div class="row text-center block text-white" id="about-me">
    <h2 class="text-white">
        About Me
    </h2>
    <div class="row text-start">
        <div class="col">
            My name is Kohei Koja (by the way, it's 'koh-hey' not 'koh-ee'). I'm from Okinawa, Japan,
            currently, an international MS computer science student at UCF. Expectedly, I will graduate in May, 2022...
            I mean ... hopefully.
        </div>
        <div class="col" id="photo-col">
            <?= $this->Html->image('home/listening_to_the_heart.jpg', [
                'alt' => 'me',
                'id' => 'photoOfMe',
                'class' => [
                    'rounded-circle',
                    'mx-auto d-block',
                ]
            ]) ?>
        </div>
        <div class="col d-flex flex-column my-auto" id="select-col">
            <!-- <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault0" 
                onchange="changePhoto('formal')" checked>
                <label class="form-check-label" for="flexRadioDefault0"> Formal AF </label>
            </div> -->
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" 
                onchange="changePhoto('listening')" checked>
                <label class="form-check-label" for="flexRadioDefault1"> Listening to music </label>
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