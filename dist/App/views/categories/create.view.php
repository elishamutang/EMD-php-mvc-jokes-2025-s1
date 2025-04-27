<?php
/**
 * Create and add new Category.
 *
 * Adds a new Category to the web application.
 *
 * Filename:        create.view.php
 * Location:        App/views/categoires
 * Project:         EMD-php-mvc-jokes-2025-s1
 * Date Created:    23/04/2025
 *
 * Author:          Elisha Mutang Daneil <20145565@tafe.wa.edu.au>
 *
 */

loadPartial("header");
loadPartial('navigation');

?>
    <script src="https://cdn.ckeditor.com/ckeditor5/10.0.1/classic/ckeditor.js"></script>
    <script src="/assets/js/editor.js"></script>

    <main class="md:max-w-1/2 max-w-9/10 rounded-lg container mx-auto bg-zinc-50 py-8 px-4 shadow shadow-black/25 rounded-b-lg flex flex-col flex-grow">
        <article>
            <header class="bg-slate-700 text-zinc-200 -mx-4 -mt-8 p-8 mb-8 flex rounded-t-lg">
                <h1 class="grow text-2xl font-bold ">Category - Add</h1>

            </header>

            <section>

                <?= loadPartial('message') ?>

                <?= loadPartial('errors', [
                    'errors' => $errors ?? []
                ]) ?>

                <form id="categoryForm" method="POST" action="/categories">

                    <h2 class="text-2xl font-bold mb-6 text-left text-gray-500">
                        Category Information
                    </h2>

                    <div class="mb-4">
                        <label for="Title" class="font-bold">Title:</label>
                        <input id="Title" type="text" name="title" placeholder="Category Title"
                               class="w-full px-4 py-2 border rounded focus:outline-none"
                               value="<?= $category['title'] ?? '' ?>"/>
                    </div>

                    <div class="mb-4">
                        <label for="Name" class="font-bold">Author:</label>
                        <div id="Name" class="w-full py-2 rounded">
                            <?= Framework\Session::get('user')['given_name'] . ' ' . Framework\Session::get('user')['family_name']; ?>
                        </div>
                    </div>

                    <div class="flex gap-4 content-center">
                        <button type="submit"
                                class="grow md:max-w-1/3 bg-green-500 hover:bg-green-600 text-white px-4 py-2
                               rounded focus:outline-none flex justify-center cursor-pointer">
                            <i class="fa fa-check inline-block mr-4 self-center"></i>
                            <span>Save</span>
                        </button>

                        <a href="/categories"
                           class="text-center grow md:max-w-1/3 bg-red-500 hover:bg-red-600 text-white px-4 py-2
                   rounded focus:outline-none flex justify-center">
                            <i class="fa fa-cancel inline-block mr-4 self-center"></i>
                            <span>Cancel</span>
                        </a>
                    </div>

                </form>

            </section>

        </article>
    </main>

<?php
loadPartial("footer");

