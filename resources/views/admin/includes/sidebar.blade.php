<div class="main-menu menu-fixed menu-light menu-accordion  menu-shadow dark-them" data-scroll-to-active="true"
     style="filter:invert(1);">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item active"><a href="{{route('admin.dashboard')}}"><i class="la la-mouse-pointer"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">الرئيسية </span></a>
            </li>

            <li class="nav-item  open ">
                <a href=""><i class="la la-gift"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> العروض </span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{App\Models\Offer::count()}}</span> 
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.offers')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li>
                      <a class="menu-item" href="{{route('admin.offers.create')}}" 
                         data-i18n="nav.dash.crypto">أضافة عرض جديده </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item"><a href=""><i class="la la-reorder"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الاقسام الرئيسيه </span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{App\Models\MainCategory::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active">
                       <a class="menu-item" href="{{route('admin.main_categories')}}" data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.main_categories.create')}}" data-i18n="nav.dash.crypto">أضافة
                             قسم جديد </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href="">
                   <i class="la la-qrcode"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">المنتجات   </span>
                    <span
                        class="badge badge badge-success badge-pill float-right mr-2"> {{App\Models\Product::count()}} </span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.products')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.products.create')}}"
                      data-i18n="nav.dash.crypto">أضافة
                            منتج جديد </a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</div>
