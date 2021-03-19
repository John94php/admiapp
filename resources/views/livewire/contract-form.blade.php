<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day --}}
    <form wire:submit.prevent="submit" >

        <!-- component -->
        <div class="max-w-lg max-w-xs bg-gray-300 shadow-1xl rounded-lg mx-auto text-center py-12 mt-4 rounded-xl">
            <h1 class="text-gray-200 text-center font-extrabold -mt-3 text-3xl"><i class="fas fa-user"></i></h1>
            <div class="container py-5 max-w-md mx-auto overflow-auto h-64">
                    <div class="mb-4">
                        <label>Name</label>
                                <input placeholder="Name" class="shadow appearance-none  rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" name="name" wire:model="name">
                    @error('name')<span class="error">{{$message}}</span> @enderror
                    </div>
                    <div class="mb-6">
                        <label>Last name</label>
                        <input placeholder="Last name" class="shadow appearance-none  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="lastname" type="text" name="lastname" wire:model="lastname">
                        @error('lastname')<span class="error">{{$message}}</span> @enderror

                    </div>

                    <div class="mb-6" id="pesel" >
                        <label>PESEL</label>
                        <input placeholder="PESEL" class="shadow appearance-none  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="pesel" name="pesel" type="text" wire:model="pesel">
                        @error('pesel')<span class="error">{{$message}}</span> @enderror

                    </div>
                            or...
                    <div class="mb-6" id="nopesel" >
                        <label>Date of birth</label>
                        <input placeholder="date of birth" class="shadow appearance-none  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="dateofbirth" name=dateofbirth" wire:model="dateofbirth" type="date">
                        @error('dateofbirth')<span class="error">{{$message}}</span> @enderror

                    </div>
                    <div class="mb-6">
                        <label>ID card</label>
                        <input placeholder="ID card" class="shadow appearance-none  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="idcard" name="idcard" type="text" wire:model="idcard">
                        @error('idcard')<span class="error">{{$message}}</span> @enderror

                    </div>
                    <div class="mb-6">
                        <label>Sex</label>
                        <select name="sex" class="shadow appearance-none  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" wire:model="sex">
                            <option value="">Select</option>
                            <option value="F">Female</option>
                            <option value="M">Male</option>
                        </select>
                        @error('sex')<span class="error">{{$message}}</span> @enderror

                    </div>
                    <p class="text-3xl ...">Address section</p>
                    <hr>
                    <div class="mb-6">
                        <label>Country</label>
                        <input type="text" name="corrcountry"  placeholder="Poland" id="corrcountry" class="shadow appearance-none  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" wire:model="corrcountry"/>
                        @error('corrcountry')<span class="error">{{$message}}</span> @enderror

                    </div>

                    <div class="mb-4">
                        <label>State</label>
                        <select name="corrstate" id="corrstate"  class="shadow appearance-none  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" wire:model="corrstate">
                            @foreach($states as $state)
                                <option value="{{$state->states_id}}">{{$state->states_name}}</option>
                            @endforeach
                        </select>
                        @error('corrstate')<span class="error">{{$message}}</span> @enderror

                    </div>
                    <div class="mb-4">
                        <label>City</label>
                        <input type="text" name="corrcity" id="corrcity"  placeholder="Warsaw" class="shadow appearance-none  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" wire:model="corrcity"/>
                        @error('corrcity')<span class="error">{{$message}}</span> @enderror

                    </div>
                    <div class="mb-4">
                        <label>Zip-code</label>
                        <input type="text" name="corrcode" placeholder="00-000" id="corrcode" wire:model="corrcode" class="shadow appearance-none  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"/>
                        @error('corrcode')<span class="error">{{$message}}</span> @enderror

                    </div>
                    <div class="mb-4">
                        <label>Street</label>
                        <input type="text" name="corrstreet" id="corrstreet" wire:model="corrstreet" class="shadow appearance-none  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"/>
                        @error('corrstreet')<span class="error">{{$message}}</span> @enderror

                    </div>
                    <div class="mb-4">
                        <p>                        <label>no. house</label>&nbsp;<input type="text" name="corrhouse" id="corrhouse" wire:model="corrhouse"/></p>
                        @error('corrhouse')<span class="error">{{$message}}</span> @enderror

                        <p>                        <label>no. flat</label>&nbsp;<input type="text" name="corrflat" id="corrflat" wire:model="corrflat"/></p>
                        @error('corrflat')<span class="error">{{$message}}</span> @enderror

                    </div>
                    <input type="checkbox" class="appearance-none checked:bg-blue-600 checked:border-transparent ..." id="copyaddress" >Check if corresponding address is the same as home address
                    <p class="text-3xl ...">Address section</p>
                    <hr>
                    <div class="mb-6">
                        <label>Country</label>
                        <input type="text" name="country" id="country" wire:model="country"  placeholder="Poland"
                               class="shadow appearance-none  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"/>
                        @error('country')<span class="error">{{$message}}</span> @enderror

                    </div>

                    <div class="mb-4">
                        <label>State</label>
                        <select name="state" id="state" wire:model="state"
                                class="shadow appearance-none  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
                            @foreach($states as $state)
                                <option value="{{$state->states_id}}">{{$state->states_name}}</option>
                            @endforeach
                        </select>
                        @error('state')<span class="error">{{$message}}</span> @enderror

                    </div>
                    <div class="mb-4">
                        <label>City</label>
                        <input type="text" name="city" id="city" placeholder="Warsaw" wire:model="city"
                               class="shadow appearance-none  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"/>
                        @error('city')<span class="error">{{$message}}</span> @enderror

                    </div>
                    <div class="mb-4">
                        <label>Zip-code</label>
                        <input type="text" name="code" id="code" placeholder="00-000" wire:model="code"
                               class="shadow appearance-none  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"/>
                        @error('code')<span class="error">{{$message}}</span> @enderror

                    </div>
                    <div class="mb-4">
                        <label>Street</label>
                        <input type="text" name="street" id="street" wire:model="street"
                               class="shadow appearance-none  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"/>
                        @error('street')<span class="error">{{$message}}</span> @enderror

                    </div>
                    <div class="mb-4">
                        <p>                        <label>no. house</label>&nbsp;<input type="text" name="house" id="house" wire:model="house"/></p>
                        @error('house')<span class="error">{{$message}}</span> @enderror

                        <p>                        <label>no. flat</label>&nbsp;<input type="text" name="flat" id="flat" wire:model="flat"/></p>
                        @error('flat')<span class="error">{{$message}}</span> @enderror

                    </div>
                    <div class="mb-6">
                        <label>Contract type</label>
                        <select name="contracttype" wire:model="contracttype">
                            <option value="0">Select</option>
                            @foreach($types as $type)
                                <option value="{{$type->type_id}}">{{$type->type_name}} => {{$type->type_period}}</option>
                                @endforeach

                        </select>
                        @error('contracttype')<span class="error">{{$message}}</span> @enderror

                    </div>
                    <div class="mb-6">
                        <label>Date of sign</label>
                    <input type="date" wire:model="contractdate" class="shadow appearance-none  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="contractdate"/>
                        @error('contractdate')<span class="error">{{$message}}</span> @enderror

                    </div>
                    <div class="flex items-center justify-between p-lg-0">
                        <button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            wire:click="submit">
                            <i class="fas fa-check-circle"></i>&nbsp;Save
                        </button>
                    </div>
            </div>
        </div>
    </form>
</div>
