<?php
/**
 * Home Page View
 *
 * Allows a visitor and a registered user to see a random joke displayed in the middle of the page.
 * If no jokes are present in the database, an appropriate message is showed.
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
if(isset($joke)) {
    $joke_body = html_entity_decode($joke->body);
    $joke_body = str_replace(['<p>', '</p>'], ['', '<br>'], $joke_body);
}

loadPartial('header');
loadPartial('navigation');

?>

<main class="container max-w-9/10 mx-auto bg-zinc-50 py-8 px-4 shadow shadow-black/25 rounded-lg">
    <article  class="grid grid-cols-1">
        <header class="bg-zinc-700 text-zinc-200 -mx-4 -mt-8 mb-4 p-8 text-3xl font-bold rounded-t-lg">
            <?php if (isset($user['nickname'])) : ?>
                <h1 class="tracking-widest"><?= $user['nickname'] ?>'s JOKES DB</h1>
            <?php else : ?>
                <h1 class="tracking-widest">JOKES DB</h1>
            <?php endif; ?>
        </header>

        <section class="my-4 p-4 justify-start">
            <p class="text-4xl font-bold">Welcome to <span class="text-prussianblue-500 tracking-wider">JOKEIFY</span>, a simple jokes system!</p>
            <p class="text-gray-700 mt-2">Created by Elisha Daneil as part of the EMD-PHP-MVC-Jokes-2025-S1 project.</p>
        </section>
    </article>

    <article  class="flex flex-wrap items-start">
        <section class="h-full p-4 justify-start">
            <p class="text-2xl">Generate random joke!</p>
            <form method="GET" action="/">
                <button type="submit" class="w-full px-4 py-4 btn-primary text-xl rounded-lg cursor-pointer">Joke</button>
            </form>
        </section>

        <section class="m-4 bg-zinc-200 text-zinc-700 p-8 rounded-lg shadow-xl grow">

            <?php if(isset($joke)): ?>
                <dl class="flex flex-col gap-2">
                    <dt class="flex text-2xl font-semibold">Featured Joke
                        <span class="px-2">-</span>
                        <h1 class="text-prussianblue-500 text-2xl"><?= $joke->title ?></h1></dt>
                    <dd class="ml-4 flex items-start">
                    </dd>
                    <dd class="ml-4 flex items-start">
                        <i class="hover:text-black fa-regular fa-face-smile-wink inline-block mr-2 text-sm"></i>
                        <?= $joke_body ?>
                    </dd>
                </dl>
            <?php else: ?>
                <dl class="flex flex-col gap-2">
                    <dt class="flex text-2xl font-semibold">No jokes in the system :/</dt>
                    <dd class="ml-4 flex items-start">
                    </dd>
                </dl>
            <?php endif; ?>

        </section>
    </article>

    <article>

<!--        <section class="m-4 bg-zinc-200 text-zinc-700 p-8 rounded-lg shadow-xl">-->
<!--            <dl class="flex flex-col gap-2">-->
<!---->
<!--                <dt class="text-2xl font-semibold">Featured Joke</dt>-->
<!--                <dd class="ml-4 flex items-start">-->
<!--                    <i class="hover:text-black fa-regular fa-face-smile-wink inline-block mr-2 text-sm"></i>-->
<!--                    <h1 class="hover:text-black">--><?php //= $joke->title ?><!--</h1>-->
<!--                </dd>-->
<!--                <dd class="ml-4 flex items-start">-->
<!--                    <i class="hover:text-black fa-regular fa-face-smile-wink inline-block mr-2 text-sm"></i>-->
<!--                    --><?php //= $joke_body ?>
<!--                </dd>-->
<!--            </dl>-->
<!--        </section>-->

    </article>
</main>


<?php
loadPartial('footer');
?>
