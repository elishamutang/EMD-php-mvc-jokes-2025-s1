<?php
/**
 * Edit details of category.
 *
 * Allows a user to edit their own categories.
 *
 * Filename:        edit.view.php
 * Location:        App/views/categories
 * Project:         EMD-php-mvc-jokes-2025-s1
 * Date Created:    22/04/2025
 *
 * Author:          Elisha Mutang Daneil <20145565@tafe.wa.edu.au>
 *
 */

loadPartial("header");
loadPartial('navigation');


?>
    <main class="md:max-w-1/2 max-w-9/10 container mx-auto bg-zinc-50 py-8 px-4 shadow shadow-black/25 rounded-b-lg flex flex-col flex-grow">
        <article>
            <header class="bg-slate-700 text-zinc-200 -mx-4 -mt-8 p-8 mb-8 flex rounded-t-lg">
                <h1 class="grow text-2xl font-bold ">Categories - Edit</h1>
                <p class="text-md px-8 py-2 bg-prussianblue-500 hover:bg-prussianblue-600 text-white
                          rounded transition ease-in-out duration-500">
                    <a href="/categories/create">Add Category</a>
                </p>
            </header>

            <section>
                <?= var_dump($category); ?>

                <?= loadPartial('message') ?>

                <?= loadPartial('errors', [
                    'errors' => $errors ?? []
                ]) ?>

                <form id="categoryForm" method="POST" action="/categories/<?= $category->id ?>">
                    <input type="hidden" name="_method" value="PUT">

                    <h2 class="text-2xl font-bold mb-6 text-left text-gray-500">
                        Category Information
                    </h2>

                    <div class="mb-4">
                        <label for="Title">Title:</label>
                        <input id="Title" type="text" name="title" placeholder="Title Name"
                               class="w-full px-4 py-2 border rounded focus:outline-none bg-white"
                               value="<?= $category->name ?? '' ?>"/>
                    </div>

                    <div class="flex gap-4 content-center">
                        <button type="submit"
                                class="cursor-pointer grow md:max-w-1/3 bg-green-500 hover:bg-green-600 text-white px-4 py-2
                                       rounded focus:outline-none flex justify-center">
                            <i class="fa fa-check inline-block mr-4"></i>
                            <span>Save</span>
                        </button>

                        <a href="/categories"
                           class="text-center grow md:max-w-1/3 bg-red-500 hover:bg-red-600 text-white px-4 py-2
                                  rounded focus:outline-none flex justify-center">
                            <i class="fa fa-cancel inline-block mr-4"></i>
                            <span>Cancel</span>
                        </a>
                    </div>

                </form>

            </section>

        </article>
    </main>


<?php
loadPartial("footer");

