<?php
/**
 * Home Page View
 *
 * Filename:        home.view.php
 * Location:        /App/views
 * Project:         EMD-php-mvc-jokes-2025-s1
 * Date Created:    03/04/2025
 *
 * Author:          Elisha Mutang Daneil <20145565@tafe.wa.edu.au>
 *
 */

/*
 * Decode joke body stored in database and format it to have a <br> tag if there is more than 1 sentence.
 */
$joke_body = html_entity_decode($joke->body);
$joke_body = str_replace(['<p>', '</p>'], ['', '<br>'], $joke_body);

loadPartial('header');
loadPartial('navigation');

?>

<main class="container mx-auto bg-zinc-50 py-8 px-4 shadow shadow-black/25 rounded-lg">
    <article  class="grid grid-cols-1">
        <header class="bg-zinc-700 text-zinc-200 -mx-4 -mt-8 mb-4 p-8 text-2xl font-bold rounded-t-lg">
            <h1>HOMEPAGE</h1>
        </header>

        <section class="my-4 p-4 justify-start">
            <p class="text-4xl font-bold">Welcome to Jokeify!</p>
            <p>Created by Elisha Daneil as part of the EMD-PHP-MVC-Jokes-2025-S1 project.</p>
        </section>
    </article>

    <article  class="grid grid-cols-1">
        <section class="p-4 justify-start">
            <p class="text-2xl font-bold">Push button below for new joke!</p>
            <form method="GET" action="/">
                <button type="submit" class="px-4 py-4 btn-secondary cursor-pointer">New Joke</button>
            </form>
        </section>
    </article>

    <article class="grid grid-cols-2 ">

        <section class="m-4 bg-zinc-200 text-zinc-700 p-8 rounded-lg shadow">
            <dl class="flex flex-col gap-2">

                <dt class="text-lg font-semibold">Featured Joke</dt>
                <dd class="ml-4 flex items-start">
                    <i class="hover:text-black fa-regular fa-face-smile-wink inline-block mr-2 text-sm"></i>
                    <p class="hover:text-black"><?= $joke->title ?></p>
                </dd>
                <dd class="ml-4 flex items-start">
                    <i class="hover:text-black fa-regular fa-face-smile-wink inline-block mr-2 text-sm"></i>
                    <?= $joke_body ?>
                </dd>
            </dl>
        </section>

        <section class="m-4 bg-zinc-200 text-zinc-700 p-8 rounded-lg shadow">
            <dl class="flex flex-col">
                <dt class="text-lg font-semibold ">Tutorial:</dt>
                <dd class="ml-4">
                    <a href="https://github.com/AdyGCode/XXX-SaaS-Vanilla-MVC-YYYY-SN/tree/main/session-07"
                       class="hover:text-black">
                        <i class="fa fa-list inline-block mr-2 text-sm"></i>
                        Parts 00 - 04: https://github.com/AdyGCode/XXX-SaaS-Vanilla-MVC-YYYY-SN/tree/main/session-07
                    </a>
                </dd>
                <dd class="ml-4">
                    <a href="https://github.com/AdyGCode/XXX-SaaS-Vanilla-MVC-YYYY-SN/tree/main/session-08"
                       class="hover:text-black">
                        <i class="fa fa-list inline-block mr-2 text-sm"></i>
                        Parts 05 - 10: https://github.com/AdyGCode/XXX-SaaS-Vanilla-MVC-YYYY-SN/tree/main/session-07
                    </a>
                </dd>
            </dl>
        </section>
        <section class="m-4 bg-zinc-200 text-zinc-700 p-8 rounded-lg shadow">
            <dl class="flex flex-col">
                <dt class="text-lg font-semibold">Source Code:</dt>
                <dd class="ml-4">
                    <a href="https://github.com/elishamutang/EMD-php-mvc-jokes-2025-s1" target="_blank"
                       class="hover:text-black">
                        <i class="fa fa-code inline-block mr-2 text-sm"></i>
                        https://github.com/elishamutang/EMD-php-mvc-jokes-2025-s1
                    </a>
                </dd>
            </dl>
        </section>

        <section class="m-4 bg-zinc-200 text-zinc-700 p-8 rounded-lg shadow">
            <dl class="flex flex-col">

                <dt class="text-lg font-semibold">HelpDesk</dt>
                <dd class="ml-4">
                    <a href="https://help.screencraft.net.au"
                       class="hover:text-black">
                        <i class="fa fa-home inline-block mr-2 text-sm"></i>
                        Home Page
                    </a>
                </dd>
                <dd class="ml-4">
                    <a href="https://help.screencraft.net.au/hc/2680392001"
                       class="hover:text-black">
                        <i class="fa fa-info-circle inline-block mr-2 text-sm"></i>
                        FAQs
                    </a>
                </dd>
                <dd class="ml-4"><a href="https://help.screencraft.net.au/help/2680392001"
                                    class="hover:text-black">
                        <i class="fa fa-question-circle inline-block mr-2 text-sm"></i>
                        Make a HelpDesk Request (TAFE Students only)
                    </a>
                </dd>
            </dl>

        </section>
    </article>
</main>


<?php
loadPartial('footer');
?>
