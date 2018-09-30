import VueRouter from 'vue-router';

import LoginComponent from './components/Auth/Login';
import LogoutComponent from './components/Auth/Logout';
import RegisterComponent from './components/Auth/Register';
import ShopsComponents from './components/Shops/ShopIndex';
import PreferredShopsComponents from './components/Shops/ShopPreferred';

const routes = [
	{
		path:'/',
		component:ShopsComponents,
		name:'ShopIndex',
		meta:{guest:false}
	},
	{
		path:'/preferred-shops',
		component:PreferredShopsComponents,
		name:'ShopPreferred',
		meta:{guest:false}
	},
	{
		path:'/login',
		component:LoginComponent,
		name:'login',
		meta:{guest:true}
	},
	{
		path:'/register',
		component:RegisterComponent,
		name:'register',
		meta:{guest:true}
	},
	{
		path:'/logout',
		component:LogoutComponent,
		name:'logout',
		meta:{guest:false}
	}
];


export default new VueRouter({
	routes,
	mode: 'history'
});