<div class="header-mobile hidden-md-up">
    <div class="hidden-md-up text-xs-center mobile d-flex  justify-content-end">
        <div class="mobile_logo ml-auto mr-auto row">
            <!--<a href="http://demo.bestprestashoptheme.com/savemart/">-->
                <div class="col-sm-9">
                    <h2  style="font-family: andalus; font-size:30px;">مكتبة الصفوة</h2>
                </div>
                   <h3 class="col-sm-3">    
                        @if(Auth::guest())
                        <a  href="{{route('login')}}">Login | </a>
                        <a href="{{route('register')}}"> Register</a>
                    
                        @else
                        
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         {{ __('Logout') }}
                           </a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                             @csrf
                          </form>

                        @endif

                   </h3>
        </div>

    </div>
    
</div>