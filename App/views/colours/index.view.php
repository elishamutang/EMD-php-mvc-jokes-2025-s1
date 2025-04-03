<?php
/**
 * FILE TITLE GOES HERE
 *
 * DESCRIPTION OF THE PURPOSE AND USE OF THE CODE
 * MAY BE MORE THAN ONE LINE LONG
 * KEEP LINE LENGTH TO NO MORE THAN 96 CHARACTERS
 *
 * Filename:        index.view.php
 * Location:        ${FILE_LOCATION}
 * Project:         XXX-SaaS-Vanilla-MVC-YYYY-SN
 * Date Created:    20/08/2024
 *
 * Author:          Adrian Gould <Adrian.Gould@nmtafe.wa.edu.au>
 *
 */

/* Load HTML header and navigation areas */
loadPartial("header");
loadPartial('navigation');

?>

    <main class="container mx-auto bg-zinc-50 py-8 px-4 shadow shadow-black/25 rounded-b-lg flex flex-col flex-grow">
        <article>
            <header class="bg-zinc-700 text-zinc-200 -mx-4 -mt-8 p-8 mb-8 flex">
                <h1 class="grow text-2xl font-bold ">Colours</h1>
                <p class="text-md  px-8 py-2 bg-prussianblue-500 hover:bg-prussianblue-600 text-white rounded transition ease-in-out duration-500">
                    <a href="/colours/create">Add Colour</a>
                </p>
            </header>

            <section class="text-xl text-zinc-500 mt-8 mb-4 flex flex-row justify-between gap-2">

                <?php if (isset($filter) && strlen($filter) > 0) : ?>
                    <p>Search Results for: <?= htmlspecialchars($filter) ?></p>
                    <p><?= $colour_count ?? "No" ?> colour(s) found</p>
                <?php else : ?>
                    <p>All <?= $colour_count ?? "" ?> Colours</p>
                <?php endif; ?>

                <form name="filter" action="/colours" class="flex flex-row gap-2 mb-2 text-sm">
                    <label for="colour" class="flex-0 mr-2">Filter:</label>
                    <select name="filter" id="colour" class="border border-gray-300 rounded bg-white px-2 mr-2 flex-0">
                        <?php
                        foreach ($colourSelect ?? [] as $colour):
                            ?>
                            <option value="<?= $colour->classification ?>"
                                <?= $colour->classification == $filter ? 'selected' : '' ?>
                            ><?= $colour->classification ?? "ALL" ?></option>
                        <?php
                        endforeach
                        ?>
                    </select>
                    <button type="submit" class="border-0 border-gray-300 bg-gray-300 text-black rounded-r px-2">Go!
                    </button>
                </form>

            </section>

            <section class="text-xl text-zinc-500 flex flex-col gap-2">
                <?= loadPartial('message') ?>
            </section>

            <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 ">
                <?php
                foreach ($colours ?? [] as $colour):
                    ?>

                    <article class=" bg-white border border-zinc-400 shadow rounded flex flex-col overflow-hidden">
                        <header class="-mx-2 bg-zinc-700 text-zinc-200 text-lg p-4 rounded-t flex-0">
                            <h4>
                                <?= $colour->name ?>
                            </h4>
                        </header>

                        <section class="flex-grow p-4 " style="background-color: <?= $colour->oklch ?>">
                            <div class="description h-24" style="background-color: <?= $colour->oklch ?>">
                            </div>
                        </section>

                        <footer class="-mx-2 bg-zinc-200 text-zinc-900 text-sm px-4 py-4 -mb-2 rounded-b flex-0 flex justify-between">
                            <a href="/colours/<?= $colour->id ?>"
                               class="btn">
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

