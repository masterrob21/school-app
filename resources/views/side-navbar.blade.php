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

       <li id="nav2" class="uppercase p-5 hover:bg-lime-400"> 
          <a class="menu-link" href="/student-dashboard">student</a>
       </li>

       <!-- menu-submenu accordon-content-->
       <li id="nav3" class="uppercase p-5 hover:bg-lime-400">
          <a class="menu-link" href="/staff-dashboard">staff</a>
       </li>

       <!-- menu-submenu accordon-content-->
       <li id="nav4" class="uppercase p-5 hover:bg-lime-400"> 
         <a class="menu-link" href="/accounting">accounting</a>
      </li>

      <!-- menu-submenu accordon-content-->
      @role('admin')
      <li id="nav5" class="uppercase p-5 hover:bg-lime-400"> 
         <a class="menu-link" href="/security">Security</a>
      </li>
      @endrole

      <!-- menu-submenu accordon-content-->
      @role('admin')
      <li id="nav6" class="uppercase p-5 hover:bg-lime-400"> 
         <a class="menu-link" href="/settings">Settings</a>
      </li>
      @endrole

    </ul>
    <!-- menu-list accordion-->
 </div>
 <!-- menu-container -->