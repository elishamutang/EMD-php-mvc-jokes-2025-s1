<?php
/**
 * Index page to browse, read, edit, add, update or delete jokes.
 *
 * A jokes dashboard for authenticated users to browse, read, edit,
 * add, update or delete jokes.
 *
 * Filename:        index.view.php
 * Location:        App/views/jokes
 * Project:         EMD-php-mvc-jokes-2025-s1
 * Date Created:    13/04/2025
 *
 * Author:          Elisha Mutang Daneil <20145565@tafe.wa.edu.au>
 *
 */


/* Load HTML header and navigation areas */
loadPartial("header");
loadPartial('navigation');

?>

<main class="container mx-auto bg-zinc-50 py-8 px-4 shadow shadow-black/25 rounded-b-lg flex flex-col flex-grow">
    <article>
        <header class="bg-zinc-700 text-zinc-200 -mx-4 -mt-8 p-8 mb-8 flex rounded-t-lg">
            <h1 class="grow text-3xl font-bold tracking-widest">JOKES</h1>
            <p class="text-md  px-8 py-2 bg-prussianblue-500 hover:bg-prussianblue-600 text-white rounded transition ease-in-out duration-500">
                <a href="/jokes/create">Add Joke</a>
            </p>
        </header>

        <section class="text-xl text-zinc-500 my-8">
            <?php if (isset($keywords)) : ?>
                <p>Search Results for: <?= htmlspecialchars($keywords) ?></p>
                <p><?= count($jokes ?? []) ?> product(s) found</p>
            <?php else : ?>
                <p>All Jokes</p>
            <?php endif; ?>

            <?= loadPartial('message') ?>
        </section>

        <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 ">
            <?php
            foreach ($jokes ?? [] as $joke):
                ?>

                <article class=" bg-white border border-zinc-400 shadow rounded flex flex-col overflow-hidden">
                    <header class="-mx-2 bg-zinc-700 text-zinc-200 text-lg p-4 rounded-t flex-0">
                        <h4>
                            <?php if(Framework\Authorisation::isOwner($joke->author_id)): ?>
                                <?= $joke->title ?> by
                                <span class="text-gray-400"><?= $joke->author_nickname ?></span>
                                <span class="text-sm ml-2 my-1 rounded bg-prussianblue-500 text-white px-2 py-1">You</span>
                            <?php else: ?>
                                <?= $joke->title ?> by
                                <span class="text-gray-400"><?= $joke->author_nickname ?></span>
                            <?php endif ?>
                        </h4>
                    </header>

                    <section class="flex-grow px-2 ">
                        <div class="bg-white description flex items-center">
                            <p class="font-bold mr-2">Category: </p><?= ucfirst($joke->category_name) ?>
                        </div>
                    </section>

                    <footer class="-mx-2 bg-zinc-200 text-zinc-900 text-sm px-4 py-4 -mb-2 rounded-b flex justify-between flex-0">
                        <div class="flex items-center gap-2">
                            Tags:
                            <?php
                            $tags = explode(',', $joke->tags);
                            foreach($tags as $tag) {
                                echo "<div class='ml-2 my-1 rounded text-gray-700 bg-gray-300 px-2 py-1'>{$tag}</div>";
                            };
                            ?>
                        </div>
                        <a href="/jokes/<?= $joke->id ?>"
                           class="btn flex flex-wrap">
                            More details...
                        </a>
                    </footer>
                </article>

            <?php
            endforeach
            ?>
        </section>

    </article>
</main>


<?php
loadPartial("footer");

