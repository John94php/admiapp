<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day --}}
    <form wire:submit.prevent="submit">
        <!-- component -->
        <div class="max-w-lg max-w-xs bg-gray-300 shadow-1xl rounded-lg mx-auto text-center py-12 mt-4 rounded-xl">
            <h1 class="text-gray-200 text-center font-extrabold -mt-3 text-3xl"><i class="fas fa-user"></i></h1>
            <div class="container py-5 max-w-md mx-auto overscroll-auto">
                <form method="" action="">
                    <div class="mb-4">
                        <label>Name</label>
                        <input placeholder="Name"
                               class="shadow appearance-none  rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               id="name" type="text">
                    </div>
                    <div class="mb-6">
                        <label>Last name</label>
                        <input placeholder="Username"
                               class="shadow appearance-none  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                               id="surname" type="text">

                    </div>
                    <div class="mb-6">
                        <label>Has Pesel?</label>
                    <select class="shadow appearance-none  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="choice">
                        <option value="0">Has PESEL?</option>
                        <option value="1">Yes</option>
                        <option value="2">No</option>
                    </select>

                    </div>
                    <div class="mb-6" id="pesel" style="display: none">
                        <label>PESEL</label>
                        <input placeholder="PESEL"
                               class="shadow appearance-none  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                               id="surname" type="text">

                    </div>

                    <div class="mb-6" id="nopesel" style="display: none">
                    <label>Date of birth</label>
                        <input placeholder="date of birth"
                               class="shadow appearance-none  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                               id="dateofbirth" type="date">

                    </div>
                    <p class="text-5xl ...">Address section</p>
                    <hr>
                    <div class="mb-6">
                        <label>Country</label>
                        <input type="text" name="corrcountry" readonly value="Poland"/>
                        </div>
                    <div class="mb-6">
                        <label>Country</label>
                        <select class="shadow appearance-none  rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

                        </select>
                    </div>
                    <div class="flex items-center justify-between p-lg-0">
                        <button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="button">
                            <i class="fas fa-check-circle"></i>&nbsp;Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </form>
</div>
