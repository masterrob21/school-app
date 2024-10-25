<div id="menu-container">
    <div id="menu-wrapper">
       <div id="hamburger-menu"><span></span><span></span><span></span></div>
       <!-- hamburger-menu -->
    </div>
    <!-- menu-wrapper -->
    <ul class="menu-list accordion">
      <li id="nav1" class="uppercase p-5 hover:bg-lime-400"> 
         <a class="menu-link" href="/dashboard">Dashboard</a>
      </li>

       <li id="nav2" class="toggle accordion-toggle hover:bg-lime-400"> 
          <span class="icon-plus"></span>
          <a class="menu-link" href="#">Bio-Data</a>
       </li>
       <!-- accordion-toggle -->
       <ul class="menu-submenu accordion-content space-y-2">
          <li class="px-6"><a class="hover:text-lime-500" href="/students">Student</a></li>
          <li class="px-6"><a class="hover:text-lime-500" href="/guardians">Parent/Guardian</a></li>
          {{-- <li><a class="head p-4" href="#">Submenu3</a></li> --}}
       </ul>

       <!-- menu-submenu accordon-content-->
       <li id="nav3" class="toggle accordion-toggle hover:bg-lime-400"> 
          <span class="icon-plus"></span>
          <a class="menu-link" href="#">HR</a>
       </li>
       <!-- accordion-toggle -->
       <ul class="menu-submenu accordion-content space-y-2">
          <li class="px-6"><a class="hover:text-lime-500" href="/staffs">Staff</a></li>
          {{-- <li class="px-6"><a class="hover:text-lime-500" href="#">Submenu2</a></li> --}}
       </ul>

       <!-- menu-submenu accordon-content-->
       <li id="nav4" class="toggle accordion-toggle hover:bg-lime-400"> 
         <span class="icon-plus"></span>
         <a class="menu-link" href="#">accounting</a>
      </li>
      <!-- accordion-toggle -->
      <ul class="menu-submenu accordion-content space-y-2">
         <li class="px-6"><a class="hover:text-lime-500" href="/accountcharts">Chart of Accounts</a></li>
         {{-- <li class="px-6"><a class="hover:text-lime-500" href="#">Submenu2</a></li> --}}
      </ul>

      <!-- menu-submenu accordon-content-->
      <li id="nav5" class="uppercase p-5 hover:bg-lime-400"> 
         <a class="menu-link" href="/user">Users</a>
      </li>

      <!-- menu-submenu accordon-content-->
      <li id="nav6" class="uppercase p-5 hover:bg-lime-400"> 
         <a class="menu-link" href="/settings">Settings</a>
      </li>

    </ul>
    <!-- menu-list accordion-->
 </div>
 <!-- menu-container -->