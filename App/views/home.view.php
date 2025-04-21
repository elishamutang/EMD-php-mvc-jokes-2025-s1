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

use Framework\Middleware\Authorise;
$authenticated = new Authorise();

loadPartial('header');
loadPartial('navigation');

?>

<main class="container md:max-w-3/4 max-w-9/10 mx-auto bg-zinc-50 py-8 px-4 shadow shadow-black/25 rounded-lg">
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

    <article class="flex flex-col md:grid md:grid-cols-4 gap-4 md:gap-8">
        <?php if($authenticated->isAuthenticated()): ?>

            <article class="flex flex-col">
                <section class="flex-wrap gap-2 border p-4 border-gray-300 bg-gray-200 rounded-lg shadow-sm">
                    <h1 class="text-xl md:text-2xl text-wrap text-gray-900 rounded-sm py-1 px-2">Current Statistics!</h1>
                </section>

                <article class="flex py-2 gap-2 flex-col">
                    <section class=" grow flex flex-wrap gap-2 p-4 border border-gray-300 rounded-lg shadow-sm bg-sky-400 items-center justify-center">
                        <h1 class="grow text-xl text-wrap text-white rounded-sm py-1 px-2">Jokes</h1>
                        <h1 class="text-xl text-white border border-gray-300 rounded-sm py-1 px-2 text-center bg-sky-600"><?= $jokes_count ?></h1>
                    </section>

                    <section class="grow flex flex-wrap p-4 border border-gray-300 rounded-lg shadow-sm bg-red-400 items-center justify-center">
                        <h1 class="grow text-xl text-wrap text-white rounded-sm py-1 px-2">Categories</h1>
                        <h1 class="text-xl text-white border border-gray-300 rounded-sm py-1 px-2 text-center bg-red-600"><?= $category_count ?></h1>
                    </section>

                    <section class="grow flex flex-wrap p-4 border border-gray-300 rounded-lg shadow-sm bg-emerald-400 items-center justify-center">
                        <h1 class="grow text-xl text-wrap text-white rounded-sm py-1 px-2">Users</h1>
                        <h1 class="text-xl text-white border border-gray-300 rounded-sm py-1 px-2 text-center bg-emerald-600"><?= $users_count ?></h1>
                    </section>
                </article>
            </article>
        <?php endif; ?>

        <article class="flex flex-col gap-2 flex-wrap col-span-3">
            <section class="justify-start">
                <form method="GET" action="/">
                    <button type="submit" class="w-full p-2 btn-primary text-xl rounded-lg cursor-pointer">Click me to generate a random joke!</button>
                </form>
            </section>

            <section class="bg-zinc-200 text-zinc-700 p-4 rounded-lg shadow-xl grow">

                <?php if(isset($joke)): ?>
                    <dl class="flex flex-col gap-2">
                        <dt class="flex text-xl md:text-2xl font-semibold">Featured Joke
                            <span class="px-2">-</span>
                            <h1 class="text-prussianblue-500 text-xl tracking-wide md:text-2xl"><?= $joke->title ?></h1></dt>
                        <dd class="ml-4 flex items-start">
                            <i class="hover:text-black fa-regular fa-face-smile-wink inline-block mt-2 mr-2"></i>
                            <p class="md:text-xl"><?= $joke_body ?></p>
                        </dd>
                    </dl>
                <?php else: ?>
                    <dl class="flex flex-col gap-2">
                        <dt class="flex text-2xl font-semibold">No jokes in the system :/</dt>
                    </dl>
                <?php endif; ?>

            </section>
        </article>
    </article>
</main>


<?php
loadPartial('footer');
?>
