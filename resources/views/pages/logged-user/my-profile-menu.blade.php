<div class="col-xs-12 col-sm-3 my-profile-menu">
    <div class="wrapper">
        <div class="avatar-and-name padding-bottom-15">
            <figure itemscope="" itemtype="http://schema.org/ImageObject" class="inline-block">
                <img alt="" itemprop="contentUrl" src="/assets/uploads/patient-benefit-3.svg"/>
            </figure>
            <div class="welcome-name inline-block fs-16 lato-bold">Welcome, {{session('logged_user')['name']}}</div>
        </div>
        <nav>
            <ul itemscope="" itemtype="http://schema.org/SiteNavigationElement">
                <li><a href="{{ route('my-profile') }}" @if(!empty(Route::current()) && Route::current()->getName() == 'my-profile') class="active" @endif itemprop="url"><span itemprop="name">My Wallet</span></a></li>
                <li><a href="{{ route('edit-account') }}" @if(!empty(Route::current()) && Route::current()->getName() == 'edit-account') class="active" @endif itemprop="url"><span itemprop="name">Edit Account</span></a></li>
                <li><a href="{{ route('manage-privacy') }}" @if(!empty(Route::current()) && Route::current()->getName() == 'manage-privacy') class="active" @endif itemprop="url"><span itemprop="name">Manage Privacy</span></a></li>
                <li><a href="{{ route('user-logout') }}" itemprop="url"><span itemprop="name">Log out</span></a></li>
            </ul>
        </nav>
    </div>
</div>