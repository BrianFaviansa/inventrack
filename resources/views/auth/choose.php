<?php $title = "Inventrack | Register"; ?>


<div class="h-screen bg-slate-100">
    <h2 class="text-4xl pt-10 mb-16 md:mb-24 text-center font-bold dark:text-white">Daftar Sebagai</h2>
    <div class="flex items-center justify-center text-center">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 justify-center gap-6 place-items-center">

            <div class="max-w-md bg-sky-200 border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
                <a href="<?= urlpath('register/manager'); ?>">
                    <img class="rounded-t-lg h-auto" src="assets/img/register-manager.png" alt="" />
                    <div class="p-5">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Manager</h5>
                    </div>
                </a>
            </div>

            <div class="max-w-md bg-sky-200 border border-gray-200 rounded-lg shadow-lg p-4 dark:bg-gray-800 dark:border-gray-700">
                <a href="<?= urlpath('register/stoker'); ?>">
                    <img class="rounded-t-lg h-auto" src="assets/img/register-stoker.png" alt="" />
                    <div class="p-5">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Stoker</h5>
                    </div>
                </a>
            </div>


            <div class="max-w-md bg-sky-200 border border-gray-200 rounded-lg shadow-lg p-4 dark:bg-gray-800 dark:border-gray-700">
                <a href="<?= urlpath('register/kasir'); ?>">
                    <img class="rounded-t-lg h-auto" src="assets/img/register-kasir.png" alt="" />
                    <div class="p-5">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Kasir</h5>
                    </div>
                </a>
            </div>

        </div>
    </div>
</div>