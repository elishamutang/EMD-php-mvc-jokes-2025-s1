<?php
/**
 * Show category
 *
 * Displays the category in details, which includes information such as
 * its title, body content, $category, tags, and author's full name.
 *
 * Filename:        show.view.php
 * Location:        App/views/categories
 * Project:         EMD-php-mvc-jokes-2025-s1
 * Date Created:    22/04/2025
 *
 * Author:          Elisha Mutang Daneil <20145565@tafe.wa.edu.au>
 *
 */


loadpartial("header");
loadPartial('navigation');

?>

<main class="md:max-w-3/4 max-w-9/10 container mx-auto bg-zinc-50 py-8 px-4 shadow shadow-black/25 rounded-b-lg flex flex-col flex-grow">
    <article>
        <header class="bg-slate-700 text-zinc-200 -mx-4 -mt-8 p-8 mb-8 flex rounded-t-lg">
            <h1 class="grow text-2xl font-bold rounded-t-lg">Category - Detail</h1>
            <p class="text-md px-8 py-2 bg-prussianblue-500 hover:bg-prussianblue-600 text-white rounded transition ease-in-out duration-500">
                <a href="/categories/create">Add Category</a>
            </p>

        </header>
        <section>
            <?= loadPartial('message') ?>
        </section>
        <section class="w-full bg-white shadow rounded p-4 flex flex-col gap-4">
            <h4 class="-mx-4 bg-slate-700 text-zinc-200 text-2xl p-4 -mt-4 mb-4 rounded-t flex-0 flex justify-between">
                <?= $category->name ?>
            </h4>

            <section class="flex flex-col flex-grow md:grid md:grid-cols-4 md:gap-2">
                <h5 class="text-lg font-bold col-span-1 mt-4">
                    Category Title:
                </h5>
                <section class="col-span-1 md:col-span-3  max-w-96 description md:mt-4">
                    <?= $category->name ?>
                </section>

                <h5 class="text-lg font-bold col-span-1 mt-4">
                    Author Name:
                </h5>
                <section class="col-span-1 md:col-span-3  max-w-96 description md:mt-4">
                    <?= $category->author_name ?>
                </section>

                <h5 class="font-bold col-span-1 mt-4 text-lg">
                    Created at:
                </h5>
                <section class="col-span-1 md:col-span-3  max-w-96 description md:mt-4">
                    <?= date('F j, Y, g:i a', strtotime($category->created_at)) ?>
                </section>

                <h5 class="font-bold col-span-1 mt-4 text-lg">
                    Last updated at:
                </h5>
                <section class="col-span-1 md:col-span-3  max-w-96 description md:mt-4">
                    <?= $category->updated_at ? date('F j, Y, g:i a', strtotime($category->updated_at)) : 'N/A'?>
                </section>

                <h5 class="font-bold col-span-1 mt-4 text-lg mb-2">
                    Related jokes:
                </h5>
                <section class="col-span-1 md:col-span-3 flex flex-col md:flex-row gap-2 max-w-96 description md:mt-4">
                    <?php if(count($jokes) == 0): ?>
                        <p>N/A</p>
                    <?php else: ?>
                        <?php foreach($jokes ?? [] as $joke): ?>
                            <a href="/jokes/<?= $joke->joke_id ?>" class="no-underline border border-slate-400 bg-slate-300 px-2 py-1 rounded-sm cursor-pointer hover:bg-slate-400
                                    transition ease-in-out duration-300">
                                <?= $joke->joke_title ?>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </section>

            </section>

            <?php
            if (Framework\Authorisation::isOwner($category->user_id)) :
                ?>

                <script src="/assets/js/delete.js"></script>

                <div class="px-4 py-4 mt-4 -mx-4 border-0 border-t-1 border-zinc-300 text-lg flex flex-row gap-8">

                    <a href="/categories/edit/<?= $category->id ?>"
                       class="ml-8 px-16 py-2 bg-gray-500 hover:bg-gray-700 text-white rounded transition ease-in-out duration-500">
                        <i class="fa fa-pen inline-block mr-2"></i>
                        Edit
                    </a>

                    <a href="/categories/"
                       class="px-16 py-2 bg-prussianblue-500 hover:bg-prussianblue-700 text-white rounded transition ease-in-out duration-500">
                        <i class="fa fa-list inline-block mr-2"></i>
                        All Categories
                    </a>

                    <div id="dialog-container" class="hidden w-full h-full absolute bg-stone-950/95 p-6 top-0 left-0 flex items-center justify-center">
                        <div id="dialog" class="rounded-xl p-6 border border-stone-700 -translate-y-1/2 bg-stone-800 inset-shadow-sm">
                            <form method="POST" class="flex flex-col gap-4">

                                <h1 class="text-white text-xl font-bold tracking-wider">Delete Category</h1>
                                <p class="font-normal text-gray-400">Are you sure you want to delete <span class="text-red-500"><?= $category->name ?></span>?</p>

                                <div class="flex gap-2">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button id="confirmBtn" type="submit"
                                            class="grow cursor-pointer px-4 py-2 bg-green-500 hover:bg-green-700 text-white rounded transition ease-in-out duration-500">
                                        <i class="fa-solid fa-check inline-block mr-2"></i>
                                        Confirm
                                    </button>

                                    <button id="cancelBtn" type="button"
                                            class="grow cursor-pointer px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded transition ease-in-out duration-500">
                                        <i class="fa fa-times inline-block mr-2"></i>
                                        Cancel
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>

                    <button id="showDialog" type="button"
                            class="cursor-pointer px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded transition ease-in-out duration-500">
                        <i class="fa fa-times inline-block mr-2"></i>
                        Delete
                    </button>

                </div>

            <?php
            endif;
            ?>

        </section>

    </article>
</main>


<?php
require_once basePath("App/views/partials/footer.view.php");
?>

