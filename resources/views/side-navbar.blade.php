<div id="menu-container">
    <div id="menu-wrapper">
       <div id="hamburger-menu"><span></span><span></span><span></span></div>
       <!-- hamburger-menu -->
    </div>
    <!-- menu-wrapper -->
    <ul class="menu-list accordion">
      <li id="" class="uppercase p-5"> 
         <a class="menu-link" href="/dashboard">Dashboard</a>
      </li>

       <li id="nav1" class="toggle accordion-toggle"> 
          <span class="icon-plus"></span>
          <a class="menu-link" href="#">Bio-Data</a>
       </li>
       <!-- accordion-toggle -->
       <ul class="menu-submenu accordion-content space-y-2">
          <li><a class="head p-4 hover:text-green-600" href="/students">Student</a></li>
          <li><a class="head p-4 hover:text-green-600" href="/guardians">Parent/Guardian</a></li>
          {{-- <li><a class="head p-4" href="#">Submenu3</a></li> --}}
       </ul>
       <!-- menu-submenu accordon-content-->
       <li id="nav2" class="toggle accordion-toggle"> 
          <span class="icon-plus"></span>
          <a class="menu-link" href="#">Menu2</a>
       </li>
       <!-- accordion-toggle -->
       <ul class="menu-submenu accordion-content">
          <li><a class="head" href="#">Submenu1</a></li>
          <li><a class="head" href="#">Submenu2</a></li>
       </ul>
       <!-- menu-submenu accordon-content-->
            <li id="nav3" class="toggle accordion-toggle"> 
          <span class="icon-plus"></span>
          <a class="menu-link" href="#">Setup</a>
       </li>
       <!-- accordion-toggle -->
       <ul class="menu-submenu accordion-content space-y-2">
          <li><a class="head p-4 hover:text-green-600" href="/courses">Course</a></li>
          <li><a class="head p-4 hover:text-green-600" href="/departments">Department</a></li>
          <li><a class="head p-4 hover:text-green-600" href="/occupations">Occupation</a></li>
          <li><a class="head p-4 hover:text-green-600" href="/relations">Relation</a></li>
       </ul>
       <!-- menu-submenu accordon-content-->
    </ul>
    <!-- menu-list accordion-->
 </div>
 <!-- menu-container -->