<template>
	<div>
		<el-container>
			<el-header v-if="logged">
				<Navbar />
			</el-header>
			<el-main>
				<router-view></router-view>
			</el-main>
			<el-footer>
				
			</el-footer>
		</el-container>
	</div>
</template>
<script>
	
	import Navbar from './header/navbar';
	import { Container, Header, Footer, Main, Row } from 'element-ui';
	import { eventBus } from '../app';

	export default {
		components:{
			Navbar,
			'el-container':Container,
			'el-header':Header,
			'el-footer':Footer,
			'el-main':Main
		},
		data() {
			return {
				logged:false
			}
		},
		watch:{
			$route (to, from) {
				if (to.path == '/login') {
					this.logged = false;
				}
			}
		},	
		mounted() {
			let isLogged = localStorage.getItem('logged');
			this.logged = isLogged;
			eventBus.$on('logged',() => {
				this.logged = true;
				if (this.$route.path == 'login') {
					this.$router.push('/');
				}
			});
			eventBus.$on('logout',() => {
				this.logged = false;
				localStorage.removeItem('logged');
				this.$router.push('/login');
			});
		}
	}
</script>
<style type="text/css">
	* {
		font-family: "Helvetica Neue",Helvetica,"PingFang SC","Hiragino Sans GB","Microsoft YaHei","微软雅黑",Arial,sans-serif;
	}
	hr {
		box-shadow: none;border: 1px solid rgba(25,25,25,.1);margin-bottom: 25px;
	}
</style>