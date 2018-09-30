<template>
	<el-menu
		:default-active="activeIndex" 
		:router="true"
		class="el-menu-demo" 
		mode="horizontal">
	  	<el-menu-item index="1" route="/">Nearby Shops</el-menu-item>
	  	<el-menu-item index="2" route="/preferred-shops">My Preferred Shops</el-menu-item>
	  	<el-menu-item style="float: right" index="3" route="/logout">logout</el-menu-item>
	</el-menu>
</template>
<script>
	import { Menu, Submenu, MenuItem } from 'element-ui';
	import { eventBus } from '../../app';
	export default {
		computed:{
			activeIndex() {
				return this.$route.path == '/preferred-shops' ? "2" : "1"
			}
		},
		components:{
			'el-menu':Menu,
			'el-menu-item':MenuItem,
			'el-submenu':Submenu
		}
	}
</script>