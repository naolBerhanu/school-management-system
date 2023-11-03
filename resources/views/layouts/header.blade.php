<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
       <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
       </li>
    </ul>
 </nav>
 <!-- /.navbar -->
 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary  elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link" style="text-align:center">
    <span class="brand-text font-weight-light" style="font-weight: bold !important; font-weight: 20px">School</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
       <!-- Sidebar user panel (optional) -->
       <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
             <img src="{{Auth::user()->getProfileDirect()}}" class="img-circle elevation-2" alt="{{Auth::user()->name}}">
             {{-- @if (!empty($value->getProfile()))
             <img src="{{$value->getProfile()}}" alt="" style="width: 50px; height: 50px; border-radius: 50%;">
             @endif --}}
          </div>
          <div class="info">
             <a href="#" class="d-block">{{Auth::user()->name}}</a>
          </div>
       </div>
       <!-- Sidebar Menu -->
       <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
             @if(Auth::user()->user_type == 1)
             <li class="nav-item">
                <a href="{{url('admin/dashboard')}}" class="nav-link @if(Request::segment(2) == 'dashboard' ) active @endif">
                   <i class="nav-icon fas fa-tachometer-alt"></i>
                   <p>
                      Dashboard
                   </p>
                </a>
             </li>
             <li class="nav-item">
                <a href="{{url('admin/admin/list')}}" class="nav-link @if(Request::segment(2) == 'admin' ) active @endif">
                   <i class="nav-icon far fa-user"></i>
                   <p>
                      Admins
                   </p>
                </a>
             </li>
             <li class="nav-item">
                <a href="{{url('admin/teacher/list')}}" class="nav-link @if(Request::segment(2) == 'teacher' ) active @endif">
                   <i class="nav-icon far fas fa-chalkboard-teacher"></i>
                   <p>
                      Teachers
                   </p>
                </a>
             </li>
             <li class="nav-item">
                <a href="{{url('admin/student/list')}}" class="nav-link @if(Request::segment(2) == 'student' ) active @endif">
                   <i class="nav-icon fa fa-graduation-cap"></i>
                   <p>
                      Students
                   </p>
                </a>
             </li>
             <li class="nav-item">
                <a href="{{url('admin/parent/list')}}" class="nav-link @if(Request::segment(2) == 'parent' ) active @endif">
                   <i class="nav-icon fa fa-users"></i>
                   <p>
                      Parents
                   </p>
                </a>
             </li>
             <li class="nav-item @if(Request::segment(2) == 'class' || Request::segment(2) == 'subject' || Request::segment(2) == 'assign_class_teacher' || Request::segment(2) == 'assign_subject') menu-is-open menu-open  @endif">
                <a href="#" class="nav-link @if(Request::segment(2) == 'class' || Request::segment(2) == 'subject' || Request::segment(2) == 'assign_class_teacher' || Request::segment(2) == 'assign_subject') active @endif">
                   <i class="nav-icon fas fa-table"></i>
                   <p>
                      Academics
                      <i class="fas fa-angle-left right"></i>
                   </p>
                </a>
                <ul class="nav nav-treeview" style="padding-left: 16px">
                   <li class="nav-item">
                      <a href="{{url('admin/class/list')}}" class="nav-link @if(Request::segment(2) == 'class' ) active @endif">
                         <i class="fa fa-users nav-icon"></i>
                         <p>Class</p>
                      </a>
                   </li>
                   <li class="nav-item">
                      <a href="{{url('admin/subject/list')}}" class="nav-link @if(Request::segment(2) == 'subject' ) active @endif">
                         <i class="fa fa-book nav-icon"></i>
                         <p>Subject</p>
                      </a>
                   </li>
                   <li class="nav-item">
                      <a href="{{url('admin/assign_subject/list')}}" class="nav-link  @if(Request::segment(2) == 'assign_subject' ) active @endif">
                         <i class="fa fa-pen nav-icon"></i>
                         <p>Assign Subject</p>
                      </a>
                   </li>
                   <li class="nav-item">
                      <a href="{{url('admin/assign_class_teacher/list')}}" class="nav-link  @if(Request::segment(2) == 'assign_class_teacher' ) active @endif">
                         <i class="fa fas fa-chalkboard-teacher nav-icon"></i>
                         <p>Assign Class Teacher</p>
                      </a>
                   </li>
                </ul>
             </li>
             <li class="nav-item @if(Request::segment(2) == 'examinations') menu-is-open menu-open  @endif">
                <a href="#" class="nav-link @if(Request::segment(2) == 'examinations') active @endif">
                   <i class="nav-icon fas fa-table"></i>
                   <p>
                      Examinations
                      <i class="fas fa-angle-left right"></i>
                   </p>
                </a>
                <ul class="nav nav-treeview" style="padding-left: 16px">
                   <li class="nav-item">
                      <a href="{{url('admin/examinations/exam/list')}}" class="nav-link @if(Request::segment(3) == 'exam' ) active @endif">
                         <i class="fa fa-users nav-icon"></i>
                         <p>Exam</p>
                      </a>
                   </li>
                   <li class="nav-item">
                      <a href="{{url('admin/examinations/exam_schedule')}}" class="nav-link @if(Request::segment(3) == 'exam_schedule' ) active @endif">
                         <i class="fa fa-users nav-icon"></i>
                         <p>Exam Schedule</p>
                      </a>
                   </li>
                   <li class="nav-item">
                      <a href="{{url('admin/examinations/marks_register')}}" class="nav-link @if(Request::segment(3) == 'marks_register' ) active @endif">
                         <i class="fa fa-pen nav-icon"></i>
                         <p>Marks Register</p>
                      </a>
                   </li>
                </ul>
             </li>
             {{--
             <li class="nav-item">
                <a href="{{url('admin/class/list')}}" class="nav-link @if(Request::segment(2) == 'class' ) active @endif">
                   <i class="nav-icon fas fa-users"></i>
                   <p>
                      Class
                   </p>
                </a>
             </li>
             <li class="nav-item">
                <a href="{{url('admin/subject/list')}}" class="nav-link @if(Request::segment(2) == 'subject' ) active @endif">
                   <i class="nav-icon fas fa-book"></i>
                   <p>
                      Subject
                   </p>
                </a>
             </li>
             <li class="nav-item">
                <a href="{{url('admin/assign_subject/list')}}" class="nav-link @if(Request::segment(2) == 'assign_subject' ) active @endif">
                   <i class="nav-icon fas fa-pen"></i>
                   <p>
                      Assign Subject
                   </p>
                </a>
             </li>
             --}}
             <li class="nav-item">
                <a href="{{url('admin/change_password')}}" class="nav-link @if(Request::segment(2) == 'change_password' ) active @endif">
                   <i class="nav-icon fas fa-lock"></i>
                   <p>
                      Change Password
                   </p>
                </a>
             </li>
             </li>
             <li class="nav-item">
                <a href="{{url('admin/account')}}" class="nav-link @if(Request::segment(2) == 'account' ) active @endif">
                   <i class="nav-icon fas fa-user"></i>
                   <p>
                      My Account
                   </p>
                </a>
             </li>
             @elseif(Auth::user()->user_type == 2)
             <li class="nav-item">
                <a href="{{url('teacher/dashboard')}}" class="nav-link @if(Request::segment(2) == 'dashboard' ) active @endif">
                   <i class="nav-icon fas fa-tachometer-alt"></i>
                   <p>
                      Dashboard
                   </p>
                </a>
             </li>
             <li class="nav-item">
                <a href="{{url('teacher/change_password')}}" class="nav-link @if(Request::segment(2) == 'change_password' ) active @endif">
                   <i class="nav-icon fas fa-lock"></i>
                   <p>
                      Change Password
                   </p>
                </a>
             </li>
             <li class="nav-item">
                <a href="{{url('teacher/account')}}" class="nav-link @if(Request::segment(2) == 'account' ) active @endif">
                   <i class="nav-icon fas fa-user"></i>
                   <p>
                      My Account
                   </p>
                </a>
             </li>
             @elseif(Auth::user()->user_type == 3)
             <li class="nav-item">
                <a href="{{url('student/dashboard')}}" class="nav-link @if(Request::segment(2) == 'dashboard' ) active @endif">
                   <i class="nav-icon fas fa-tachometer-alt"></i>
                   <p>
                      Dashboard
                   </p>
                </a>
             </li>
             <li class="nav-item">
                <a href="{{url('student/account')}}" class="nav-link @if(Request::segment(2) == 'account' ) active @endif">
                   <i class="nav-icon fas fa-user"></i>
                   <p>
                      My Account
                   </p>
                </a>
             </li>
             <li class="nav-item">
                <a href="{{url('student/my_subject')}}" class="nav-link @if(Request::segment(2) == 'my_subject' ) active @endif">
                   <i class="nav-icon fas fa-book"></i>
                   <p>
                      Subjects
                   </p>
                </a>
             </li>
             </li>
             <li class="nav-item">
                <a href="{{url('student/my_exam_result')}}" class="nav-link @if(Request::segment(2) == 'my_exam_result' ) active @endif">
                   <i class="nav-icon fas fa-eye"></i>
                   <p>
                      Exam Results
                   </p>
                </a>
             </li>
             <li class="nav-item">
                <a href="{{url('student/change_password')}}" class="nav-link @if(Request::segment(2) == 'change_password' ) active @endif">
                   <i class="nav-icon fas fa-lock"></i>
                   <p>
                      Change Password
                   </p>
                </a>
             </li>
             @elseif(Auth::user()->user_type == 4)
             <li class="nav-item">
                <a href="{{url('parent/dashboard')}}" class="nav-link @if(Request::segment(2) == 'dashboard' ) active @endif">
                   <i class="nav-icon fas fa-tachometer-alt"></i>
                   <p>
                      Dashboard
                   </p>
                </a>
             </li>
             </li>
             <li class="nav-item">
                <a href="{{url('parent/my_student')}}" class="nav-link @if(Request::segment(2) == 'my_student' ) active @endif">
                   <i class="nav-icon fas fa-child"></i>
                   <p>
                      My Children
                   </p>
                </a>
             </li>
             </li>
             <li class="nav-item">
                <a href="{{url('parent/account')}}" class="nav-link @if(Request::segment(2) == 'account' ) active @endif">
                   <i class="nav-icon fas fa-user"></i>
                   <p>
                      My Account
                   </p>
                </a>
             </li>
             <li class="nav-item">
                <a href="{{url('parent/change_password')}}" class="nav-link @if(Request::segment(2) == 'change_password' ) active @endif">
                   <i class="nav-icon fas fa-lock"></i>
                   <p>
                      Change Password
                   </p>
                </a>
             </li>
             @endif
             <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
             <li class="nav-item">
                <a href="{{url('logout')}}" class="nav-link">
                   <i class="nav-icon fas fa-sign-out-alt"></i>
                   <p>
                      Log out
                   </p>
                </a>
             </li>
          </ul>
       </nav>
       <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
 </aside>
