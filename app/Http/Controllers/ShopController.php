<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Shop;
use App\ShopUser;

use Auth, DB;

class ShopController extends Controller
{
    //
    const MIN_DISTANCE = 100;

    public function loadNearbyShops()
    {
        $shops = DB::table('shop')
                    ->where('shop_distance','<=',self::MIN_DISTANCE)
                    ->whereNotIn('shop_id', function($query) {
                        return $query->select('shop_users_shop_id')
                                     ->from('shop_users')
                                     ->where('shop_users_user_id',Auth::user()->id);
                    })->get();
        return response()->json(['shops' => $shops]);
    }

    public function loadPreferredShops()
    {
        $shops = DB::table('shop')
                    ->whereIn('shop_id', function($query) {
                        return $query->select('shop_users_shop_id')
                                     ->from('shop_users')
                                     ->where('shop_users_user_id',Auth::user()->id);
                    })->get();
        return response()->json(['shops' => $shops]);

    }

    public function likeShop()
    {
        $shopUser = new ShopUser;
        $shopUser->shop_users_shop_id = request()->get('id');
        $shopUser->shop_users_user_id = Auth::user()->id;
        $shopUser->save();

        return response()->json(['status' => 200, 'message' => 'shop liked successfully']);
    }

    public function dislikeShop()
    {
        $shopUser = ShopUser::where('shop_users_shop_id',request()->get('id'))
                            ->where('shop_users_user_id',Auth::user()->id)->first();

        if ($shopUser) {
            $shopUser->shop_users_suspended = strtotime(date('Y-m-d H:i:s'). "+2hours");
            $shopUser->save();
        } else {
            $shopUser = new ShopUser;
            $shopUser->shop_users_shop_id = request()->get('id');
            $shopUser->shop_users_user_id = Auth::user()->id;
            $shopUser->shop_users_suspended = date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s'). "+2hours"));
            $shopUser->save();
        }

        return response()->json(['status' => 200, 'message' => 'shop disliked successfully']);
    }

    public function removeShop()
    {
        $shopUser = ShopUser::where('shop_users_shop_id',request()->get('id'))
                            ->where('shop_users_user_id',Auth::user()->id);
        if ($shopUser) {
            $shopUser->delete();
        }

        return response()->json(['status' => 200, 'message' => 'shop removed successfully']);
    }
}
