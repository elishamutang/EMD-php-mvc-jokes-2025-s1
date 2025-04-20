<?php
/**
 * About Page View
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

<main class="container mx-auto bg-zinc-50 py-8 px-4 shadow shadow-black/25 rounded-lg">
    <article  class="grid grid-cols-1">
        <header class="bg-zinc-700 text-zinc-200 -mx-4 -mt-8 mb-4 p-8 text-3xl font-bold rounded-t-lg">
            <h1 class="grow text-3xl font-bold tracking-widest">ABOUT</h1>
        </header>
    </article>

    <article class="grid grid-cols-1">
        <section class="m-4 bg-zinc-200 text-zinc-700 p-8 rounded-lg shadow">
            <dl class="flex flex-col">
                <dt class="text-2xl font-semibold ">Overview:</dt>
                <dd class="ml-4">
                    <p class="hover:text-black">This is a simple jokes system written using HTML, TailwindCSS, PHP, SQL, and the Model-View-Controller framework.
                        The system allows users to register, log in, and manage jokes.</p><br>
                    <p class="hover:text-black">Registered users will be able to add, edit, and delete jokes and update their own details. In addition, the
                        system will support optional category management.</p>
                </dd>
            </dl>
        </section>
    </article>

    <article class="grid grid-cols-2 ">

        <section class="m-4 bg-zinc-200 text-zinc-700 p-8 rounded-lg shadow">
            <dl class="flex flex-col gap-2">

                <dt class="text-2xl font-semibold">The Developer</dt>
                <dd class="ml-4 flex items-start">
                    <i class="fa-solid fa-circle-info mr-2 text-base"></i>
                    <p class="hover:text-black">Hi, my name is Elisha.</p>
                </dd>
            </dl>
        </section>

        <section class="m-4 bg-zinc-200 text-zinc-700 p-8 rounded-lg shadow">
            <dl class="flex flex-col">
                <dt class="text-2xl font-semibold">Technologies:</dt>
                <dd class="ml-4 flex items-center">
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
            </dl>
        </section>

    </article>
</main>


<?php
loadPartial('footer');
?>
