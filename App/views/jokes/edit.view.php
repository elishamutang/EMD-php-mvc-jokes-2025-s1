<?php
/**
 * Edit details of joke.
 *
 * Allows a user to edit their own jokes.
 *
 * Filename:        edit.view.php
 * Location:        App/views/jokes
 * Project:         EMD-php-mvc-jokes-2025-s1
 * Date Created:    13/04/2025
 *
 * Author:          Elisha Mutang Daneil <20145565@tafe.wa.edu.au>
 *
 */

loadPartial("header");
loadPartial('navigation');


?>
    <script src="https://cdn.ckeditor.com/ckeditor5/10.0.1/classic/ckeditor.js"></script>
    <script src="/assets/js/editor.js"></script>

    <main class="md:max-w-3/4 max-w-9/10 container mx-auto bg-zinc-50 py-8 px-4 shadow shadow-black/25 rounded-b-lg flex flex-col flex-grow">
        <article>
            <header class="bg-zinc-700 text-zinc-200 -mx-4 -mt-8 p-8 mb-8 flex rounded-t-lg">
                <h1 class="grow text-2xl font-bold ">Jokes - Edit</h1>
                <p class="text-md px-8 py-2 bg-prussianblue-500 hover:bg-prussianblue-600 text-white
                          rounded transition ease-in-out duration-500">
                    <a href="/jokes/create">Add Joke</a>
                </p>
            </header>

            <section>

                <?= loadPartial('message') ?>

                <?= loadPartial('errors', [
                    'errors' => $errors ?? []
                ]) ?>

                <form id="jokeForm" method="POST" action="/jokes/<?= $joke->id ?>">
                    <input type="hidden" name="_method" value="PUT">

                    <h2 class="text-2xl font-bold mb-6 text-left text-gray-500">
                        Joke Information
                    </h2>

                    <div class="mb-4">
                        <label for="Title">Title:</label>
                        <input id="Title" type="text" name="title" placeholder="Title Name"
                               class="w-full px-4 py-2 border rounded focus:outline-none"
                               value="<?= $joke->title ?? '' ?>"/>
                    </div>

                    <div class="mb-4">
                        <label for="Description">Body:</label>
                        <div id="toolbar"></div>
                        <textarea id="Description" name="description" placeholder="Joke Description"
                                  class="w-full px-4 py-2 border border-zinc-500 rounded focus:outline-none"
                        ><?= $joke->body ?? '' ?></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="Category" class="mr-2">Category:</label>
                        <select id="Category" name="category" class="rounded-sm border">
                            <?php foreach($categories as $category): ?>
                                <?php if ($category->id === $joke->category_id): ?>
                                    <option value="<?=$category->name?>" selected><?= ucfirst($category->name) ?></option>
                                <?php else : ?>
                                    <option value="<?= $category->name ?>"><?= ucfirst($category->name) ?></option>
                                <?php endif ?>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="Tags">Tags: </label>
                        <p class="text-sm py-1 text-gray-500 italic">Multiple tags must be separated by a comma (",")</p>
                        <input id="Tags" type="text" name="tags" value="<?= $joke->tags ?>" class="w-full px-4 py-2 border rounded focus:outline-none"/>
                    </div>

                    <div class="flex gap-4 content-center">
                        <button type="submit"
                                class="grow md:max-w-1/3 bg-green-500 hover:bg-green-600 text-white px-4 py-2
                                       rounded focus:outline-none flex justify-center">
                            <i class="fa fa-check inline-block mr-4"></i>
                            <span>Save</span>
                        </button>

                        <a href="/jokes"
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

