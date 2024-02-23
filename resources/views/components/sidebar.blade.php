 <!-- start sidebar section -->
 <div :class="{ 'dark text-white-dark': $store.app.semidark }">
     <nav x-data="sidebar"
         class="sidebar fixed top-0 bottom-0 z-50 h-full min-h-screen w-[260px] shadow-[5px_0_25px_0_rgba(94,92,154,0.1)] transition-all duration-300">
         <div class="h-full bg-white dark:bg-[#0e1726]">
             <div class="flex items-center justify-between px-4 py-3">
                 <a href="index.html" class="main-logo flex shrink-0 items-center">
                     <img class="ml-[5px]  flex-none" style="width: 10rem;"
                         src="{{ asset('assets/images/logo-my-work.png') }}" alt="image" />
                 </a>
                 <a href="javascript:;"
                     class="collapse-icon flex h-8 w-8 items-center rounded-full transition duration-300 hover:bg-gray-500/10 rtl:rotate-180 dark:text-white-light dark:hover:bg-dark-light/10"
                     @click="$store.app.toggleSidebar()">
                     <svg class="m-auto h-5 w-5" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                         <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                             stroke-linejoin="round" />
                         <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor"
                             stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                     </svg>
                 </a>
             </div>
             <ul class="perfect-scrollbar relative h-[calc(100vh-80px)] space-y-0.5 overflow-y-auto overflow-x-hidden p-4 py-0 font-semibold"
                 x-data="{ activeDropdown: 'dashboard' }">
                 <li class="menu nav-item">
                     <a href="{{ route('admin.home') }}" class="nav-link group">
                         <div class="flex items-center">
                             <svg class="shrink-0 group-hover:!text-primary" width="20" height="20"
                                 viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path opacity="0.5"
                                     d="M2 12.2039C2 9.91549 2 8.77128 2.5192 7.82274C3.0384 6.87421 3.98695 6.28551 5.88403 5.10813L7.88403 3.86687C9.88939 2.62229 10.8921 2 12 2C13.1079 2 14.1106 2.62229 16.116 3.86687L18.116 5.10812C20.0131 6.28551 20.9616 6.87421 21.4808 7.82274C22 8.77128 22 9.91549 22 12.2039V13.725C22 17.6258 22 19.5763 20.8284 20.7881C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.7881C2 19.5763 2 17.6258 2 13.725V12.2039Z"
                                     fill="currentColor" />
                                 <path
                                     d="M9 17.25C8.58579 17.25 8.25 17.5858 8.25 18C8.25 18.4142 8.58579 18.75 9 18.75H15C15.4142 18.75 15.75 18.4142 15.75 18C15.75 17.5858 15.4142 17.25 15 17.25H9Z"
                                     fill="currentColor" />
                             </svg>

                             <span
                                 class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Dashboard</span>
                         </div>
                     </a>
                 </li>

                 <h2
                     class="-mx-4 mb-1 flex items-center bg-white-light/30 py-3 px-7 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]">
                     <svg class="hidden h-5 w-4 flex-none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"
                         fill="none" stroke-linecap="round" stroke-linejoin="round">
                         <line x1="5" y1="12" x2="19" y2="12"></line>
                     </svg>
                     <span>App</span>
                 </h2>

                 <li class="nav-item">
                     <ul>

                         <li class="nav-item">
                             <a href="{{ route('admin.superadmin.forms.index') }}" class="group">
                                 <div class="flex items-center">
                                     <svg class="shrink-0 group-hover:!text-primary" width="20" height="20"
                                         viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path opacity="0.5"
                                             d="M3 10C3 6.22876 3 4.34315 4.17157 3.17157C5.34315 2 7.22876 2 11 2H13C16.7712 2 18.6569 2 19.8284 3.17157C21 4.34315 21 6.22876 21 10V14C21 17.7712 21 19.6569 19.8284 20.8284C18.6569 22 16.7712 22 13 22H11C7.22876 22 5.34315 22 4.17157 20.8284C3 19.6569 3 17.7712 3 14V10Z"
                                             fill="currentColor" />
                                         <path fill-rule="evenodd" clip-rule="evenodd"
                                             d="M7.25 12C7.25 11.5858 7.58579 11.25 8 11.25H16C16.4142 11.25 16.75 11.5858 16.75 12C16.75 12.4142 16.4142 12.75 16 12.75H8C7.58579 12.75 7.25 12.4142 7.25 12Z"
                                             fill="currentColor" />
                                         <path fill-rule="evenodd" clip-rule="evenodd"
                                             d="M7.25 8C7.25 7.58579 7.58579 7.25 8 7.25H16C16.4142 7.25 16.75 7.58579 16.75 8C16.75 8.41421 16.4142 8.75 16 8.75H8C7.58579 8.75 7.25 8.41421 7.25 8Z"
                                             fill="currentColor" />
                                         <path fill-rule="evenodd" clip-rule="evenodd"
                                             d="M7.25 16C7.25 15.5858 7.58579 15.25 8 15.25H13C13.4142 15.25 13.75 15.5858 13.75 16C13.75 16.4142 13.4142 16.75 13 16.75H8C7.58579 16.75 7.25 16.4142 7.25 16Z"
                                             fill="currentColor" />
                                     </svg>
                                     <span
                                         class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Forms</span>
                                 </div>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ route('admin.mywork.reviews.index') }}" class="group">
                                 <div class="flex items-center">
                                     <svg class="shrink-0 group-hover:!text-primary" width="20" height="20"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                             d="M11.049 2.927c.3-.921 1.653-.921 1.953 0l1.717 5.284a1.06 1.06 0 001.006.731h5.525c.97 0 1.371 1.24.588 1.81l-4.486 3.265a1.06 1.06 0 00-.383 1.174l1.717 5.284c.3.921-.755 1.688-1.588 1.174l-4.486-3.265a1.06 1.06 0 00-1.241 0l-4.486 3.265c-.833.514-1.888-.253-1.588-1.174l1.717-5.284a1.06 1.06 0 00-.383-1.174l-4.486-3.265c-.783-.57-.382-1.81.588-1.81h5.525a1.06 1.06 0 001.006-.73l1.717-5.284z" />
                                     </svg>
                                     <span
                                         class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">My
                                         Work Reviews</span>
                                 </div>
                             </a>
                         </li>
                         <li class="nav-item">
                            <a href="{{ route('admin.ads.index') }}" class="group">
                                <div class="flex items-center">
                                    <svg class="shrink-0 group-hover:!text-primary" width="20" height="20"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 11l18-5v2l-6.4 2.5L21 16v2l-18-5v-2m6 0h.01"></path> <!-- Ovo je SVG za megafon -->
                                    </svg>
                                    <span
                                        class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">
                                        Werbung</span> <!-- Ovdje sam pretpostavio da je 'Werbung' riječ za oglase -->
                                </div>
                            </a>
                        </li>
                        

                         <li class="nav-item">
                            <a href="{{ route('admin.admin-jobs') }}" class="group">
                                <div class="flex items-center">
                                    <svg class="shrink-0 group-hover:!text-primary" width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M3 21h18a2 2 0 002-2V7a2 2 0 00-2-2H3a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Jobs</span>
                                </div>
                            </a>
                        </li>
                        

                     </ul>
                 </li>



                 <h2
                     class="-mx-4 mb-1 flex items-center bg-white-light/30 py-3 px-7 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]">
                     <svg class="hidden h-5 w-4 flex-none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"
                         fill="none" stroke-linecap="round" stroke-linejoin="round">
                         <line x1="5" y1="12" x2="19" y2="12"></line>
                     </svg>
                     <span>USER AND PAGES</span>
                 </h2>

                 <li class="menu nav-item">
                     <button type="button" class="nav-link group"
                         :class="{ 'active': activeDropdown === 'users' }"
                         @click="activeDropdown === 'users' ? activeDropdown = null : activeDropdown = 'users'">
                         <div class="flex items-center">
                             <svg class="shrink-0 group-hover:!text-primary" width="20" height="20"
                                 viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <circle opacity="0.5" cx="15" cy="6" r="3" fill="currentColor" />
                                 <ellipse opacity="0.5" cx="16" cy="17" rx="5"
                                     ry="3" fill="currentColor" />
                                 <circle cx="9.00098" cy="6" r="4" fill="currentColor" />
                                 <ellipse cx="9.00098" cy="17.001" rx="7" ry="4"
                                     fill="currentColor" />
                             </svg>
                             <span
                                 class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">User
                                 Managment</span>
                         </div>
                         <div class="rtl:rotate-180" :class="{ '!rotate-90': activeDropdown === 'users' }">
                             <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5"
                                     stroke-linecap="round" stroke-linejoin="round" />
                             </svg>
                         </div>
                     </button>
                     <ul x-cloak x-show="activeDropdown === 'users'" x-collapse class="sub-menu text-gray-500">
                         @can('permission_access')
                             <li>
                                 <a class="{{ request()->is('admin/permissions*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                     href="{{ route('admin.permissions.index') }}">
                                     <i class="fa-fw c-sidebar-nav-icon fas fa-unlock-alt">
                                     </i>
                                     {{ trans('cruds.permission.title') }}
                                 </a>
                             </li>
                         @endcan
                         @can('role_access')
                             <li>
                                 <a class="{{ request()->is('admin/roles*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                     href="{{ route('admin.roles.index') }}">{{ trans('cruds.role.title') }}</a>
                             </li>
                         @endcan
                         @can('user_access')
                             <li>
                                 <a class="{{ request()->is('admin/users*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                     href="{{ route('admin.users.index') }}">{{ trans('cruds.user.title') }}</a>
                             </li>
                         @endcan
                     </ul>
                 </li>
                 @can('content_management_access')
                     <li class="menu nav-item">
                         <button type="button" class="nav-link group"
                             :class="{ 'active': activeDropdown === 'pages' }"
                             @click="activeDropdown === 'pages' ? activeDropdown = null : activeDropdown = 'pages'">
                             <div class="flex items-center">
                                 <svg class="shrink-0 group-hover:!text-primary" width="20" height="20"
                                     viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd"
                                         d="M14 22H10C6.22876 22 4.34315 22 3.17157 20.8284C2 19.6569 2 17.7712 2 14V10C2 6.22876 2 4.34315 3.17157 3.17157C4.34315 2 6.23869 2 10.0298 2C10.6358 2 11.1214 2 11.53 2.01666C11.5166 2.09659 11.5095 2.17813 11.5092 2.26057L11.5 5.09497C11.4999 6.19207 11.4998 7.16164 11.6049 7.94316C11.7188 8.79028 11.9803 9.63726 12.6716 10.3285C13.3628 11.0198 14.2098 11.2813 15.0569 11.3952C15.8385 11.5003 16.808 11.5002 17.9051 11.5001L18 11.5001H21.9574C22 12.0344 22 12.6901 22 13.5629V14C22 17.7712 22 19.6569 20.8284 20.8284C19.6569 22 17.7712 22 14 22Z"
                                         fill="currentColor" />
                                     <path
                                         d="M6 13.75C5.58579 13.75 5.25 14.0858 5.25 14.5C5.25 14.9142 5.58579 15.25 6 15.25H14C14.4142 15.25 14.75 14.9142 14.75 14.5C14.75 14.0858 14.4142 13.75 14 13.75H6Z"
                                         fill="currentColor" />
                                     <path
                                         d="M6 17.25C5.58579 17.25 5.25 17.5858 5.25 18C5.25 18.4142 5.58579 18.75 6 18.75H11.5C11.9142 18.75 12.25 18.4142 12.25 18C12.25 17.5858 11.9142 17.25 11.5 17.25H6Z"
                                         fill="currentColor" />
                                     <path
                                         d="M11.5092 2.2601L11.5 5.0945C11.4999 6.1916 11.4998 7.16117 11.6049 7.94269C11.7188 8.78981 11.9803 9.6368 12.6716 10.3281C13.3629 11.0193 14.2098 11.2808 15.057 11.3947C15.8385 11.4998 16.808 11.4997 17.9051 11.4996L21.9574 11.4996C21.9698 11.6552 21.9786 11.821 21.9848 11.9995H22C22 11.732 22 11.5983 21.9901 11.4408C21.9335 10.5463 21.5617 9.52125 21.0315 8.79853C20.9382 8.6713 20.8743 8.59493 20.7467 8.44218C19.9542 7.49359 18.911 6.31193 18 5.49953C17.1892 4.77645 16.0787 3.98536 15.1101 3.3385C14.2781 2.78275 13.862 2.50487 13.2915 2.29834C13.1403 2.24359 12.9408 2.18311 12.7846 2.14466C12.4006 2.05013 12.0268 2.01725 11.5 2.00586L11.5092 2.2601Z"
                                         fill="currentColor" />
                                 </svg>
                                 <span
                                     class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Pages</span>
                             </div>
                             <div class="rtl:rotate-180" :class="{ '!rotate-90': activeDropdown === 'pages' }">
                                 <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5"
                                         stroke-linecap="round" stroke-linejoin="round" />
                                 </svg>
                             </div>
                         </button>
                         <ul x-cloak x-show="activeDropdown === 'pages'" x-collapse class="sub-menu text-gray-500">
                             @can('content_category_access')
                                 <li>
                                     <a class="{{ request()->is('admin/content-categories*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                         href="{{ route('admin.content-categories.index') }}">
                                         {{ trans('cruds.contentCategory.title') }} </a>
                                 </li>
                             @endcan
                             @can('content_tag_access')
                                 <li>
                                     <a class="{{ request()->is('admin/content-tags*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                         href="{{ route('admin.content-tags.index') }}"
                                         target="_self">{{ trans('cruds.contentTag.title') }}</a>
                                 </li>
                             @endcan
                             @can('content_page_access')
                                 <li>
                                     <a class="{{ request()->is('admin/content-pages*') ? 'sidebar-nav-active' : 'sidebar-nav' }}"
                                         href="{{ route('admin.content-pages.index') }}" target="_self">
                                         {{ trans('cruds.contentPage.title') }}</a>
                                 </li>
                             @endcan

                         </ul>
                     </li>
                 @endcan


                 <h2
                     class="-mx-4 mb-1 flex items-center bg-white-light/30 py-3 px-7 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]">
                     <svg class="hidden h-5 w-4 flex-none" viewBox="0 0 24 24" stroke="currentColor"
                         stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                         <line x1="5" y1="12" x2="19" y2="12"></line>
                     </svg>
                     <span>SUPPORTS</span>
                 </h2>

                 <li class="menu nav-item">
                     <a href="{{ route('admin.user-alerts.index') }}" target="_blank"
                         class="nav-link group {{ request()->is('admin/user-alerts*') ? 'sidebar-nav-active' : 'sidebar-nav' }}">
                         <div class="flex items-center">
                             <svg class="shrink-0 group-hover:!text-primary" width="20" height="20"
                                 viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd"
                                     d="M4 4.69434V18.6943C4 20.3512 5.34315 21.6943 7 21.6943H17C18.6569 21.6943 20 20.3512 20 18.6943V8.69434C20 7.03748 18.6569 5.69434 17 5.69434H5C4.44772 5.69434 4 5.24662 4 4.69434ZM7.25 11.6943C7.25 11.2801 7.58579 10.9443 8 10.9443H16C16.4142 10.9443 16.75 11.2801 16.75 11.6943C16.75 12.1085 16.4142 12.4443 16 12.4443H8C7.58579 12.4443 7.25 12.1085 7.25 11.6943ZM7.25 15.1943C7.25 14.7801 7.58579 14.4443 8 14.4443H13.5C13.9142 14.4443 14.25 14.7801 14.25 15.1943C14.25 15.6085 13.9142 15.9443 13.5 15.9443H8C7.58579 15.9443 7.25 15.6085 7.25 15.1943Z"
                                     fill="currentColor" />
                                 <path opacity="0.5"
                                     d="M18 4.00038V5.86504C17.6872 5.75449 17.3506 5.69434 17 5.69434H5C4.44772 5.69434 4 5.24662 4 4.69434V4.62329C4 4.09027 4.39193 3.63837 4.91959 3.56299L15.7172 2.02048C16.922 1.84835 18 2.78328 18 4.00038Z"
                                     fill="currentColor" />
                             </svg>
                             <span
                                 class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">
                                 {{ trans('cruds.userAlert.title') }}</span>
                         </div>
                     </a>
                 </li>

             </ul>
         </div>
     </nav>
 </div>
 <!-- end sidebar section -->
