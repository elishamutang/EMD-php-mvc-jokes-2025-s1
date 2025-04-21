<?php
/**
 * About Page View
 *
 * Provides details about the web application, developer, and related programming languages,
 * servers, and supporting systems.
 *
 * Filename:        about.view.php
 * Location:        /App/views
 * Project:         EMD-php-mvc-jokes-2025-s1
 * Date Created:    03/04/2025
 *
 * Author:          Elisha Mutang Daneil <20145565@tafe.wa.edu.au>
 *
 */

loadPartial('header');
loadPartial('navigation');

?>

<main class="container md:max-w-3/4 max-w-9/10 mx-auto bg-zinc-50 py-8 px-4 shadow shadow-black/25 rounded-lg">
    <article  class="grid grid-cols-1">
        <header class="bg-zinc-700 text-zinc-200 -mx-4 -mt-8 mb-4 p-8 text-3xl font-bold rounded-t-lg">
            <h1 class="grow text-3xl font-bold tracking-widest">ABOUT</h1>
        </header>
    </article>

    <article class="grid grid-cols-1">
        <section class="m-4 bg-zinc-200 text-zinc-700 p-8 rounded-lg shadow">
            <dl class="flex flex-col">
                <dt class="text-2xl font-semibold ">Overview <i class="fa-solid fa-list-ul fa-sm"></i> </dt>
                <dd class="ml-4 mt-2">
                    <p class="hover:text-black">This is a simple jokes system written using the Model-View-Controller framework with the following technologies
                        HTML, TailwindCSS, PHP, JavaScript, SQL / MariaDB. Registered users will be able to add, edit, and delete jokes and update their own details.</p>
                </dd>
            </dl>
        </section>
    </article>

    <article class="flex flex-col md:grid md:grid-cols-2">

        <section class="m-4 bg-zinc-200 text-zinc-700 p-8 rounded-lg shadow">
            <dl class="flex flex-col gap-2">

                <dt class="text-2xl font-semibold">The Developer <i class="fa-solid fa-circle-info text-base"></i></dt>
                <dd class="ml-4 flex flex-col items-start">
                    <p class="hover:text-black">Elisha is a programming student currently enrolled in the Diploma of Information Technology - Advanced Programming course at
                    North Metropolitan TAFE, Perth, Western Australia.</p><br>
                    <p class="hover:text-black">He is skilled in web development and well-versed in technologies such as HTML, CSS, JavaScript, PHP, Python, and SQL.</p>
                </dd>
            </dl>
        </section>

        <section class="m-4 bg-zinc-200 text-zinc-700 p-8 rounded-lg shadow">
            <dl class="flex flex-col">
                <dt class="text-2xl font-semibold">Technologies <i class="fa-solid fa-gear fa-sm"></i></dt>
                <dd class="ml-4 flex items-center mt-2">
                    <i class="hover:text-black fa fa-code inline-block mr-2 text-sm"></i>
                    <p class="hover:text-black">HTML</p>
                </dd>

                <dd class="ml-4 flex items-center">
                    <i class="hover:text-black fa fa-code inline-block mr-2 text-sm"></i>
                    <p class="hover:text-black">TailwindCSS</p>
                </dd>

                <dd class="ml-4 flex items-center">
                    <i class="hover:text-black fa fa-code inline-block mr-2 text-sm"></i>
                    <p class="hover:text-black">PHP</p>
                </dd>

                <dd class="ml-4 flex items-center">
                    <i class="hover:text-black fa fa-code inline-block mr-2 text-sm"></i>
                    <p class="hover:text-black">SQL</p>
                </dd>

                <dd class="ml-4 flex items-center">
                    <i class="hover:text-black fa fa-code inline-block mr-2 text-sm"></i>
                    <p class="hover:text-black">JavaScript</p>
                </dd>

                <dd class="ml-4 flex items-center">
                    <i class="hover:text-black fa fa-code inline-block mr-2 text-sm"></i>
                    <p class="hover:text-black">MariaDB</p>
                </dd>

                <dd class="ml-4 flex items-center">
                    <i class="hover:text-black fa fa-code inline-block mr-2 text-sm"></i>
                    <p class="hover:text-black">CKEditor5</p>
                </dd>

                <dd class="ml-4 flex items-center">
                    <i class="hover:text-black fa fa-code inline-block mr-2 text-sm"></i>
                    <p class="hover:text-black">HTML to Markdown</p>
                </dd>

                <dd class="ml-4 flex items-center">
                    <i class="hover:text-black fa fa-code inline-block mr-2 text-sm"></i>
                    <p class="hover:text-black">CommonMark</p>
                </dd>
            </dl>
        </section>

    </article>
</main>


<?php
loadPartial('footer');
?>
