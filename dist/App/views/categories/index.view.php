<?php
/**
 * Index page to browse, read, edit, add, update or delete categories.
 *
 * A categories dashboard for authenticated users to browse, read, edit,
 * add, update or delete categories.
 *
 * Filename:        index.view.php
 * Location:        App/views/categories
 * Project:         EMD-php-mvc-jokes-2025-s1
 * Date Created:    22/04/2025
 *
 * Author:          Elisha Mutang Daneil <20145565@tafe.wa.edu.au>
 *
 */


/* Load HTML header and navigation areas */
loadPartial("header");
loadPartial('navigation');

?>

<main class="container md:max-w-5/6 max-w-9/10 mx-auto bg-zinc-50 py-8 px-4 shadow shadow-black/25 rounded-b-lg flex flex-col flex-grow">
    <article>
        <header class="bg-slate-700 text-white -mx-4 -mt-8 p-8 mb-8 flex rounded-t-lg">
            <h1 class="grow text-3xl font-bold tracking-widest">CATEGORIES</h1>
            <p class="text-md  px-8 py-2 bg-prussianblue-500 hover:bg-prussianblue-600 text-white rounded transition ease-in-out duration-500">
                <a href="/categories/create">Add Category</a>
            </p>
            <form method="GET" action="/categories/search" class="block mx-5 flex">
                <input type="text" name="keywords" placeholder="Category search..."
                       class="w-full md:w-auto px-4 py-1 border border-gray-800 focus:outline-none focus:border-b-gray-500 bg-white text-black"/>
                <button class="w-full md:w-auto bg-gray-500 hover:bg-gray-600 text-white px-4 py-1 focus:outline-none transition ease-in-out duration-500 cursor-pointer">
                    <i class="fa fa-search"></i> Search
                </button>
            </form>
        </header>

        <section class="text-xl text-zinc-500 my-8">
            <?php if (isset($keywords)) : ?>
                <p>Search Results for: <?= htmlspecialchars($keywords) ?></p>
                <p><?= count($categories) == 1 ? count($categories) . " category found" : count($categories) . " categories found"?></p>
            <?php else : ?>
                <p class="text-2xl">All Categories</p>
            <?php endif; ?>

            <?= loadPartial('message') ?>
        </section>

        <section class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 ">
            <?php
            foreach ($categories ?? [] as $category):
                ?>

                <article class=" bg-white border border-zinc-400 shadow rounded flex flex-col overflow-hidden">
                    <header class="-mx-2 bg-slate-500 text-white text-lg p-4 rounded-t flex-0">
                        <h4>
                            <?php if(Framework\Authorisation::isOwner($category->user_id)): ?>
                                <span class="text-white"><?= $category->name ?></span>
                                <span class="text-sm ml-2 my-1 rounded bg-prussianblue-500 text-white px-2 py-1">You</span>
                            <?php else: ?>
                                <span class="text-white"><?= $category->name ?></span>
                            <?php endif ?>
                        </h4>
                    </header>

                    <section class="flex-grow px-2 ">
                        <div class="bg-white description flex items-center">
                            <p class="font-bold mr-2">Created at: </p>
                            <p class="text-sm"><?= date('F j, Y, g:i a', strtotime($category->created_at)) ?></p>
                        </div>
                        <div class="bg-white description flex items-center">
                            <p class="font-bold mr-2">Last updated at: </p>
                            <p class="text-sm"><?= $category->updated_at ?  date('F j, Y, g:i a', strtotime($category->updated_at)) : 'N/A' ?></p>
                        </div>
                    </section>

                    <footer class="-mx-2 bg-zinc-200 text-zinc-900 text-sm px-4 py-4 -mb-2 rounded-b flex flex-col md:flex-row justify-between">
                        <a href="/categories/<?= $category->id ?>"
                           class="btn flex flex-wrap mt-2">
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

