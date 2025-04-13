<?php
/**
 * Add new joke
 *
 * DESCRIPTION OF THE PURPOSE AND USE OF THE CODE
 * MAY BE MORE THAN ONE LINE LONG
 * KEEP LINE LENGTH TO NO MORE THAN 96 CHARACTERS
 *
 * Filename:        create.view.php
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

    <main class="container mx-auto bg-zinc-50 py-8 px-4 shadow shadow-black/25 rounded-b-lg flex flex-col flex-grow">
        <article>
            <header class="bg-zinc-700 text-zinc-200 -mx-4 -mt-8 p-8 mb-8 flex">
                <h1 class="grow text-2xl font-bold ">Products - Add</h1>

            </header>

            <section>
                <?= loadPartial('message') ?>

                <?= loadPartial('errors', [
                    'errors' => $errors ?? []
                ]) ?>

                <form id="ProductForm" method="POST" action="/products">

                    <h2 class="text-2xl font-bold mb-6 text-left text-gray-500">
                        Product Information
                    </h2>

                    <div class="mb-4">
                        <label for="Name">Name:</label>
                        <input id="Name" type="text" name="name" placeholder="Product Name"
                               class="w-full px-4 py-2 border rounded focus:outline-none"
                               value="<?= $product['name'] ?? '' ?>"/>
                    </div>

                    <div class="mb-4">
                        <label for="Description">Description:</label>
                        <textarea id="Description" name="description" placeholder="Product Description"
                                  class="w-full px-4 py-2 border rounded focus:outline-none"
                        ><?= $product['description'] ?? '' ?></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="Price">Price $:</label>
                        <input id="Price" type="text" name="price" placeholder="Price"
                               class="w-full px-4 py-2 border rounded focus:outline-none"
                               value="<?= $product['price'] ?? '' ?>"/>
                    </div>

                    <div class="grid grid-cols-4 gap-8">
                        <button type="submit"
                                class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2
                               rounded focus:outline-none flex justify-center">
                            <i class="fa fa-check inline-block mr-4"></i>
                            <span>Save</span>
                        </button>

                        <a href="/products"
                           class="text-center w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2
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

