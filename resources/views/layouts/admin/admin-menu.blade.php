<ul class="metismenu" id="menu-bar">

    <li><a href="{{ route('admin.dashboard') }}" class="{{ in_array(Route::currentRouteName(), ['admin.dashboard']) ? 'active' : '' }}"><i class="uil-home-alt"></i><span> Dashboard </span></a></li>

    <li><a href="{{ route('admin.user.index') }}" class="{{ in_array(Route::currentRouteName(),[ 'admin.user.index', 'admin.user.create' ]) ? 'active' : '' }}"><i class="uil-users-alt"></i><span>Users</span></a></li>

    <!-- <li><a href="{{ route('admin.blogs.index') }}" class="{{ in_array(Route::currentRouteName(),['admin.blogs.index','admin.blogs.create','admin.blogs.edit']) ? 'active' : '' }}"><i class="uil-file-alt"></i>Blogs</span></a></li> -->

    <li><a href="{{ route('admin.travelguide.index') }}" class="{{ in_array(Route::currentRouteName(),['admin.travelguide.index','admin.travelguide.create','admin.travelguide.edit']) ? 'active' : '' }}"><i class="uil-plane-departure"></i>Travel Guide</span></a></li> 

    <li><a href="{{ route('admin.schedule.index') }}" class="{{ in_array(Route::currentRouteName(),['admin.schedule.index','admin.schedule.create','admin.schedule.edit']) ? 'active' : '' }}"><i class="uil-schedule"></i>Schedule</span></a></li> 
    
    <li>
        <a href="{{ route('admin.liveprogram.index') }}" class="{{ in_array(Route::currentRouteName(),['admin.liveprogram.index','admin.liveprogram.create','admin.liveprogram.edit']) ? 'active' : '' }}">
            <i class="uil-youtube"></i> Live Program
        </a>
    </li>


    <li>
        <a href="{{ route('admin.nearbyfacility.index') }}" class="{{ in_array(Route::currentRouteName(),['admin.nearbyfacility.index','admin.nearbyfacility.create','admin.nearbyfacility.edit']) ? 'active' : '' }}">
            <i class="uil-map-marker"></i> Near By Facility
        </a>
    </li>
    
    <li><a href="{{ route('admin.volunteerlist.index') }}" class="{{ in_array(Route::currentRouteName(),['admin.volunteerlist.index','admin.volunteerlist.create','admin.volunteerlist.edit']) ? 'active' : '' }}"><i class="uil-user-plus"></i>volunteer iLst</span></a></li> 
    

    <li>

        <a href="javascript: void(0);" class=""><i class="uil-book-open"></i>Quran </span><span class="menu-arrow"></span></a>
        <ul class="nav-second-level" aria-expanded="false">
            <li><a href="{{ route('admin.surah.index') }}" class="{{ in_array(Route::currentRouteName(),['admin.surah.index']) ? 'active' : '' }}"> <i class="uil-book-reader"></i> Surah</a></li>
            <li><a href="{{ route('admin.ayat.index') }}" class="{{ in_array(Route::currentRouteName(),['admin.ayat.index']) ? 'active' : '' }}"><i class="uil-book-alt"></i> Ayahs</a></li>


        </ul>
    </li>

    <li><a href="{{ route('admin.assistance.index') }}" class="{{ in_array(Route::currentRouteName(),['admin.assistance.index','admin.assistance.create','admin.assistance.edit']) ? 'active' : '' }}"><i class="uil-heart-medical"></i>Assistance</span></a></li> 

    <!-- <li><a href="{{ route('admin.faqs.index') }}" class="{{ in_array(Route::currentRouteName(),['admin.faqs.index', 'admin.faqs.create', 'admin.faqs.edit']) ? 'active' : '' }}"><i class="uil uil-question-circle"></i><span>FAQs</span></a></li> -->

    <!-- <li><a href="{{ route('admin.category.index') }}" class="{{ in_array(Route::currentRouteName(),['admin.category.index', 'admin.category.create', 'admin.category.edit']) ? 'active' : '' }}"><i class="uil uil-cog"></i><span>Categories</span></a></li> -->

    <!-- <li><a href="{{ route('admin.enquiry.index') }}" class="{{ in_array(Route::currentRouteName(),['admin.enquiry.index']) ? 'active' : '' }}"><i class="uil uil-phone"></i><span>Enquiries </span></a></li> -->

    <li><a href="{{ route('admin.email.index') }}" class="{{ in_array(Route::currentRouteName(),['admin.email.index','admin.email.create','admin.email.edit']) ? 'active' : '' }}"><i class="uil-envelope"></i>Email Templates</span></a></li>

    <!-- <li><a href="{{ route('admin.cms.index') }}" class="{{ in_array(Route::currentRouteName(),['admin.cms.index','admin.cms.edit']) ? 'active' : '' }}"><i class="uil-file-info-alt"></i>CMS Pages</span></a></li> -->

    <li>
        <a href="javascript: void(0);" class=""><i class="uil-cog"></i>Settings </span><span class="menu-arrow"></span></a>
        <ul class="nav-second-level" aria-expanded="false">
            <li><a href="{{ route('admin.settings') }}" class="{{ in_array(Route::currentRouteName(),['admin.settings']) ? 'active' : '' }}">App Settings</a></li>
            <li><a href="{{ route('admin.about-us') }}" class="{{ in_array(Route::currentRouteName(),['admin.about-us']) ? 'active' : '' }}">About Us</a></li>

            <li><a href="{{ route('admin.privacy-policy') }}" class="{{ in_array(Route::currentRouteName(),['admin.privacy-policy']) ? 'active' : '' }}">Privacy Policy</a></li>

            <li><a href="{{ route('admin.terms-&-conditions') }}" class="{{ in_array(Route::currentRouteName(),['admin.terms-&-conditions']) ? 'active' : '' }}">Terms & Conditions</a></li>
        </ul>
    </li>
</ul>
