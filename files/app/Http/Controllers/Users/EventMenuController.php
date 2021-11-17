<?php

namespace App\Http\Controllers\Users;


use App\Http\Controllers\UserController;
use App\Models\MainMenu;
use App\Models\Menus;
use App\Models\MenuType;
use App\Models\SubMenu;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Sentinel;
use Yajra\Datatables\Datatables;


class EventMenuController extends UserController {

    private $userRepository;

    public function __construct(UserRepository $userRepository){

        $this->middleware( 'authorized:eventSetting.read', [ 'only' => [ 'index', 'data' ] ] );
        $this->middleware( 'authorized:eventSetting.write', [ 'only' => [ 'create', 'store', 'update', '	edit','storeSupplier' ] ] );
        $this->middleware( 'authorized:eventSetting.delete', [ 'only' => [ 'delete' ] ] );

        parent::__construct();
        $this->userRepository = $userRepository;

        view()->share('type','eventMenu');
        view()->share('path',substr(strrchr($_SERVER['REQUEST_URI'], "/"), 1));
    }

    public function index()
    {
        $title = trans( 'Menu' );
        $menus = MainMenu::get();
        return view( 'user.eventMenu.mainMenuIndex', compact( 'title','menus') );
    }

    public function storeMenu(Request $request)
    {
        $menu['name'] = $request->get('name');
        $menu['min_person'] = $request->get('minimumPerson');
        $menu['max_person'] = $request->get('maximumPerson');
        $menu['tables'] = $request->get('tables');
        $menu_data = new MainMenu();
        $menu_data->create($menu);

        return redirect("eventMenu/menu");
    }

    public function editMenu(MainMenu $menu){
        $title = "Edit Menu";
        $data = $menu;
        return view('user.eventMenu.mainMenuCreate', compact('title','data'));
    }

    public function updateMenu(Request $request,MainMenu $menu){
        $menu = MainMenu::find($menu->id);
        $menu->name = $request->get('name');
        $menu->min_person = $request->get('minimumPerson');
        $menu->max_person = $request->get('maximumPerson');
        $menu->tables = $request->get('tables');
        $menu->save();
        return redirect("eventMenu/menu");
    }

    public function data($main_menu_id = 0,$menu_type_id = 0){
        if($main_menu_id == 0 && $menu_type_id == 0){
            $subMenu = SubMenu::with('main_menu','menu_type_data')
                ->get()
                ->map(function ($subMenu) {
                    return [
                        'id' => $subMenu->id,
                        'mainMenu' => ($subMenu->main_menu) ? $subMenu->main_menu->name : '',
                        'menuType' => ($subMenu->menu_type_data) ? $subMenu->menu_type_data->name : '',
                        'name' => $subMenu->name,
                        'minPerson' => $subMenu->min_person,
                        'maxPerson' => $subMenu->max_person,
                        'time' => $subMenu->times,
                    ];
                });
        }
        else if($main_menu_id == 0 || $menu_type_id == 0){
            if($main_menu_id != 0){
                $where = ['main_menu_id'=>$main_menu_id];
            }else{
                $where = ['main_menu_id'=>$main_menu_id , 'menu_type' => $menu_type_id];
            }
            $subMenu = SubMenu::with('main_menu','menu_type_data')
                ->where($where)
                ->get()
                ->map(function ($subMenu) {
                    return [
                        'id' => $subMenu->id,
                        'mainMenu' => ($subMenu->main_menu) ? $subMenu->main_menu->name : '',
                        'menuType' => ($subMenu->menu_type_data) ? $subMenu->menu_type_data->name : '',
                        'name' => $subMenu->name,
                        'minPerson' => $subMenu->min_person,
                        'maxPerson' => $subMenu->max_person,
                        'time' => $subMenu->times,
                    ];
                });
        }
        else {
            $subMenu = SubMenu::with('main_menu','menu_type_data')
                ->where('main_menu_id',$main_menu_id)
                ->where('menu_type' , $menu_type_id)
                ->get()
                ->map(function ($subMenu) {
                    return [
                        'id' => $subMenu->id,
                        'mainMenu' => ($subMenu->main_menu) ? $subMenu->main_menu->name : '',
                        'menuType' => ($subMenu->menu_type_data) ? $subMenu->menu_type_data->name : '',
                        'name' => $subMenu->name,
                        'minPerson' => $subMenu->min_person,
                        'maxPerson' => $subMenu->max_person,
                        'time' => $subMenu->times,
                    ];
                });
        }
        return Datatables::of($subMenu)
            ->addColumn('Actions', '<a href="{{ url(\'eventMenu/\' . $id . \'/editSubMenu\' ) }}" title="{{ trans(\'table.edit\') }}">
                                    <i class="fa fa-fw fa-pencil text-warning"></i></a>
                                <a href="{{ url(\'eventMenu/\' . $id . \'/deleteSubMenu\' ) }}" title="{{ trans(\'table.delete\') }}">
                                    <i class="fa fa-fw fa-trash text-danger"></i></a>')
            ->removeColumn('id')->make();
    }

    public function menuData(){
        $subMenu = MainMenu::get()
            ->map(function ($menu) {
                return [
                    'id' => $menu->id,
                    'name' => $menu->name,
                    'minPerson' => $menu->min_person,
                    'maxPerson' => $menu->max_person,
                    'table' => $menu->tables,
                ];
            });
        return Datatables::of($subMenu)
            ->addColumn('Actions', '<a href="{{ url(\'eventMenu/\' . $id . \'/editMenu\' ) }}" title="{{ trans(\'table.edit\') }}">
                                    <i class="fa fa-fw fa-pencil text-warning"></i></a>
                                <a href="{{ url(\'eventMenu/\' . $id . \'/deleteMenu\' ) }}" title="{{ trans(\'table.delete\') }}">
                                    <i class="fa fa-fw fa-trash text-danger"></i></a>')
            ->removeColumn('id')->make();
    }

    public function menuItemData($sub_menu_id = 0){
        if($sub_menu_id == 0){
            $menu = Menus::with('sub_menu','sub_menu.main_menu','sub_menu.menu_type_data')
                ->get()
                ->map(function ($menu) {
                    return [
                        'id' => $menu->id,
                        'mainMenu' => ($menu->sub_menu || $menu->sub_menu->main_menu) ? $menu->sub_menu->main_menu->name : '',
                        'menuType' => (($menu->sub_menu) || $menu->sub_menu->menu_type_data) ? $menu->sub_menu->menu_type_data->name : '',
                        'sub_menu' => ($menu->sub_menu) ? $menu->sub_menu->name : '',
                        'name' => $menu->name,
                        'price' => $menu->price,
                        'description' => $menu->description
                    ];
                });
        }
        else {
            $menu = Menus::with('sub_menu','sub_menu.main_menu','sub_menu.menu_type_data')
                ->where('sub_menu_id',$sub_menu_id)
                ->get()
                ->map(function ($menu) {
                    return [
                        'id' => $menu->id,
                        'mainMenu' => ($menu->sub_menu || $menu->sub_menu->main_menu) ? $menu->sub_menu->main_menu->name : '',
                        'menuType' => (($menu->sub_menu) || $menu->sub_menu->menu_type_data) ? $menu->sub_menu->menu_type_data->name : '',
                        'sub_menu' => ($menu->sub_menu) ? $menu->sub_menu->name : '',
                        'name' => $menu->name,
                        'price' => $menu->price,
                        'description' => $menu->description
                    ];
                });
        }

        return Datatables::of($menu)
            ->addColumn('Actions', '<a href="{{ url(\'eventMenu/\' . $id . \'/editMenuItem\' ) }}" title="{{ trans(\'table.edit\') }}">
                                        <i class="fa fa-fw fa-pencil text-warning"></i> </a>
                                    <a href="{{ url(\'eventMenu/\' . $id . \'/deleteMenuItem\' ) }}" title="{{ trans(\'table.delete\') }}">
                                        <i class="fa fa-fw fa-trash text-danger"></i> </a>')
            ->removeColumn('id')->make();
    }

    public function menuTypeData($filter = "0"){

        if($filter != "0"){
            $menu = MenuType::with('main_menu')
                ->where('main_menu_id',$filter)
                ->get()
                ->map(function ($menu) {
                    return [
                        'id' => $menu->id,
                        'mainMenu' => $menu->main_menu->name,
                        'menuType' => $menu->name,
                        'price' => $menu->price_per_person
                    ];
                });
        }
        else{
            $menu = MenuType::with('main_menu')
                ->get()
                ->map(function ($menu) {
                    return [
                        'id' => $menu->id,
                        'mainMenu' => $menu->main_menu->name,
                        'menuType' => $menu->name,
                        'price' => $menu->price_per_person
                    ];
                });
        }
        return Datatables::of($menu)
            ->addColumn('Actions', '<a href="{{ url(\'eventMenu/\' . $id . \'/editMenuType\' ) }}" title="{{ trans(\'table.edit\') }}">
                                        <i class="fa fa-fw fa-pencil text-warning"></i> </a>
                                    <a href="{{ url(\'eventMenu/\' . $id . \'/deleteMenuType\' ) }}" title="{{ trans(\'table.delete\') }}">
                                        <i class="fa fa-fw fa-trash text-danger"></i> </a>')
            ->removeColumn('id')->make();
    }

    public function deleteMenu($id)
    {
        MainMenu::find($id)->delete();
        return redirect("eventMenu/menu");
    }

    public function menuTypeIndex()
    {
        $title = trans( 'Menu Types' );
        $menuTypes = MenuType::with('main_menu')->get();
        $main_menu = MainMenu::get()->pluck("name",'id')->prepend(trans("eventSetting.all"),'0');
        return view( 'user.eventMenu.menuTypeIndex', compact( 'title','menuTypes','main_menu') );
    }

    public function storeMenuType(Request $request)
    {
        $menuType['name'] = $request->get('menuType');
        $menuType['price_per_person'] = $request->get("price");
        $menuType['main_menu_id'] = $request->get("main_menu");

        $type_data = new MenuType();
        $id = $type_data->create($menuType)->id;

        return redirect("eventMenu/menuType");
    }

    public function updateMenuType(Request $request ,MenuType $menuType){
        $menuType = MenuType::find($menuType->id);
        $menuType->name = $request->get("menuType");
        $menuType->price_per_person = $request->get("price");
        $menuType->main_menu_id = $request->get("main_menu");
        $menuType->save();
        return redirect("eventMenu/menuType");
    }

    public function editMenuType(MenuType $menuType){
        $title = trans( 'Edit Menu Type' );
        $menuType = MenuType::find($menuType->id);
        $data = $menuType;
        $main_menu = MainMenu::get()->pluck("name",'id');
        return view('user.eventMenu.menuTypeCreate', compact('title','main_menu','data'));
    }

    public function deleteMenuType($id)
    {
        MenuType::find($id)->delete();
        return redirect("eventMenu/menuType");
    }


    public function subMenuIndex()
    {
        $title = trans( 'Sub Menu' );
        $main_menu = MainMenu::get()->pluck('name','id')->prepend(trans("eventSetting.all"),"0");
        $menu_type = MenuType::get()->pluck('name','id')->prepend(trans("eventSetting.all"),"0");
        return view( 'user.eventMenu.subMenuIndex', compact( 'title','main_menu','menu_type') );
    }


    public function subMenuCreate()
    {
        $title = trans( 'Create Sub Menu' );
        $main_menu = MainMenu::get()->pluck('name','id')->prepend("Select Menu",'');
        $menu_type = MenuType::get()->pluck('name','id');
        return view( 'user.eventMenu.subMenuCreate', compact( 'title','main_menu','menu_type') );
    }

    public function mainMenuCreate()
    {
        $title = "Add Menu";
        return view('user.eventMenu.mainMenuCreate', compact('title'));
    }

    public function menuTypeCreate()
    {
        $title = "Add Menu Type";
        $main_menu = MainMenu::get()->pluck("name",'id');
        return view('user.eventMenu.menuTypeCreate', compact('title','main_menu'));
    }

    public function storeSubMenu(Request $request){
        $submenu = new SubMenu();
        $submenu->main_menu_id = $request->get('main_menu_id');
        $submenu->menu_type = $request->get('menu_type');
        $submenu->name = $request->get('name');
        $submenu->min_person = $request->get('minimumPerson');
        $submenu->max_person = $request->get('maximumPerson');
        $submenu->times = $request->get('time');
        $submenu->save();
        return redirect("eventMenu/subMenu");
    }

    public function editSubMenu(SubMenu $menu)
    {
        $title = trans( 'Edit Sub Menu' );
        $main_menu = MainMenu::get()->pluck('name','id');
        $menu_type = MenuType::where('id',$menu->menu_type)->get()->pluck('name','id');
        return view( 'user.eventMenu.subMenuCreate', compact( 'title','menu','main_menu','menu_type') );
    }

    public function updateSubMenu(SubMenu $menu ,Request $request)
    {
        $submenu = SubMenu::find($menu->id);
        $submenu->main_menu_id = $request->get('main_menu_id');
        $submenu->menu_type = $request->get('menu_type');
        $submenu->name = $request->get('name');
        $submenu->min_person = $request->get('minimumPerson');
        $submenu->max_person = $request->get('maximumPerson');
        $submenu->times = $request->get('time');
        $submenu->save();
        return redirect("eventMenu/subMenu");
    }

    public function deleteSubMenu($id)
    {
        SubMenu::find($id)->delete();
        return redirect("eventMenu/subMenu");
    }

    public function menuItemIndex()
    {
        $title = trans( 'Menu Item' );
        $main_menu = MainMenu::get()->pluck("name",'id')->prepend(trans("eventSetting.all"),'0');
        return view( 'user.eventMenu.menuItemIndex', compact( 'title','menus','main_menu','menu_item','sub_menu') );
    }


    public function menuItemCreate()
    {
        $title = trans( 'Menu Item' );
        $main_menu = MainMenu::get()->pluck('name','id')->prepend(trans('eventSetting.select_menu'),'');
        return view( 'user.eventMenu.menuItemCreate', compact( 'title','main_menu') );
    }

    public function storeMenuItem(Request $request){
        $count = $request->get("menuItemBar");
        $price = [];
        $hour = [];
        $person = [];
        foreach (explode(",",$count) as $key => $value){
            if($request->has("price_".$value)){
                array_push($price,$request->get("price_".$value));
                array_push($person,$request->get("persons_".$value));
                array_push($hour,$request->get("hours_".$value));
            }
        }
        $submenu = new Menus();
        $submenu->main_menu_id = $request->get('main_menu_id');
        $submenu->menu_type = $request->get('menu_type');
        $submenu->sub_menu_id = $request->get('sub_menu_id');
        $submenu->name = $request->get('name');
        $submenu->price = implode(",",$price);
        $submenu->hours = implode(",",$hour);
        $submenu->persons = implode(",",$person);
        $submenu->additional = $request->get('additional');
        $submenu->description = $request->get('description');
        $submenu->save();

        return redirect("eventMenu/menuItem");
    }

    public function editMenuItem(Menus $menu)
    {
        $title = trans( 'Edit Menu Item' );

        $data = SubMenu::withTrashed()->where('id',$menu->sub_menu_id)->first();
        $main_menu = MainMenu::get()->pluck('name','id');
        $menu_type = MenuType::withTrashed()->where('id',$data->menu_type)->get()->pluck('name','id');
        $sub_menu = SubMenu::withTrashed()->where('id',$menu->sub_menu_id)->get()->pluck('name','id');

        return view( 'user.eventMenu.menuItemCreate', compact( 'title','menu','main_menu','menu_type','sub_menu') );
    }

    public function updateMenuItem(Menus $menu ,Request $request)
    {
        $count = $request->get("menuItemBar");
        $price = [];
        $hour = [];
        $person = [];
        foreach (explode(",",$count) as $key => $value){
            if($request->has("price_".$value)){
                array_push($price,$request->get("price_".$value));
                array_push($person,$request->get("persons_".$value));
                array_push($hour,$request->get("hours_".$value));
            }
        }

        $menu = Menus::find($menu->id);
        $menu->main_menu_id = $request->get("main_menu_id");
        $menu->menu_type = $request->get("menu_type");
        $menu->sub_menu_id = $request->get("sub_menu_id");
        $menu->name = $request->get("name");
        $menu->price = implode(",",$price);
        $menu->hours = implode(",",$hour);
        $menu->persons = implode(",",$person);
        $menu->additional = $request->get('additional');
        $menu->description = $request->get('description');
        $menu->save();
//        $menu->update($request->all());
        return redirect("eventMenu/menuItem");
    }

    public function deleteMenuItem($id)
    {
        Menus::find($id)->delete();
        return redirect("eventMenu/menuItem");
    }

    function filterMenuType(Request $request){
        return MenuType::where('main_menu_id',$request->get('id'))->get()->pluck("name","id")->prepend(trans('eventSetting.select_menu_type'),'');
    }

    function filterSubMenu(Request $request){
        return SubMenu::where('menu_type',$request->get('id'))
            ->get()->pluck("name","id")->prepend(trans('eventSetting.select_menu_type'),'');;
    }
}
