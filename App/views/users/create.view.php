<?php
/**
 * Register User View
 *
 * Presents a page to the user to register their details.
 *
 * Filename:        create.view.php
 * Location:        App/views/users
 * Project:         EMD-php-mvc-jokes-2025-s1
 * Date Created:    13/04/2025
 *
 * Author:          Elisha Mutang Daneil <20145565@tafe.wa.edu.au>
 *
 */

loadPartial('header');
loadPartial('navigation'); ?>

    <main class="container mx-auto bg-zinc-50 py-8 px-4 shadow shadow-black/25 rounded-b-lg
                 flex justify-center items-center mt-8 w-1/2 ">

        <section class="bg-white p-8 rounded-lg shadow-md md:w-500 mx-6 w-full">

            <h2 class="text-4xl text-left font-bold mb-4">
                Register
            </h2>

            <?= loadPartial('errors', [
                'errors' => $errors ?? []
            ]) ?>

            <form method="POST" action="/auth/register">

                <section class="mb-4">
                    <p class="text-gray-500 italic">Fields indicated with <span class="text-red-600 font-bold">*</span> are required.</p>
                </section>

                <section class="mb-4">
                    <label for="given_name" class="mt-4 pb-1">Given Name<span class="text-red-600 font-bold">*</span></label>
                    <input type="text" id="given_name"
                           name="given_name" placeholder="Jack"
                           class="w-full px-4 py-2 border border-b-zinc-300 rounded focus:outline-none"
                           value="<?= $user['given_name'] ?? '' ?>"/>
                </section>

                <section class="mb-4">
                    <label for="family_name" class="mt-4 pb-1">Family Name</label>
                    <input type="text" id="family_name"
                           name="family_name" placeholder="Smith"
                           class="w-full px-4 py-2 border border-b-zinc-300 rounded focus:outline-none"
                           value="<?= $user['family_name'] ?? '' ?>"/>
                </section>

                <section class="mb-4">
                    <label for="nickname" class="mt-4 pb-1">Nickname (preferred name)</label>
                    <input type="text" id="nickname"
                           name="nickname" placeholder="Jack Smith"
                           class="w-full px-4 py-2 border border-b-zinc-300 rounded focus:outline-none"
                           value="<?= $user['nickname'] ?? '' ?>"/>
                </section>

                <section class="mb-4">
                    <label for="Email" class="mt-4 pb-1">Email<span class="text-red-600 font-bold">*</span></label>
                    <input type="email" id="Email"
                           name="email" placeholder="jacksmith@example.com"
                           class="w-full px-4 py-2 border border-b-zinc-300 rounded focus:outline-none"
                           value="<?= $user['email'] ?? '' ?>"/>
                </section>

                <section class="mb-4">
                    <label for="City" class="mt-4 pb-1">City:</label>
                    <input type="text" id="City"
                           name="city" placeholder="City"
                           class="w-full px-4 py-2 border border-b-zinc-300 rounded focus:outline-none"
                           value="<?= $user['city'] ?? '' ?>"/>
                </section>

                <section class="mb-4">
                    <label for="State" class="mt-4 pb-1">State:</label>
                    <input type="text" id="State"
                           name="state" placeholder="State"
                           class="w-full px-4 py-2 border border-b-zinc-300 rounded focus:outline-none"
                           value="<?= $user['state'] ?? '' ?>"/>
                </section>

                <section class="mb-4">
                    <label for="country" class="mt-4 pb-1">Country:</label>
                    <input type="text" id="country"
                           name="country" placeholder="Australia"
                           class="w-full px-4 py-2 border border-b-zinc-300 rounded focus:outline-none"
                           value="<?= $user['country'] ?? '' ?>"/>
                </section>

                <section class="mb-4">
                    <label for="Password" class="mt-4 pb-1">Password<span class="text-red-600 font-bold">*</span></label>
                    <input type="password" id="Password"
                           name="password" placeholder="Password"
                           class="w-full px-4 py-2 border border-b-zinc-300 rounded focus:outline-none"/>
                </section>

                <section class="mb-4">
                    <label for="PasswordConfirmation" class="mt-4 pb-1">Confirm password<span class="text-red-600 font-bold">*</span></label>
                    <input type="password" id="PasswordConfirmation"
                           name="password_confirmation" placeholder="Confirm Password"
                           class="w-full px-4 py-2 border border-b-zinc-300 rounded focus:outline-none"/>
                </section>

                <section class="mb-4">
                    <button type="submit"
                            class="w-full bg-prussianblue-500 hover:bg-prussianblue-600 text-white px-4 py-2 rounded focus:outline-none
                               transition ease-in-out duration-500">
                        Register
                    </button>
                </section>

                <section class="mb-4">
                    <p class="mt-8 text-zinc-700">
                        Already have an account?
                        <a class="bg-prussianblue-900 hover:bg-prussianblue-600 text-white px-1 py-1 rounded
                              transition ease-in-out duration-500" href="/auth/login">Login</a>
                    </p>
                </section>

            </form>
        </section>
    </main>

<?php
loadPartial('footer');