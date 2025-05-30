<?php
require_once basePath("App/views/partials/header.view.php");

loadPartial('navigation');

?>

<main class="md:max-w-3/4 max-w-9/10 container mx-auto bg-zinc-50 py-8 px-4 shadow shadow-black/25 rounded-b-lg">
    <article>
        <header class="bg-text-zinc-700-700 text-text-zinc-700-200 -mx-4 -mt-8 p-8 text-2xl font-bold mb-8">
            <h1>WHOOPSIE!</h1>
        </header>
        <section class="text-lg">
            <p>Sorry to say that the cat did a whoopsie and could not find the file you were looking for...</p>
        </section>

    </article>
</main>


<?php
require_once basePath("App/views/partials/footer.view.php");
?>
