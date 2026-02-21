 <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
     <!--begin::Sidebar Brand-->
     <div class="sidebar-brand">
         <!--begin::Brand Link-->
         <a href="/src/index.html" class="brand-link">
             <!--begin::Brand Image-->
             <img
                 src="/src/assets/img/AdminLTELogo.png"
                 alt="AdminLTE Logo"
                 class="brand-image opacity-75 shadow" />
             <!--end::Brand Image-->
             <!--begin::Brand Text-->
             <span class="brand-text fw-light">InternLink</span>
             <!--end::Brand Text-->
         </a>
         <!--end::Brand Link-->
     </div>
     <!--end::Sidebar Brand-->
     <!--begin::Sidebar Wrapper-->
     <div class="sidebar-wrapper">
         <nav class="mt-2">
             <!--begin::Sidebar Menu-->
             <ul
                 class="nav sidebar-menu flex-column"
                 data-lte-toggle="treeview"
                 role="navigation"
                 aria-label="Main navigation"
                 data-accordion="false"
                 id="navigation">
                 <li class="nav-item">
                     <a href="{{url('/dashboard')}}" class="nav-link">
                         <i class="nav-icon bi bi-house-fill"></i>
                         <p>Dashboard</p>
                     </a>
                 </li>

                 <li class="nav-item">
                     <a href="{{url('/opportunities')}}" class="nav-link">
                         <i class="nav-icon bi bi-list-task"></i>
                         <p>Opportunities</p>
                     </a>
                 </li>


                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon bi bi-file-earmark-text-fill"></i>
                         <p>Applications</p>
                     </a>
                 </li>




                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon bi bi-openai"></i>
                         <p>
                             AI Tools
                             <i class="nav-arrow bi bi-chevron-right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="nav-icon bi bi-circle"></i>
                                 <p>AI Resume Checker</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="nav-icon bi bi-circle"></i>
                                 <p>AI Assistant</p>
                             </a>
                         </li>

                     </ul>
                 </li>

                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon bi bi-people"></i>
                         <p>All Students</p>
                     </a>
                 </li>

                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon bi bi-building-fill"></i>
                         <p>Organizations</p>
                     </a>
                 </li>


                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon bi bi-bell-fill"></i>
                         <p>Notifications</p>
                     </a>
                 </li>


                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon bi bi-graph-up"></i>
                         <p>Reports</p>
                     </a>
                 </li>


                 <li class="nav-item">
                     <a href="{{url('/profile')}}" class="nav-link">
                         <i class="nav-icon bi bi-person-circle"></i>
                         <p>Profile</p>
                     </a>
                 </li>


                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon bi bi-gear-fill"></i>
                         <p>
                             Settings
                             <i class="nav-arrow bi bi-chevron-right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="nav-icon bi bi-circle"></i>
                                 <p>Permissions</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="nav-icon bi bi-circle"></i>
                                 <p>System Logs</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="nav-icon bi bi-circle"></i>
                                 <p>General Setting</p>
                             </a>
                         </li>
                     </ul>
                 </li>


                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon bi bi-box-arrow-in-right"></i>
                         <p>Logout</p>
                     </a>
                 </li>




             </ul>
             <!--end::Sidebar Menu-->
         </nav>
     </div>
     <!--end::Sidebar Wrapper-->
 </aside>