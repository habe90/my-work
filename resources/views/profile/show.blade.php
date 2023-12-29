@extends('layouts.admin')
@section('content')
    <div class="animate__animated p-6" :class="[$store.app.animation]">
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Users</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>{{ __('global.my_profile') }}</span>
            </li>
        </ul>
        <div class="pt-5">
            <div class="mb-5 flex items-center justify-between">
                <h5 class="text-lg font-semibold dark:text-white-light">Settings</h5>
            </div>
            <div x-data="{ tab: 'home' }">
                <ul
                    class="mb-5 overflow-y-auto whitespace-nowrap border-b border-[#ebedf2] font-semibold dark:border-[#191e3a] sm:flex">
                    <li class="inline-block">
                        <a href="javascript:;"
                            class="flex gap-2 border-b border-transparent p-4 hover:border-primary hover:text-primary !border-primary text-primary"
                            :class="{ '!border-primary text-primary': tab == 'home' }" @click="tab='home'">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                                <path opacity="0.5"
                                    d="M2 12.2039C2 9.91549 2 8.77128 2.5192 7.82274C3.0384 6.87421 3.98695 6.28551 5.88403 5.10813L7.88403 3.86687C9.88939 2.62229 10.8921 2 12 2C13.1079 2 14.1106 2.62229 16.116 3.86687L18.116 5.10812C20.0131 6.28551 20.9616 6.87421 21.4808 7.82274C22 8.77128 22 9.91549 22 12.2039V13.725C22 17.6258 22 19.5763 20.8284 20.7881C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.7881C2 19.5763 2 17.6258 2 13.725V12.2039Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                                <path d="M12 15L12 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                                </path>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li class="inline-block">
                        <a href="javascript:;"
                            class="flex gap-2 border-b border-transparent p-4 hover:border-primary hover:text-primary"
                            :class="{ '!border-primary text-primary': tab == 'payment-details' }"
                            @click="tab='payment-details'">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                                <circle opacity="0.5" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="1.5"></circle>
                                <path d="M12 6V18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                <path
                                    d="M15 9.5C15 8.11929 13.6569 7 12 7C10.3431 7 9 8.11929 9 9.5C9 10.8807 10.3431 12 12 12C13.6569 12 15 13.1193 15 14.5C15 15.8807 13.6569 17 12 17C10.3431 17 9 15.8807 9 14.5"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            </svg>
                            Payment Details
                        </a>
                    </li>
                    <li class="inline-block">
                        <a href="javascript:;"
                            class="flex gap-2 border-b border-transparent p-4 hover:border-primary hover:text-primary"
                            :class="{ '!border-primary text-primary': tab == 'preferences' }" @click="tab='preferences'">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                                <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5">
                                </circle>
                                <ellipse opacity="0.5" cx="12" cy="17" rx="7" ry="4"
                                    stroke="currentColor" stroke-width="1.5"></ellipse>
                            </svg>
                            Preferences
                        </a>
                    </li>
                    <li class="inline-block">
                        <a href="javascript:;"
                            class="flex gap-2 border-b border-transparent p-4 hover:border-primary hover:text-primary"
                            :class="{ '!border-primary text-primary': tab == 'danger-zone' }" @click="tab='danger-zone'">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                                <path
                                    d="M16.1007 13.359L16.5562 12.9062C17.1858 12.2801 18.1672 12.1515 18.9728 12.5894L20.8833 13.628C22.1102 14.2949 22.3806 15.9295 21.4217 16.883L20.0011 18.2954C19.6399 18.6546 19.1917 18.9171 18.6763 18.9651M4.00289 5.74561C3.96765 5.12559 4.25823 4.56668 4.69185 4.13552L6.26145 2.57483C7.13596 1.70529 8.61028 1.83992 9.37326 2.85908L10.6342 4.54348C11.2507 5.36691 11.1841 6.49484 10.4775 7.19738L10.1907 7.48257"
                                    stroke="currentColor" stroke-width="1.5"></path>
                                <path opacity="0.5"
                                    d="M18.6763 18.9651C17.0469 19.117 13.0622 18.9492 8.8154 14.7266C4.81076 10.7447 4.09308 7.33182 4.00293 5.74561"
                                    stroke="currentColor" stroke-width="1.5"></path>
                                <path opacity="0.5"
                                    d="M16.1007 13.3589C16.1007 13.3589 15.0181 14.4353 12.0631 11.4971C9.10807 8.55886 10.1907 7.48242 10.1907 7.48242"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            </svg>
                            Danger Zone
                        </a>
                    </li>
                </ul>
                <template x-if="tab === 'home'">

                    @livewire('update-profile-information-form')
                    @livewire('update-password-form')
                </template>
                <template x-if="tab === 'payment-details'">
                    <div>
                        <div class="mb-5 grid grid-cols-1 gap-5 lg:grid-cols-2">
                            <div class="panel">
                                <div class="mb-5">
                                    <h5 class="mb-4 text-lg font-semibold">Billing Address</h5>
                                    <p>
                                        Changes to your <span class="text-primary">Billing</span> information will take
                                        effect starting with
                                        scheduled payment and will be refelected on your next invoice.
                                    </p>
                                </div>
                                <div class="mb-5">
                                    <div class="border-b border-[#ebedf2] dark:border-[#1b2e4b]">
                                        <div class="flex items-start justify-between py-3">
                                            <h6 class="text-[15px] font-bold text-[#515365] dark:text-white-dark">
                                                Address #1
                                                <span
                                                    class="mt-1 block text-xs font-normal text-white-dark dark:text-white-light">2249
                                                    Caynor Circle, New Brunswick, New Jersey</span>
                                            </h6>
                                            <div class="flex items-start justify-between ltr:ml-auto rtl:mr-auto">
                                                <button class="btn btn-dark">Edit</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-b border-[#ebedf2] dark:border-[#1b2e4b]">
                                        <div class="flex items-start justify-between py-3">
                                            <h6 class="text-[15px] font-bold text-[#515365] dark:text-white-dark">
                                                Address #2
                                                <span
                                                    class="mt-1 block text-xs font-normal text-white-dark dark:text-white-light">4262
                                                    Leverton Cove Road, Springfield, Massachusetts</span>
                                            </h6>
                                            <div class="flex items-start justify-between ltr:ml-auto rtl:mr-auto">
                                                <button class="btn btn-dark">Edit</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex items-start justify-between py-3">
                                            <h6 class="text-[15px] font-bold text-[#515365] dark:text-white-dark">
                                                Address #3
                                                <span
                                                    class="mt-1 block text-xs font-normal text-white-dark dark:text-white-light">2692
                                                    Berkshire Circle, Knoxville, Tennessee</span>
                                            </h6>
                                            <div class="flex items-start justify-between ltr:ml-auto rtl:mr-auto">
                                                <button class="btn btn-dark">Edit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary">Add Address</button>
                            </div>
                            <div class="panel">
                                <div class="mb-5">
                                    <h5 class="mb-4 text-lg font-semibold">Payment History</h5>
                                    <p>
                                        Changes to your <span class="text-primary">Payment Method</span> information will
                                        take effect starting
                                        with scheduled payment and will be refelected on your next invoice.
                                    </p>
                                </div>
                                <div class="mb-5">
                                    <div class="border-b border-[#ebedf2] dark:border-[#1b2e4b]">
                                        <div class="flex items-start justify-between py-3">
                                            <div class="flex-none ltr:mr-4 rtl:ml-4">
                                                <img src="assets/images/card-americanexpress.svg" alt="image">
                                            </div>
                                            <h6 class="text-[15px] font-bold text-[#515365] dark:text-white-dark">
                                                Mastercard
                                                <span
                                                    class="mt-1 block text-xs font-normal text-white-dark dark:text-white-light">XXXX
                                                    XXXX XXXX 9704</span>
                                            </h6>
                                            <div class="flex items-start justify-between ltr:ml-auto rtl:mr-auto">
                                                <button class="btn btn-dark">Edit</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-b border-[#ebedf2] dark:border-[#1b2e4b]">
                                        <div class="flex items-start justify-between py-3">
                                            <div class="flex-none ltr:mr-4 rtl:ml-4">
                                                <img src="assets/images/card-mastercard.svg" alt="image">
                                            </div>
                                            <h6 class="text-[15px] font-bold text-[#515365] dark:text-white-dark">
                                                American Express<span
                                                    class="mt-1 block text-xs font-normal text-white-dark dark:text-white-light">XXXX
                                                    XXXX XXXX 310</span>
                                            </h6>
                                            <div class="flex items-start justify-between ltr:ml-auto rtl:mr-auto">
                                                <button class="btn btn-dark">Edit</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex items-start justify-between py-3">
                                            <div class="flex-none ltr:mr-4 rtl:ml-4">
                                                <img src="assets/images/card-visa.svg" alt="image">
                                            </div>
                                            <h6 class="text-[15px] font-bold text-[#515365] dark:text-white-dark">
                                                Visa<span
                                                    class="mt-1 block text-xs font-normal text-white-dark dark:text-white-light">XXXX
                                                    XXXX XXXX 5264</span>
                                            </h6>
                                            <div class="flex items-start justify-between ltr:ml-auto rtl:mr-auto">
                                                <button class="btn btn-dark">Edit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary">Add Payment Method</button>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
                            <div class="panel">
                                <div class="mb-5">
                                    <h5 class="mb-4 text-lg font-semibold">Add Billing Address</h5>
                                    <p>Changes your New <span class="text-primary">Billing</span> Information.</p>
                                </div>
                                <div class="mb-5">
                                    <form>
                                        <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
                                            <div>
                                                <label for="billingName">Name</label>
                                                <input id="billingName" type="text" placeholder="Enter Name"
                                                    class="form-input">
                                            </div>
                                            <div>
                                                <label for="billingEmail">Email</label>
                                                <input id="billingEmail" type="email" placeholder="Enter Email"
                                                    class="form-input">
                                            </div>
                                        </div>
                                        <div class="mb-5">
                                            <label for="billingAddress">Address</label>
                                            <input id="billingAddress" type="text" placeholder="Enter Address"
                                                class="form-input">
                                        </div>
                                        <div class="mb-5 grid grid-cols-1 gap-4 md:grid-cols-3 lg:grid-cols-4">
                                            <div class="md:col-span-2">
                                                <label for="billingCity">City</label>
                                                <input id="billingCity" type="text" placeholder="Enter City"
                                                    class="form-input">
                                            </div>
                                            <div>
                                                <label for="billingState">State</label>
                                                <select id="billingState" class="form-select text-white-dark">
                                                    <option>Choose...</option>
                                                    <option>...</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="billingZip">Zip</label>
                                                <input id="billingZip" type="text" placeholder="Enter Zip"
                                                    class="form-input">
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary">Add</button>
                                    </form>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="mb-5">
                                    <h5 class="mb-4 text-lg font-semibold">Add Payment Method</h5>
                                    <p>Changes your New <span class="text-primary">Payment Method</span> Information.</p>
                                </div>
                                <div class="mb-5">
                                    <form>
                                        <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
                                            <div>
                                                <label for="payBrand">Card Brand</label>
                                                <select id="payBrand" class="form-select text-white-dark">
                                                    <option selected="">Mastercard</option>
                                                    <option>American Express</option>
                                                    <option>Visa</option>
                                                    <option>Discover</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="payNumber">Card Number</label>
                                                <input id="payNumber" type="text" placeholder="Card Number"
                                                    class="form-input">
                                            </div>
                                        </div>
                                        <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
                                            <div>
                                                <label for="payHolder">Holder Name</label>
                                                <input id="payHolder" type="text" placeholder="Holder Name"
                                                    class="form-input">
                                            </div>
                                            <div>
                                                <label for="payCvv">CVV/CVV2</label>
                                                <input id="payCvv" type="text" placeholder="CVV"
                                                    class="form-input">
                                            </div>
                                        </div>
                                        <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
                                            <div>
                                                <label for="payExp">Card Expiry</label>
                                                <input id="payExp" type="text" placeholder="Card Expiry"
                                                    class="form-input">
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary">Add</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

            </div>
        </div>
    </div>
@endsection
