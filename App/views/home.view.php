<?php
/**
 * Home Page View
 *
 * Filename:        home.view.php
 * Location:        /App/views
 * Project:         XXX-SaaS-Vanilla-MVC-YYYY-SN
 * Date Created:    23/08/2024
 *
 * Author:          Adrian Gould <Adrian.Gould@nmtafe.wa.edu.au>
 *
 */

loadPartial('header');
loadPartial('navigation');

?>

<main class="container mx-auto bg-zinc-50 py-8 px-4 shadow shadow-black/25 rounded-lg">
    <article  class="grid grid-cols-1">
        <header class="bg-zinc-700 text-zinc-200 -mx-4 -mt-8 mb-4 p-8 text-2xl font-bold rounded-t-lg">
            <h1>Vanilla PHP MVC Demo</h1>
        </header>

        <section class="my-4 p-4  gap-8 justify-start">
            <p class="text-3xl font-light">Welcome to the XXX SaaS Vanilla MVC YYYY/SN Template App</p>
            <p>This is a starter template for simple vanilla mvc based applications.</p>
            <p>Its primary purpose is as a <strong>teaching tool</strong> and is provided with no guarantees for security and production readiness.</p>
        </section>
    </article>

    <article class="grid grid-cols-2 ">
        <section class="m-4 bg-zinc-200 text-zinc-700 p-8 rounded-lg shadow">
            <dl class="flex flex-col">
                <dt class="text-lg font-semibold ">Tutorial:</dt>
                <dd class="ml-4">
                    <a href="https://github.com/AdyGCode/XXX-SaaS-Vanilla-MVC-YYYY-SN/tree/main/session-07"
                       class="hover:text-black">
                        <i class="fa fa-list inline-block mr-2 text-sm"></i>
                        Parts 00 - 04: https://github.com/AdyGCode/XXX-SaaS-Vanilla-MVC-YYYY-SN/tree/main/session-07
                    </a>
                </dd>
                <dd class="ml-4">
                    <a href="https://github.com/AdyGCode/XXX-SaaS-Vanilla-MVC-YYYY-SN/tree/main/session-08"
                       class="hover:text-black">
                        <i class="fa fa-list inline-block mr-2 text-sm"></i>
                        Parts 05 - 10: https://github.com/AdyGCode/XXX-SaaS-Vanilla-MVC-YYYY-SN/tree/main/session-07
                    </a>
                </dd>
            </dl>
        </section>
            <section class="m-4 bg-zinc-200 text-zinc-700 p-8 rounded-lg shadow">
                <dl class="flex flex-col">
                <dt class="text-lg font-semibold">Source Code:</dt>
                <dd class="ml-4">
                    <a href="https://github.com/AdyGCode/XXX-SaaS-Vanilla-MVC-YYYY-SN"
                       class="hover:text-black">
                        <i class="fa fa-code inline-block mr-2 text-sm"></i>
                        https://github.com/AdyGCode/XXX-SaaS-Vanilla-MVC-YYYY-SN
                    </a>
                </dd>
                </dl>
            </section>
        <section class="m-4 bg-zinc-200 text-zinc-700 p-8 rounded-lg shadow">
            <dl class="flex flex-col">

            <dt class="text-lg font-semibold">HelpDesk</dt>
                <dd class="ml-4">
                    <a href="https://help.screencraft.net.au"
                       class="hover:text-black">
                        <i class="fa fa-home inline-block mr-2 text-sm"></i>
                        Home Page
                    </a>
                </dd>
                <dd class="ml-4">
                    <a href="https://help.screencraft.net.au/hc/2680392001"
                       class="hover:text-black">
                        <i class="fa fa-info-circle inline-block mr-2 text-sm"></i>
                        FAQs
                    </a>
                </dd>
                <dd class="ml-4"><a href="https://help.screencraft.net.au/help/2680392001"
                                    class="hover:text-black">
                        <i class="fa fa-question-circle inline-block mr-2 text-sm"></i>
                        Make a HelpDesk Request (TAFE Students only)
                    </a>
                </dd>
            </dl>

        </section>

        <section class="m-4 bg-zinc-200 text-zinc-700 p-8 rounded-lg shadow">
            <dl class="flex flex-col">

            <dt class="text-lg font-semibold">Featured Product</dt>
                <dd class="ml-4">
                    <a href="https://help.screencraft.net.au"
                       class="hover:text-black">
                        <i class="fa fa-home inline-block mr-2 text-sm"></i>
                        <?= $joke->title ?>
                    </a>
                </dd>

            </dl>

        </section>

    </article>
</main>


<?php
loadPartial('footer');
?>
