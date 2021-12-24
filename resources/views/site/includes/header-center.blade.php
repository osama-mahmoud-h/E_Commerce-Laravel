<div class="header-center hidden-sm-down">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div  id="_desktop_logo" class="contentsticky_logo d-flex align-items-center justify-content-start col-lg-3 col-md-3">
              <h2 style=" font-size: 45px; font-family:Andalus; color:#062d49;">مكتبة الصفوة</h2> 
            </div>
            <div class="col-lg-9 col-md-9 header-menu d-flex align-items-center justify-content-end">
                <div class="data-contact d-flex align-items-center">
                    <div class="title-icon">support<i class="icon-support icon-address"></i></div>
                    <div class="content-data-contact">
                        <div class="support">كلم خدمة العملاء بالمكتبة :</div>
                        <div class="phone-support">
                            +201158231283
                        </div>
                    </div>
                </div>
                <div class="contentsticky_group d-flex justify-content-center">
                    <div class="header_link_myaccount">
                       
                        @if(Auth::guest())
                        <h6>
                          <a href="{{route('login')}}">Login |</a>
                          <a href="{{route('register')}}"> Register</a>
                        </h6> 
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

                    </div>
                    <div class="header_link_wishlist">
                        <a href="" title="My Wishlists">
                            <i class="header-icon-wishlist"></i>
                        </a>
                    </div>

                    <!-- begin module:ps_shoppingcart/ps_shoppingcart.tpl -->
                    <!-- begin /var/www/demo.bestprestashoptheme.com/public_html/savemart/themes/vinova_savemart/modules/ps_shoppingcart/ps_shoppingcart.tpl --><div id="_desktop_cart">
                        <div class="blockcart cart-preview active" data-refresh-url="//demo.bestprestashoptheme.com/savemart/ar/module/ps_shoppingcart/ajax">
                            <div class="header-cart">
                                <div class="cart-left">
                                   
                                    <div class="shopping-cart"><i class="zmdi zmdi-shopping-cart"></i></div>
                                    <div class="cart-products-count"> 0</div>
                                </div>
                                <div class="cart-right d-flex flex-column align-self-end ml-13">
                                    <span class="title-cart">سلة الشراء</span>
                                    <span class="cart-item"> items</span>
                                </div>
                            </div>
                            <div class="cart_block ">
                                <div class="cart-block-content">
                                    <div class="no-items">
                                        No products in the cart
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end /var/www/demo.bestprestashoptheme.com/public_html/savemart/themes/vinova_savemart/modules/ps_shoppingcart/ps_shoppingcart.tpl -->
                    <!-- end module:ps_shoppingcart/ps_shoppingcart.tpl -->

                </div>
            </div>
        </div>
    </div>
</div>